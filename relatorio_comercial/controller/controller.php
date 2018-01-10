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

$app->post('/contatos/listarFiltro', function(Request $request, Response $response){
	$request_array	= $request->getParsedBody();
	$id_user		= $request_array['dono_contato'];
	$nome_contato	= $request_array['nome_contato'];
	$data_reuni		= $request_array['data_reuni'];

	$contatos 		= new Contatos();
	$resultado 		= $contatos->pegarContatoFiltro($id_user, $nome_contato, $data_reuni);
	echo $resultado;
});



// ========================= Crud Contatos =================================

$app->post('/contatos/salvar', function(Request $request, Response $response){

	
	$request_array 	  		= $request->getParsedBody();
	$nome_empresa 	  		= $request_array['nome_emp'];
	$nome_contato 	  		= $request_array['nome_contato'];
	$tel_contato  	  		= $request_array['tel_contato'];
	$end_contato  	  		= $request_array['end_contato'];
	$status_contato   		= $request_array['status_contato'];
	$retorno_contato  		= $request_array['retorno_contato'];

	$motivo_contato	  		= $request_array['motivo_contato'];
	$probabilidade_contato	= $request_array['probabilidade_contato'];
	$projetos				= $request_array['projetos'];
	$turn_key				= isset($request_array['turn_key'])? $request_array['turn_key'] 	: 0;
	$interiores				= isset($request_array['interiores'])? $request_array['interiores'] : 0;
	$mobiliario				= isset($request_array['mobiliario'])? $request_array['mobiliario'] : 0;
	//$total					= $request_array['total'];
	$observacao				= $request_array['observacao'];

	$dono_contato	  = $request_array['dono_contato'];

	$contatos = new Contatos();
	$contatos->setNomeEmpresa($nome_empresa);
	$contatos->setNomeContato($nome_contato);
	$contatos->setTelContato($tel_contato);
	$contatos->setEndContato($end_contato);
	$contatos->setStatusContato($status_contato);
	$contatos->setRetornoContato($retorno_contato);
	$contatos->setMotivo($motivo_contato);
	$contatos->setProbabilidade($probabilidade_contato);
	$contatos->setProjetos($projetos);
	$contatos->setTurnKey($turn_key);
	$contatos->setInteriores($interiores);
	$contatos->setMobiliario($mobiliario);
	$total = $turn_key + $interiores + $mobiliario;
	$contatos->setTotal($total);
	$contatos->setObservacao($observacao);
	$contatos->setSinalFechamento($probabilidade_contato);	

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

$app->post('/contatos/deletar', function(Request $request, Response $response){

	$request_array   = $request->getParsedBody();
	$id_contato		 = $request_array['id_contato'];

	$contatos 		 = new Contatos();
	$contatos->setIdContato($id_contato);
	$resultado		 = $contatos->deletarContato($contatos);
	if($resultado){ echo 'true'; }else{ echo 'false'; }

});



$app->run();