<?php
namespace src\controllers\Admin;

use \core\Controller;
use \src\handlers\UserHandler;
use \core\murano\DB;
use \core\murano\Data;
use \core\murano\Mensagem;
use \core\murano\Email;
use \src\handlers\PacienteHandler;

class AdminController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
        $this->getNotificacao();
    }
    

    //! ----------------- DASHBOARD -----------------
    public function index() {
        $_SESSION['menu'] = 1;$_SESSION['sub']  = 0;

        $cards = [
            'quantidadePct' => 5,
            'totalEvolucao' => 10,
            'totalEvolucaoHoje' => 10,
            'totalSsvv' => 10,
            'totalSsvvHoje' => 10
        ];

        $this->render('admin/painel/index', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Dashboard',
            'cards' => $cards,
        ]);
    }
    //! ----------------- END DASHBOARD -----------------



    //! LOGS DOS USUARIOS
    public function log() {

        $_SESSION['menu'] = 17;
        $_SESSION['sub']  = 18;
        
        $lista = DB::table('log')
        ->select('log.id, users.nome, log.tipo, log.tabela, log.data')
        ->join('users', 'users.id', '=', 'log.id_user')
        ->orderby('log.id', 'desc')->get();
       
        $this->render('admin/logs/lista', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Logs',
            'lista' => $lista
        ]);
    }
    //! Finalizar notificacao
    public function endNotificacao($atts = []){
        if(!empty($atts['id'])) {

            $id = $atts['id'];
            DB::table('notificacao')->delete()
            ->where('id', $id)->execute();

            $this->voltaPagina();

        }
    }

    public function teste() {
        $this->dd($_SESSION['Usuario']);
        $this->render('admin/painel/blank', [
            'loggedUser' => $this->loggedUser,
            'titulo' => 'Index'
        ]);
    }

}