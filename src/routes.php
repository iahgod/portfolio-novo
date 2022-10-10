<?php
use core\Router;

$router = new Router();

//? USUARIO
$router->get('/', 'HomeController@index');
$router->get('/cadastro-concluido', 'HomeController@cadastrado');
$router->post('/criar-conta', 'HomeController@actionConta');
$router->post('/enviar-contato', 'HomeController@actionContato');

//? ADMIN
$router->get('/admin', 'Admin\AdminController@index');
$router->get('/admin/teste', 'Admin\AdminController@teste');
$router->get('/admin/logs/lista', 'Admin\AdminController@log');
$router->get('/admin/informacoes', 'Admin\InfoController@form');
$router->post('/admin/informacoes', 'Admin\InfoController@action');

//? Portfolio
$router->get('/admin/porfolio/form', 'Admin\PortfolioController@form');
$router->post('/admin/porfolio/form', 'Admin\PortfolioController@action');
$router->get('/admin/porfolio/lista', 'Admin\PortfolioController@lista');
$router->get('/admin/portfolio/delete/{id}', 'Admin\PortfolioController@delete');

//? Contato
$router->post('/contato', 'HomeController@contato');
$router->get('/admin/contato', 'Admin\ContatoController@lista');
$router->get('/admin/contato/delete/{id}', 'Admin\ContatoController@delete');


//! Rota restrita para executar alguma ação
$router->get('/admin/restrito/nascimento', 'Admin\RestritoController@nascimento'); 
$router->get('/admin/restrito/prescricao', 'Admin\RestritoController@prescricao'); 

//! Logins e cadastros
$router->get('/admin/login', 'LoginAdmin\LoginController@loginView');             $router->post('/admin/login', 'LoginAdmin\LoginController@loginAction');
$router->get('/admin/cadastro', 'LoginAdmin\LoginController@cadastroView');       $router->post('/admin/cadastro', 'LoginAdmin\LoginController@cadastroAction');
$router->get('/admin/esqueceu-senha', 'LoginAdmin\LoginController@esqueceuView'); $router->post('/admin/esqueceu-senha', 'LoginAdmin\LoginController@esqueceuAction');
$router->get('/admin/mudar-senha', 'LoginAdmin\LoginController@mudarView');       $router->post('/admin/mudar-senha', 'LoginAdmin\LoginController@mudarAction');
$router->get('/admin/resetar-senha', 'LoginAdmin\LoginController@ResetarView');   $router->post('/admin/resetar', 'LoginAdmin\LoginController@resetarAction');
$router->get('/admin/sair', 'LoginAdmin\LoginController@logout');
//! Rotas de Menu
$router->get('/admin/Menu/lista',       'Admin\MenuController@lista');
$router->get('/admin/Menu/form',        'Admin\MenuController@form');
$router->post('/admin/Menu/form',       'Admin\MenuController@action');
$router->get('/admin/Menu/delete/{id}', 'Admin\MenuController@delete');
$router->get('/admin/Menu/status/{id}', 'Admin\MenuController@status');
//!Rotas de Grupos
$router->get('/admin/Grupos/lista',       'Admin\GruposController@lista');
$router->get('/admin/Grupos/form',        'Admin\GruposController@form');
$router->get('/admin/Grupos/form/{id}',   'Admin\GruposController@form');
$router->post('/admin/Grupos/form',       'Admin\GruposController@action');
$router->get('/admin/Grupos/delete/{id}', 'Admin\GruposController@delete');
//! Rotas de minha conta
$router->get('/admin/minha-conta',  'Admin\UserController@form');
$router->post('/admin/minha-conta', 'Admin\UserController@action');
//! Notificação
$router->get('/admin/notificacao/finalizar/{id}',  'Admin\AdminController@endNotificacao');
//! Rotas de usuario
$router->get('/admin/cadastro/usuarios',                'Cadastro\UsuarioController@index');
$router->get('/admin/cadastro/usuario/form',            'Cadastro\UsuarioController@form');
$router->get('/admin/cadastro/usuario/form/{id}',       'Cadastro\UsuarioController@form');
$router->post('/admin/cadastro/usuario/form',           'Cadastro\UsuarioController@action');
$router->post('/admin/cadastro/usuario/form/permissao', 'Cadastro\UsuarioController@actionPermissao');
$router->get('/admin/cadastro/usuario/delete/{id}',     'Cadastro\UsuarioController@delete');