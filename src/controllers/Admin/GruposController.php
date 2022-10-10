<?php
namespace src\controllers\Admin;

use \core\Controller;
use \src\handlers\UserHandler;
use \core\murano\Mensagem;
use \core\murano\DB;
use \core\murano\Log;
use \src\models\Grupo;

class GruposController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
        $this->getNotificacao();
        $_SESSION['menu']  = 3;
    }

    public function lista() {

        $lista = DB::table('grupos')->select()->where('id_empresa', $this->loggedUser->empresa)->get();
        $_SESSION['sub']  = 16;

        $this->render('admin/grupos/lista', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Menu',
            'lista'      => $lista
        ]);

        Log::inserir('Acessou', 'Lista de grupos');
    }

    public function form($atts = []){
        $_SESSION['sub']  = 16;
        if(!empty($atts['id'])) {
            $id = $atts['id'];
            $grupo = DB::table('grupos')->select()->where('id', $id)->one();

            if(!$grupo){
                Mensagem::sucesso('grupo não encontrado!');
                $this->voltaPagina();
            }

            $titulo = 'Editar';
            
            $grupo_permissoes = DB::table('grupos_permissoes')->select()->where('id_grupo', $id)->one();
            $menusUser = explode('.', $grupo_permissoes['menus']);

            $menus = DB::table('menu_admins')
            ->select()
            ->whereNull('id_pai')
            ->orderBy('ordem', 'asc')
            ->where('ativo', 1)->get();

            $aMenu = [];
            foreach($menus as $item){
                $aMenu[] = [
                    'id'     => $item['id'],
                    'titulo' => $item['titulo'],
                    'icone'  => $item['icone'],
                    'url'    => $item['url'],
                    'ordem'  => $item['ordem'],
                    'ativo'  => $item['ativo'],
                    'sub'    => self::getSub($item['id'])
                ];
            }

            $listaMenus = [
                'menusUser' => $menusUser,
                'menus' => $aMenu
            ];

            $this->render('admin/grupos/form', [
                'loggedUser' => $this->loggedUser,
                'titulo' => $titulo,
                'grupo' => $grupo,
                'listaMenus' => $listaMenus
            ]);

            Log::inserir('Acessou', 'Form de editar grupo');

        }else{
            //Se não vai abrir FORM de inserir
            $titulo = 'Novo';

            $this->render('admin/grupos/form', [
                'loggedUser' => $this->loggedUser,
                'titulo' => $titulo,
                'grupo' => []
            ]);

            Log::inserir('Acessou', 'Form de adicionar grupo');
        }
    }

    public function getSub($id){
        $menus = DB::table('menu_admins')
            ->select()
            ->where('id_pai', $id)
            ->where('ativo', 1)->get();

            return $menus;
    }

    public function action(){
        //Se tem id vai editar
        $id = filter_input(INPUT_POST, 'id');
        if($id) {

            $Grupo = DB::table('grupos')->select()->where('id', $id)->one();

            if(!$Grupo){
                Mensagem::erro('Grupo não encontrado!');
                $this->voltaPagina();
            }

            $dados = [];

            foreach(['descricao'] as $item): 
                $dados[$item] = filter_input(INPUT_POST, $item); 
            endforeach;

            if(filter_input(INPUT_POST, 'filtro') == 'on'){
                $dados['filtro'] = 1;
            }else{
                $dados['filtro'] = 0;
            }
            
            $menus = DB::table('menu_admins')->select()->where('ativo', 1)->get();

            $aMenu = [];
            foreach($menus as $item): $aMenu[] = $item['id']; endforeach;

            $dadosMenu = '';

            foreach($_REQUEST as $key => $item){

                if(in_array($key, $aMenu)){
                    $dadosMenu .= $key.'.';
                }

            }

            DB::table('grupos_permissoes')->update()
            ->set('menus', $dadosMenu)
            ->where('id_grupo', $id)->execute();

            if(!$dados){
                Mensagem::erro('É necessário enviar todos os dados!');
                $this->voltaPagina();
            }

            $atualiza = DB::table('grupos')->update();

            foreach($dados as $nome => $valor){

                $atualiza->set($nome, $valor);

            }
            
            $atualiza->where('id', $id)->execute();

            Log::inserir('Editou', 'Editou um grupo');
            Mensagem::sucesso('Grupo atualizado com sucesso!');
            $this->voltaPagina();

        }else{
            //Se não vai inserir

            $dados = [];

            foreach(['descricao'] as $item){

                $dados[$item] = filter_input(INPUT_POST, $item);

            }

            if(!$dados){
                Mensagem::erro('É necessário enviar todos os dados!');
                $this->voltaPagina();
            }

            DB::table('grupos')->insert([$dados])->execute();

            DB::table('grupos_permissoes')->insert([
                'id_grupo' => DB::lastId('grupos')['id'],
                'menus' => '1'
            ])->execute();

            Log::inserir('Criou', 'Criou um grupo');
            Mensagem::sucesso('Grupo adicionado com sucesso!');
            $this->redirect('/admin/grupos/lista');
        }
    }

    public function delete($atts = []){
    
        if(!empty($atts['id'])) {

            $id = $atts['id'];
            if($id == 1 || $id == 2){
                Mensagem::erro('Não é possível excluir um grupo de Administrador ou Usuário!');
                $this->voltaPagina();
            }
            DB::table('grupos')->delete()->where('id', $id)->execute();
            Log::inserir('Deletou', 'Deletou um grupo');
            Mensagem::sucesso('Deletado com sucesso!');
            $this->voltaPagina();

        }else{

            Mensagem::sucesso('Erro ao excluir!');
            $this->voltaPagina();
            
        }

    }
}