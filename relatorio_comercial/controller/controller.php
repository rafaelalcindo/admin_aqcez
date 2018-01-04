<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../myslimsite/vendor/autoload.php';
require_once('../Classes/Contatos.Class.php');

$configuration = [
'settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);



@header('Access-Control-Allow-Origin: *');
@header('Content-Type: application/json');
date_default_timezone_set("America/Sao_Paulo");
@session_start();


//=========================listagem de contatos ===================================
$app->post('/contatos/listarContatos', function(Request $request, Response $response){
	$request_array = $request->getParsedBody();
	$id_user 	   = $request_array['dono_contato'];

	$contatos  = new Contatos();
	$resultado = $contatos->pegarTodosContato($id_user);
	echo $resultado;

});

$app->post('/contatos/listarhoje', function(Request $request, Response $response){
	$request_array = $request->getParsedBody();
	$id_user 	   = $request_array['dono_contato'];
	$data 		   = $request_array['dataHoje'];

	$contatos  	   = new Contatos();
	$contatos->setRetornoContato($data);
	$resultado = $contatos->pegarHojeContato($id_user, $contatos);
	echo $resultado;
});

$app->post('/contatos/salvar', function(Request $request, Response $response){

	
	$request_array 	  = $request->getParsedBody();
	$nome_empresa 	  = $request_array['nome_emp'];
	$nome_contato 	  = $request_array['nome_contato'];
	$tel_contato  	  = $request_array['tel_contato'];
	$end_contato  	  = $request_array['end_contato'];
	$status_contato   = $request_array['status_contato'];
	$retorno_contato  = $request_array['retorno_contato'];
	$sinal_fechamento = $request_array['sinal_fechamento'];
	$dono_contato	  = $request_array['dono_contato'];

	$contatos = new Contatos();
	$contatos->setNomeEmpresa($nome_empresa);
	$contatos->setNomeContato($nome_contato);
	$contatos->setTelContato($tel_contato);
	$contatos->setEndContato($end_contato);
	$contatos->setStatusContato($status_contato);
	$contatos->setRetornoContato($retorno_contato);
	$contatos->setSinalFechamento($sinal_fechamento);
	$contatos->setDonoContato($dono_contato);

	$resultado = $contatos->savarContato($contatos);
	if($resultado){ echo 'true'; }else{ echo 'false'; }

});

$app->post('/contatos/editar', function(Request $request, Response $response){

	$request_array	  = $request->getParsedBody();
	$id_contato		  = $request_array['id_contato'];
	$nome_empresa 	  = $request_array['nome_emp'];
	$nome_contato	  = $request_array['nome_contato'];
	$tel_contato	  = $request_array['tel_contato'];
	$end_contato	  = $request_array['end_contato'];
	$status_contato   = $request_array['status_contato'];
	$retorno_contato  = $request_array['retorno_contato'];
	$sinal_fechamento = $request_array['sinal_fechamento'];
	

	$contatos = new Contatos();
	$contatos->setIdContato($id_contato);
	$contatos->setNomeEmpresa($nome_empresa);
	$contatos->setNomeContato($nome_contato);
	$contatos->setTelContato($tel_contato);
	$contatos->setEndContato($end_contato);
	$contatos->setStatusContato($status_contato);
	$contatos->setRetornoContato($retorno_contato);
	$contatos->setSinalFechamento($sinal_fechamento);
	

	$resultado = $contatos->editarContato($contatos);
	if($resultado){ echo 'true'; }else{ echo 'false'; }

});



$app->run();