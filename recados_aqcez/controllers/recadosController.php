<?php

	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require '../vendor/autoload.php';

	$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false
	    ],
	];

	$c = new \Slim\Container($configuration);
	$app = new \Slim\App($c);

	require '../classes/RecadoGeral.class.php';
	require '../classes/RecadoDep.class.php';
	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	date_default_timezone_set("America/Sao_Paulo");
	session_start();


	
	

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


	$app->post('/cadGeral', function(Request $request, Response $response){
		$request_array = $request->getParsedBody();
		$status = array();

		$titulo 	= $request_array['titulo'];
		$descricao  = $request_array['descricao'];
		$tipo		= $request_array['tipo'];
		$dep 		= $request_array['dep'];
		$texto		= $request_array['texto'];
		$data 		= date("Y-m-d H:i:s");

		$recadosGeral = new RecadoGeral();
		$recadosGeral->setTitulo($titulo);
		$recadosGeral->setDescricao($descricao);
		$recadosGeral->setTexto($texto);
		$recadosGeral->setTipo($tipo);
		$recadosGeral->setDataPublicacao($data);
		$emails = $recadosGeral->pegarTodosEmails();

		$resul_email = $recadosGeral->sendEmailGeral($emails);

		//echo $resul_email;

		//exit;

		$resultado = $recadosGeral->InserirNoticaGeral();
		if($resultado){ 
			$status['status'] = 'true';
		}else{  
			$status['status'] ='false';
		}
		$statusjson = json_encode($status);
		echo $statusjson;

	});

	$app->post('/cadDep', function(Request $request, Response $response){
		$request_array = $request->getParsedBody();
		$status = array();

		$titulo 	= $request_array['titulo'];
		$descricao  = $request_array['descricao'];
		$tipo 		= $request_array['tipo'];
		$dep 		= $request_array['dep'];
		$texto 		= $request_array['texto'];
		$data 		= date("Y-m-d H:i:s");

		/*echo "<br/>titulo : ".$titulo;
		echo "<br/>descricao : ".$descricao;
		echo "<br/>tipo : ".$tipo;
		echo "<br/>dep : ".$dep;
		echo "<br/>texto : ".$texto;
		echo "<br/>data: ".$data;*/

		$recadosDep = new RecadoDep();
		$recadosDep->setTitulo($titulo);
		$recadosDep->setDescricao($descricao);
		$recadosDep->setTexto($texto);
		$recadosDep->setTipo($tipo);
		$recadosDep->setNomeDep($dep);
		$recadosDep->setDataPublicacao($data);

		$resultado = $recadosDep->InserirNoticiaDep();
		if($resultado){
			$status['status'] = 'true';
		}else{
			$status['status'] = 'false';
		}
		$statusjson = json_encode($status);
		echo $statusjson;

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