<?php
namespace src\controllers\LoginAdmin;

use \src\handlers\UserHandler;
use \core\Controller;
use \core\murano\DB;
use \core\murano\Mensagem;
use \core\murano\Email;
use \core\murano\Menu;

class LoginController extends Controller {

    //! render login
    public function loginView() {

        $this->render('admin/login/login', ['titulo' => 'Login']);

    }

    //! ação para login
    public function loginAction() {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {
            $token = UserHandler::verifyLogin($email, $password);
            if($token) {
                
                $_SESSION['token'] = $token;
                $user = DB::table('users')->select()->where('token', $token)->one();

                if($user['muda_senha'] == 1){
                    $this->redirect('/admin/mudar-senha');
                }

                Menu::loadMenu();
                DB::table('users')->update([
                    'ultimo_login' => date('Y-m-d H:i:s')
                ])->where('token', $token)->execute();
                
                $this->redirect('/admin');
            } else {
                Mensagem::erro('E-mail e/ou senha não conferem!');
                $this->redirect('/admin/login');
            }
        } else {
            Mensagem::erro('Informe todos os campos!');
            $this->redirect('/admin/login');
        }
    }

    //! Render cadastro
    public function cadastroView() {

        if(!\src\Constant::ADMIN_CADASTRO){$this->render('erro', ['mensagem' => 'ERRO 401 - Autorização requerida.']);exit;}

        $this->render('admin/login/cadastro', ['titulo' => 'Cadastro']);
    }
    
    //! Ação de cadastro
    public function cadastroAction() {
        $name = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'senha');
        $password2 = filter_input(INPUT_POST, 'senha2');

        if($name && $email && $password) {
            if($password != $password2){
                Mensagem::erro('As senhas não conferem!');
                $this->redirect('/admin/cadastro');
            }
            if(UserHandler::emailExists($email) === false) {
                $token = UserHandler::addUser($name, $email, $password);
                $_SESSION['token'] = $token;
                $this->redirect('/admin');
            } else {
                Mensagem::erro('E-mail já cadastrado!');
                $this->redirect('/admin/cadastro');
            }

        } else {
            Mensagem::erro('Informe todos os campos!');
            $this->redirect('/admin/cadastro');
        }
    }

    //! Render login
    public function logout() {
        $_SESSION['token'] = '';
        $this->redirect('/admin/login', ['titulo' => 'Login']);
    }

    //!Render esqueceu a senha
    public function esqueceuView() {

        $this->render('admin/login/esqueceu_senha', ['titulo' => 'Esqueceu senha']);

    }

    //!Render esqueceu a senha
    public function mudarView() {

        $this->render('admin/login/mudar_senha', ['titulo' => 'Alterar senha']);

    }

    //! action mudar senha primeiro
    public function mudarAction(){

        $user = DB::table('users')->select()->where('token', $_SESSION['token'])->one();
        if(!$user){

            Mensagem::erro('Usuário não encontrado!');
            $this->redirect('/admin/login');

        }

        $senha1 = filter_input(INPUT_POST, 'senha1');
        $senha2 = filter_input(INPUT_POST, 'senha2');

        if($senha1 == $senha2){

            if(strlen($senha1) < 8){
                Mensagem::erro('As senhas precisam ter no minímo 8 caracteres!');
                $this->voltaPagina();

            }else{
                DB::table('users')->update()->set([
                    'senha' => password_hash($senha1, PASSWORD_DEFAULT),
                    'muda_senha' => 0
                ])->where('token', $_SESSION['token'])->execute();
                unset($_SESSION['token']);
                Mensagem::sucesso('Senha alterada com sucesso!');
                $this->redirect('/admin/login');
            }

        }else{
            Mensagem::erro('As senhas não estão iguais!');
            $this->voltaPagina();
        }

    }

    //!Action para esqueceu a senha
    public function esqueceuAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if($email) {
            if(UserHandler::emailExists($email)) {

                $user = UserHandler::gerarNovaSenha($email);
                
                $to_body = $user['user']['nome'].', Segue a sua nova senha do sistema '.\src\Constant::TITULO_SITE.', sua nova senha é: '. $user['senha'].', é importante fazer a alteração da mesma por segurança.';

                DB::table('fila_email')->insert([
                    'from_email' => \src\Config::USER,
                    'from_name'  => \src\Constant::TITULO_SITE,
                    'to_email'   => $user['user']['email'],
                    'to_name'    => $user['user']['nome'],
                    'to_assunto' => 'Nova Senha',
                    'to_body'    => $to_body,
                    'status'     => 0
                ])->execute();

                //Email::enviar($email, $user['user']['nome'], 'Nova senha - '.\src\Constant::TITULO_SITE, $to_body);

                Mensagem::sucesso('E-mail enviado com uma nova senha!');
                $this->redirect('/admin/login');

            }else{
                Mensagem::erro('Este e-mail não existe em nossa base de dados!');
                $this->redirect('/admin/esqueceu-senha');
            }

        } else {
            Mensagem::erro('Informe o e-mail!');
            $this->redirect('/admin/esqueceu-senha');
        }
    }

}