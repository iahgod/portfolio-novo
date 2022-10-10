<?php
namespace core;

use \src\Config;
use core\murano\DB;
use src\handlers\UserHandler;
date_default_timezone_set('America/Sao_Paulo');
class Controller {

    protected function redirect($url) {
        header("Location: ".$this->getBaseUrl().$url);
        
        exit;
    }

    public static function getBaseUrl() {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':'.$_SERVER['SERVER_PORT'];
        }
        $base .= Config::BASE_DIR;
        
        return $base;
    }

    private function _render($folder, $viewName, $viewData = []) {
        if(file_exists('../src/views/'.$folder.'/'.$viewName.'.php')) {
            
            extract($viewData);
            $render = fn($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require '../src/views/'.$folder.'/'.$viewName.'.php';
        }
    }

    private function renderPartial($viewName, $viewData = []) {
        $this->_render('', $viewName, $viewData);
    }

    public function render($viewName, $viewData = []) {
        $this->_render('pages', $viewName, $viewData);
    }

    public function voltaPagina(){
        header("Location: ".$_SERVER['HTTP_REFERER']."");
        exit;
    }

    public static function dd($code){
        echo '<pre>';
        print_r($code);
        echo '</pre>';
        exit;
    }
    public static function d($code){
        echo '<pre>';
        print_r($code);
        echo '</pre>';
    }

    public static function getNotificacao(){

        $usuario = UserHandler::checkLogin();
        $aNotificacao = DB::table('notificacao')
        ->select('notificacao.id as id, notificacao.titulo, notificacao.mensagem, notificacao.data, users.nome')
        ->join('users', 'users.id', '=', 'notificacao.from_user')
        ->where('notificacao.to_user', $usuario->id)
        ->orderBy('notificacao.id', 'desc')
        ->get();

        $_SESSION['notificacao'] = $aNotificacao;
        
    }

    public static function notifica($toUser, $titulo, $mensagem){

        DB::table('notificacao')->insert([
            'to_user' => $toUser,
            'from_user' => $_SESSION['Usuario']['id'],
            'titulo' => $titulo,
            'mensagem' => $mensagem,
            'data' => date('Y-m-d H:i')
        ])->execute();

    }

    public static function config(){

        return DB::table('configs')->select()->where('id', $_SESSION['Usuario']['id_empresa'])->one();

    }

    public function macro($macro, $modeloMacro, $modelo){

        return str_replace($macro, $modeloMacro, $modelo);

    }

}