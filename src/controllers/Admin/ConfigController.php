<?php
namespace src\controllers\Admin;

use \core\Controller;
use \core\murano\DB;
use \core\murano\Log;
use \core\murano\Mensagem;
use \src\handlers\UserHandler;

class ConfigController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if($this->loggedUser === false) {
            $this->redirect('/admin/login');
        }
        $this->getNotificacao();
        $_SESSION['menu']  = 3;
    }

    //? LISTAGENS
    public function form() {

        $lista = DB::table('configs')->select()->where('id', $this->loggedUser->empresa)->one();
        $_SESSION['sub']  = 46;

        $this->render('admin/config/form', [
            'loggedUser' => $this->loggedUser,
            'titulo'     => 'Informações',
            'config'     => $lista
        ]);

        Log::inserir('Acessou', 'Informações da empresa');

    }

    //? AÇÃO DE INSERIR E EDITAR
    public function action() {

        $dados = [];

        foreach(['title', 'razao', 'cnpj', 'rua', 'numero', 'cidade', 'estado', 'cep', 'telefone', 'celular', 'email', 'logo', 'leitos'] as $item){

            $dados[$item] = filter_input(INPUT_POST, $item);

        }

        DB::table('configs')->update($dados)->where('id', $this->loggedUser->empresa)->execute();

        Log::inserir('Atualizou', 'Dados da empresa');
        Mensagem::sucesso('Empresa atualizada com sucesso!');

        $this->voltaPagina();

    }

}