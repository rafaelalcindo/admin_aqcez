<?php
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require '../vendor/autoload.php';
	header('Access-Control-Allow-Origin: *');
	session_start();


	$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
	    ],
	];

	$c = new \Slim\Container($configuration);
	$app = new \Slim\App($c);

	$app->get('/recados/paginaprincipal', function(Request $request, Response $response){
		
		if(verificarUsuSession()){
			echo "funcionou..";

			$response->redirect('../controllers/recadosController.php/recados/controller/visumsg'); 
			
		}else{
			echo "Falha";
			$response->getBody()->write("Usuário não logado Router Recados");
		} 
	});

	$app->run();





function verificarUsuSession(){
	if((isset($_COOKIE['login_usuario']) && isset( $_COOKIE["senha_usuario"] )) || (isset($_SESSION['login_usuario']) && isset($_SESSION['senha_usuario'])) ){
		if(isset($_COOKIE['login_usuario']) && isset($_COOKIE['senha_usuario'])){
			$_SESSION['login_usuario'] = $_COOKIE['login_usuario'];
			$_SESSION['senha_usuario'] = $_COOKIE['senha_usuario'];
			return true;
		}else{return false;}
	}else{return false;}
} 