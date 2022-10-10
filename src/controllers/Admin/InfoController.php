<?php
namespace src\controllers\Admin;

use \core\Controller;
use \src\handlers\UserHandler;
use \core\murano\DB;
use \core\murano\Data;
use \core\murano\Mensagem;
use \core\murano\Image;
use \src\handlers\PacienteHandler;
use \core\murano\Input;

class InfoController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
        $this->getNotificacao();
        if($this->loggedUser->master != 1){
            $this->render('404');
            exit;
        }

        $_SESSION['menu'] = 50;
        $_SESSION['sub']  = 0;
    }
    
    public function form() {

        $info = DB::table('info')->select()->where('id', 1)->one();

        $input = Input::formInicio();

            $input .= Input::text('Nome', 'nome', 'Nome completo', 4, $info['nome']);
            $input .= Input::text('Perfil', 'perfil', 'Slogan', 4, $info['perfil']);
            $input .= Input::text('E-mail', 'email', 'nome@email.com', 4, $info['email']);
            $input .= Input::text('Telefone', 'telefone', '(00) 9 0000-0000', 4, $info['telefone'], 'celular');
            $input .= Input::file('Foto de perfil', 'foto', 'Imagem', 4, '');
            $input .= Input::file('Banner', 'banner', 'Imagem', 4, '');
            $input .= Input::text('Meta Descrição', 'meta_descricao', 'Texto', 12, $info['meta_descricao']);
            $input .= Input::text('Meta Keywords', 'meta_keys', 'Separe por virgulas', 12, $info['meta_keys']);
            $input .= Input::text('Sobre', 'sobre', 'Parte1', 12, $info['sobre']);
            $input .= Input::text('Sobre 2', 'sobre2', 'Parte2', 12, $info['sobre2']);
            $input .= Input::text('Sobre 3', 'sobre3', 'Parte4', 12, $info['sobre3']);
            $input .= Input::text('Facebook', 'facebook', 'URL', 4, $info['facebook'], '', 'url');
            $input .= Input::text('Linkedin', 'linkedin', 'URL', 4, $info['linkedin'], '', 'url');
            $input .= Input::text('Instagram', 'instagram', 'URL', 4, $info['instagram'], '', 'url');
            $input .= Input::text('GitHub', 'github', 'URL', 4, $info['github'], '', 'url');

        $input .= Input::formFim();

        $this->render('admin/form', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Informações do site',
            'form' => $input
        ]);
    }

    public function action() {

        $info = DB::table('info')->select()->where('id', 1)->one();
        
        $dados = [];

        foreach(['nome', 'perfil', 'email', 'telefone', 'sobre', 'sobre2', 'sobre3', 'facebook', 'linkedin', 'instagram', 'github', 'meta_descricao', 'meta_keys'] as $item){
            $dados[$item] = filter_input(INPUT_POST, $item);
        }

        if(isset($_FILES['foto']) && !empty($_FILES['foto']['tmp_name'])) {

            $dados['foto'] = Image::upload('foto', 500, 500, $info['foto']);
            
        }else{

            $dados['foto'] = $info['foto'];

        }

        if(isset($_FILES['banner']) && !empty($_FILES['banner']['tmp_name'])) {

            $dados['banner'] = Image::upload('banner', 1920, 1980, $info['banner']);
            
        }else{

            $dados['banner'] = $info['banner'];
            
        }

        if(!$dados){
            Mensagem::erro('Envie todos os dados');
            $this->voltaPagina();
        }

        DB::table('info')->update($dados)->where('id', 1)->execute();
        Mensagem::sucesso('Atualizado com sucesso!');
        $this->voltaPagina();

    }
    

}