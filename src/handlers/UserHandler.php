<?php
namespace src\handlers;

use \src\models\User;
use \core\murano\DB;

class UserHandler {

    public static function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            
            if((bool) $data) {

                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->nome = $data['nome'];
                $loggedUser->email = $data['email'];
                $loggedUser->foto = $data['foto'];
                $loggedUser->empresa = $data['id_empresa'];
                $loggedUser->id_grupo = $data['id_grupo'];
                $loggedUser->master = $data['master'];
                $loggedUser->grupo = DB::table('grupos')->select('descricao')->where('id', $data['id_grupo'])->one()['descricao'];

                $loggedUser->editar_pct = $data['editar_pct'];
                $loggedUser->evoluir = $data['evoluir'];
                $loggedUser->evo_social = $data['evo_social'];
                $loggedUser->evo_psico = $data['evo_psico'];
                $loggedUser->deletar_evo = $data['deletar_evo'];
                $loggedUser->ssvv = $data['ssvv'];
                $loggedUser->ficha_med = $data['ficha_med'];
                $loggedUser->docs = $data['docs'];
                $loggedUser->admin = $data['admin'];

                $loggedUser->conselho = $data['conselho'].'/'.$data['uf_conselho'].' - '.$data['registro_conselho'];

                return $loggedUser;
            }
        }

        return false;
    }

    public static function verifyLogin($email, $password) {
        $user = User::select()
        ->where('email', $email)
        ->orWhere('login', $email)
        ->one();

        if($user) {
            if(password_verify($password, $user['senha'])) {
                $token = md5(time().rand(0,9999).time());

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                    ->orWhere('login', $email)
                ->execute();

                return $token;
            }
        }

        return false;
    }

    public function idExists($id) {
        $user = User::select()->where('id', $id)->one();
        return $user ? true : false;
    }

    public static function emailExists($email) {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }


    public static function addUser($name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());

        User::insert([
            'email' => $email,
            'senha' => $hash,
            'nome' => $name,
            'token' => $token,
            'criado_em' => date('Y/m/d h:i'),
            'id_grupo' => 2
        ])->execute();

        return $token;
    }

    public static function gerarNovaSenha($email) {

        $senha = rand(10000000,99999999);
        $user = User::select()->where('email', $email)->one();

        User::update()
            ->set('senha', password_hash($senha, PASSWORD_DEFAULT))
            ->where('email', $email)
        ->execute();

        return [
            'user'  => $user,
            'senha' =>  $senha,
        ];

    }

    public static function update($aDados, $id){
        
        $update = User::update();

        foreach($aDados as $nome => $valor){

            $update->set($nome, $valor);

        }
        
        $update->where('id', $id)->execute();

    }

}