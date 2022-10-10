<?php
namespace src\controllers\Admin;

use \core\Controller;
use \src\handlers\UserHandler;
use \core\murano\DB;
use \core\murano\Image;
use \core\murano\Mensagem;
use \core\murano\Input;
use \core\murano\Table;

class PortfolioController extends Controller {

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

        $_SESSION['menu'] = 51;
        
    }
    
    public function form() {

        $_SESSION['sub']  = 52;

        $projeto = DB::lastId('portfolio');

        if(!$projeto){
            $projeto = 1;
        }else{
            $projeto = $projeto['id'];
        }

        $input = Input::formInicio();

            $input .= Input::text('Titúlo', 'titulo', 'Titulo', 4, '');
            $input .= Input::select('Categoria', 'categoria', ['Sistema Web', 'Blog', 'Site institucional', 'Land Page', 'One Page'], 4, '');
            $input .= Input::file('Imagem', 'imagem', 'Imagem', 4, '');
            $input .= Input::text('Data do projeto', 'data', '', 4, '', 'data_input', 'text');
            $input .= Input::text('Url', 'url', 'URL do projeto', 4, '', '', 'url');
            $input .= Input::text('Ordem', 'ordem', 'Ordem que vai aparecer', 4, $projeto, '', 'number');

        $input .= Input::formFim();

        $this->render('admin/form', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Novo projeto do portfólio',
            'form' => $input
        ]);
    }

    public function action() {
        
        $dados = [];

        foreach(['titulo', 'categoria', 'data', 'url', 'ordem'] as $item){
            $dados[$item] = filter_input(INPUT_POST, $item);
        }

        if(isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])) {

            $newFoto = $_FILES['imagem'];

            if(in_array($newFoto['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                
                $fotoName = Image::cutImage($newFoto, 960, 600, 'assets/uploads');

                $dados['imagem'] = $fotoName;
            }
            
        }else{
            Mensagem::erro('Envie todos os dados');
            $this->voltaPagina();
        }

        if(!$dados){
            Mensagem::erro('Envie todos os dados');
            $this->voltaPagina();
        }

        DB::table('portfolio')->insert($dados)->execute();
        Mensagem::sucesso('Inserido com sucesso!');
        $this->voltaPagina();

    }


    public function lista() {

        $_SESSION['sub']  = 53;

        $lista = DB::table('portfolio')->select()->get();

        $tabela = Table::tabela(
            'portfolio',
            $lista, 
            ['id', 'titulo', 'categoria', 'data', 'url', 'ordem'],
            ['id', 'Titúlo', 'Categoria', 'Data', 'Url', 'Ordem'], false, false
        );

        $this->render('admin/form', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Lista de projetos',
            'form' => $tabela
        ]);
    }

    public function delete($atts = []){

        if(!empty($atts['id'])) {

            
            $id = $atts['id'];
            DB::table('portfolio')->delete()->where('id', $id)->execute();
            Mensagem::sucesso('Item deletado com sucesso!');
            

        }else{

            Mensagem::erro('Aconteceu algum erro, ou você não tem acesso a esta página!');

        }

        $this->voltaPagina();

    }
    

}