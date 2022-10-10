<?php
namespace src\controllers\Admin;

use \core\Controller;
use \src\handlers\UserHandler;
use \core\murano\DB;
use \core\murano\Image;
use \core\murano\Mensagem;
use \core\murano\Input;
use \core\murano\Table;

class ContatoController extends Controller {

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

        $_SESSION['menu'] = 54;
        
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

        $_SESSION['sub']  = 0;

        $lista = DB::table('contato')->select()->orderBy('id', 'desc')->get();

        $tabela = Table::tabela(
            'contato',
            $lista, 
            ['id', 'nome', 'email', 'assunto', 'mensagem', 'data_mensagem'],
            ['id', 'Nome', 'E-mail', 'Assunto', 'Mensagem', 'Data'], false, false
        );

        $this->render('admin/form', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Contatos',
            'form' => $tabela
        ]);
    }

    public function delete($atts = []){

        if(!empty($atts['id'])) {

            
            $id = $atts['id'];
            DB::table('contato')->delete()->where('id', $id)->execute();
            Mensagem::sucesso('Item deletado com sucesso!');
            

        }else{

            Mensagem::erro('Aconteceu algum erro, ou você não tem acesso a esta página!');

        }

        $this->voltaPagina();

    }
    

}