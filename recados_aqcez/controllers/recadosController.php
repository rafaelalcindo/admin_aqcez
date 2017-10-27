<?php
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require '../vendor/autoload.php';

	require '../classes/RecadoGeral.class.php';
	require '../classes/RecadoDep.class.php';
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	date_default_timezone_set("America/Sao_Paulo");
	session_start();


	$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
	    ],
	];

	$c = new \Slim\Container($configuration);
	$app = new \Slim\App($c);

	$app->get('/recados/paginaprincipal', function(Request $request, Response $response){

		$noticias = array();
		if(verificarUsuSession()){
			$noticiaGeral = new RecadoGeral();
			$noticiaDep   = new RecadoDep();
			$noticias['geral'] = $noticiaGeral->pegarNoticiasPrimeiraPagina();
			$noticias['dep']   = $noticiaDep->PegarNoticiasDepPrimeiraPagina();

			$noticiaJson = json_encode($noticias);
			echo $noticiaJson;

		}else{
			echo "Falha";
			$response->getBody()->write("Usuário não logado Router Recados");
		} 

		
	});


	$app->get('/cadGeral', function(Request $request, Response $response){
		$request_array = $request->getParsedBody();

		$titulo 	= $request_array['titulo'];
		$descricao  = $request_array['descricao'];
		$tipo		= $request_array['tipo'];
		$dep 		= $request_array['dep'];
		$texto		= $request_array['texto'];
		$data 		= data("Y-m-d H:i:s");

		$recadosGeral = new RecadoGeral();
		$recadosGeral->setTitulo($titulo);
		$recadosGeral->setDescricao($descricao);
		$recadosGeral->setTexto($texto);
		$recadosGeral->setTipo($tipo);
		$recadosGeral->setDataPublicacao($data);



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