<?php
namespace src\controllers\Cadastro;

use \core\Controller;
use \core\murano\DB;
use \core\murano\Log;
use \core\murano\Mensagem;
use \src\handlers\UserHandler;
use \core\murano\Upload;

class UsuarioController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
        $this->getNotificacao();
        $_SESSION['menu'] = 30;
        $_SESSION['sub'] = 41;
    }

    //? LISTAGENS
    public function index() {
        
        $lista = DB::table('users')
        ->select('grupos.descricao as grupo, users.nome, users.email, users.login, users.criado_em as criado, users.ultimo_login, users.id, users.conselho, users.uf_conselho, users.registro_conselho')
        ->join('grupos', 'grupos.id', '=', 'users.id_grupo')
        ->where('users.id_empresa', $this->loggedUser->empresa)->orderBy('users.id', 'asc')->get();

        $this->render('admin/cadastro/usuario', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Usuários',
            'lista'      => $lista
        ]);

        Log::inserir('Acessou', 'Lista de usuários');
        
    }

    public function form($atts = []) {

        $grupos = DB::table('grupos')->select()->where('id_empresa', $this->loggedUser->empresa)->get();

        if(!empty($atts['id'])) {

            $id = $atts['id'];

            $usuario = DB::table('users')
            ->select('grupos.descricao as grupo, users.nome, users.login, users.email, users.criado_em as criado, users.ultimo_login, users.id, users.id_grupo, users.conselho, users.uf_conselho, users.registro_conselho, users.editar_pct, users.evoluir, users.evo_social, users.evo_psico, users.evo_social, users.deletar_evo, users.ssvv, users.ficha_med, users.docs, users.admin')
            ->join('grupos', 'grupos.id', '=', 'users.id_grupo')
            ->where('users.id_empresa', $this->loggedUser->empresa)->where('users.id', $id)->one();

            if(!$usuario){
                $this->render('404');
                exit;
            }

            $this->render('admin/cadastro/usuario-form-edit', [
                'loggedUser' => $this->loggedUser,
                'titulo'     => 'Editar usuário',
                'grupos'     => $grupos,
                'ufs'        => ['', 'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'IG', 'MA', 'MG', 'MS', 'PA', 'PB', 'CE', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'],
                'usuario'    => $usuario
            ]);

            exit;

        }

        $this->render('admin/cadastro/usuario-form', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Novo usuário',
            'grupos'     => $grupos,
            'ufs'        => ['', 'AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'IG', 'MA', 'MG', 'MS', 'PA', 'PB', 'CE', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO']
        ]);

        Log::inserir('Acessou', 'Lista de usuários');
        
    }


    //? AÇÃO DE INSERIR E EDITAR
    public function action() {

        $id = filter_input(INPUT_POST, 'id');

        

        $dados = [];

        foreach(['nome', 'email', 'id_grupo', 'conselho', 'uf_conselho', 'registro_conselho', 'login'] as $item){
            $dados[$item] = filter_input(INPUT_POST, $item);
        }

        
        
        

        if($_FILES['arquivo']){

            $upload = Upload::enviar($_FILES['arquivo']);

            $dados['arquivo'] = $upload['nome'];

        }
        

        if($dados){

            

            if($id){

                    //Buscar se existe email
                    $email = DB::table('users')->select()->where('email', $dados['email'])
                    ->where('id', '!=', $id)
                    ->one();
                    if($email){
                        Mensagem::erro('Já existe um e-mail cadastrado com o e-mail enviado!');
                        $this->voltaPagina();
                    }
                    //Buscar se existe login
                    $login = DB::table('users')->select()->where('login', $dados['login'])
                    ->where('id', '!=', $id)
                    ->one();
                    if($login){
                        Mensagem::erro('Já existe um usuário cadastrado com o usuário enviado!');
                        $this->voltaPagina();
                    }

                DB::table('users')->update($dados)->where('id', $id)->execute();
                Log::inserir('Editou', 'Usuário '.$dados['nome']);
                Mensagem::sucesso('Usuário atualizado com sucesso!');
                $this->redirect('/admin/cadastro/usuario/form/'.$id);

            }else{

                    //Buscar se existe email
                    $email = DB::table('users')->select()->where('email', $dados['email'])->one();
                    if($email){
                        Mensagem::erro('Já existe um e-mail cadastrado com o e-mail enviado!');
                        $this->voltaPagina();
                    }
                    //Buscar se existe login
                    $login = DB::table('users')->select()->where('login', $dados['login'])->one();
                    if($login){
                        Mensagem::erro('Já existe um usuário cadastrado com o usuário enviado!');
                        $this->voltaPagina();
                    }

                $dados['id_empresa'] = $this->loggedUser->empresa;
                $dados['criado_em'] = date('Y-m-d');
                $dados['senha'] = password_hash('12345678', PASSWORD_DEFAULT);

                DB::table('users')->insert($dados)->execute();
                Log::inserir('Criou', 'Usuário '.$dados['nome']);
                Mensagem::sucesso('Usuário criado com sucesso!');
                
            }

            
        }else{
            Mensagem::erro('Aconteceu algum erro!');
        }

        $this->redirect('/admin/cadastro/usuarios');

    }

    public function actionPermissao(){
        $id = filter_input(INPUT_POST, 'id');

        

        $dados = [];

        foreach(['editar_pct', 'evoluir', 'evo_social', 'evo_psico', 'deletar_evo', 'ssvv', 'ficha_med', 'docs', 'admin', 'login'] as $item){

            if(filter_input(INPUT_POST, $item) == 'on'){
                $dados[$item] = 1;
            }else{
                $dados[$item] = 0;
            }
            
        }

        //$this->dd($dados);

        DB::table('users')->update($dados)->where('id', $id)->execute();
        Log::inserir('Editou', 'Usuário '.$dados['nome']);
        Mensagem::sucesso('Usuário atualizado com sucesso!');
        $this->redirect('/admin/cadastro/usuario/form/'.$id);

    }

    //? AÇÃO DE EXCLUIR
    public function delete($atts = []){

        if(!empty($atts['id'])) {

            Log::inserir('Deletou', 'Usuário');
            $id = $atts['id'];
            DB::table('users')->delete()->where('id', $id)->execute();
            Mensagem::sucesso('Usuário deletado com sucesso!');
            

        }else{

            Mensagem::erro('Aconteceu algum erro, ou você não tem acesso a esta página!');

        }

        $this->voltaPagina();

    }



}
