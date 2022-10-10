<?php
namespace src\controllers;

use \core\Controller;
use \core\murano\DB;
use core\murano\Mensagem;

class HomeController extends Controller {


    public function index() {

        $info = DB::table('info')->select()->where('id', 1)->one();
        $portfolio = DB::table('portfolio')->select()->orderBy('ordem', 'asc')->get();

        $this->render('usuario/home',[
            'info' => $info,
            'portfolio' => $portfolio
        ]);

    }

    public function contato(){

        $dados = [];

        foreach(['nome', 'email', 'assunto', 'mensagem'] as $item){

            $dados[$item] = filter_input(INPUT_POST, $item);

        }

        if(!$dados){
            Mensagem::erro('É necessário preencher todos os campos.');
            $this->voltaPagina();
        }

        $dados['data_mensagem'] = date('d/m/Y H:i');

        DB::table('contato')->insert($dados)->execute();
        Mensagem::sucesso('Mensagem enviado com sucesso, vamos responder assim que possível.');
        $this->voltaPagina();

    }

}