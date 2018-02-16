<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../myslimsite/vendor/autoload.php';
require_once('../Classes/Contatos.Class.php');
require_once('../Classes/ExcellComercial.Class.php');
require_once('../Classes/ExcellComercialPlanilhaQualquer.php');

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

$app->get('/contatos/listarTodosContatosComercial', function(Request $request, Response $response){
	$request_array  = $request->getParsedBody();
	
	$contatos 		= new Contatos();
	$resultado		= $contatos->pegarContatosGeral();
	echo $resultado;
});

$app->post('/contatos/listarTodosContatosPorFiltro', function(Request $request, Response $response){
	$request_array = $request->getParsedBody();
	$filtro = array();

	$filtro['filtro_nome'] = isset($request_array['filtro_nome'])? $request_array['filtro_nome']   :  '';

	$contatos  		= new Contatos();
	$resultado		= $contatos->pegarContatoFiltroAdmin($filtro);
	echo $resultado;

});

$app->get('/contatos/listarTodosContatosPorFiltroProximo', function(Request $request, Response $response){
	//$requrest_array = $request->getParsedBody();

	$dataHoje 		= date('Y-m-d');

	$contatos 		= new Contatos();
	$resultado 		= $contatos->pegarContatoFiltroProximoAdmin($dataHoje);
	echo $resultado;
});

$app->post('/contatos/pegarContato', function(Request $request, Response $response){
	$request_array 	= $request->getParsedBody();
	$id_contato 	= $request_array['id_contato'];

	$contatos 		= new Contatos();
	$resultado		= $contatos->getContatoEditar($id_contato);
	echo $resultado;
});



$app->post('/contatos/importarContatosExcell', function(Request $request, Response $response){
	$request_array 			= $request->getParsedBody();	 	
	$id_user				= $request_array['dono_contato'];
	$arquivo_excell			= isset($_FILES['excell'])? $_FILES['excell'] : null;

	//echo "<br/>".print_r($arquivo_excell);

	$excellComercial 		= new ExcellComercial();
	$diretorioUpload		= $excellComercial->checkDiretorioUpload($id_user);
	$extensaoArquivo		= $excellComercial->verificaExtensaoArquivo($arquivo_excell);

	if($extensaoArquivo){
		$resultadoUpload = $excellComercial->moverArquivoUpload($arquivo_excell, $diretorioUpload);		
		$arrayExcell     = $excellComercial->criarObjetoFromExcell($resultadoUpload);

		//echo "<br/><br/>".print_r($arrayExcell);
		//exit;
		foreach ($arrayExcell as $key => $value) {
			if($key >= 10){
				if($value['F'] != ''  && $value['K'] != '' && $value['L'] != ''){
					$excellComercial->InserirNomes($value);
					$resultadoInsert = $excellComercial->verificaAtualizacao($id_user);
					
				}
			}
		}
		if(isset($resultadoInsert)){
			echo "{status: true}";
		}
	}else{
		echo "{status: false}";
	}
	
});

$app->post('/contatos/importarContatosPlanilhaQualquer', function(Request $request, Response $response){
	$request_array 		= $request->getParsedBody();
	$id_user 			= $request_array['dono_contato'];
	$arquivo_excell		= isset($_FILES['planilha_qualquer'])? $_FILES['planilha_qualquer'] : null;

	$excellComercial 	= new ExcellComercialPlanilhaQualquer();
	$diretorioUpload 	= $excellComercial->ChecarDiretorioDono($id_user);
	$extensaoArquivo 	= $excellComercial->verificaExtensaoArquivo($arquivo_excell);

	if($extensaoArquivo){
		$resultadoUpload = $excellComercial->moverArquivoUpload($arquivo_excell, $diretorioUpload);
		$arrayExcell 	 = $excellComercial->criarObjetoFromExcell($resultadoUpload);

		echo "<br/><br/>".print_r($arrayExcell);
		echo "<br/><br/>";



		foreach($arrayExcell as $key_1 =>$value_1){
			foreach ($value_1 as $key_2 => $value_2) {
				//empresa
				$resuEmpFindKey = $excellComercial->verificaEmpresa($key_2, $value_2);
				if($resuEmpFindKey != 1){					
					if($excellComercial->getKeyEmpresa() == $key_2 ){ $excellComercial->AddEmpresa($value_2); }
				}

				//Contato 
				$resuContFindKey = $excellComercial->verificaContato($key_2, $value_2);
				if($resuContFindKey != 1){
					if($excellComercial->getKeyContato() == $key_2){ $excellComercial->AddContato($value_2); }
				}


			}
		}

		$excellComercial->pegarTodosDadosArray();

		exit;
	}

});







// ========================== Listagem de nomes Pessoal =========================

$app->post('/contatos/PegarNomescontatosPessoal', function(Request $request, Response $response){

	$request_array 	= $request->getParsedBody();
	$id_user 			= $request_array['dono_contato'];

	$contatos 			= new Contatos();
	$resultado 			= $contatos->pegarNomesContatos($id_user);
	echo print_r($resultado);
});







// ========================== Listagem de nomes ADMIN ==========================

$app->get('/contatos/PegarNomesContatos', function(Request $request, Response $response){
	$contatos 		= new Contatos();
	$resultado		= $contatos->pegarNomesContatosAdmin();
	echo $resultado;
});

$app->post('/contatos/filtroAdmin', function(Request $request, Response $response){
	$requrest_array = $request->getParsedBody();
	$situacao		= $requrest_array['situacao'];

	$contatos 		= new Contatos();
	$resultado 		= $contatos->pegarContatoFiltroSituacaoAdmin($situacao);
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

	$request_array	  		= $request->getParsedBody();
	$id_contato		  		= $request_array['id_contato'];
	$nome_empresa 	  		= $request_array['nome_emp'];
	$nome_contato	  		= $request_array['nome_contato'];
	$tel_contato	  		= $request_array['tel_contato'];
	$end_contato	  		= $request_array['end_contato'];
	$status_contato   		= $request_array['status_contato'];
	$retorno_contato  		= $request_array['retorno_contato'];

	$motivo_contato	  		= $request_array['motivo_contato'];
	$probabilidade_contato  = $request_array['probabilidade_contato'];
	$projetos 				= $request_array['projetos'];

	$turn_key				= isset($request_array['turn_key'])? $request_array['turn_key'] 	: 0;
	$interiores				= isset($request_array['interiores'])? $request_array['interiores'] : 0;
	$mobiliario				= isset($request_array['mobiliario'])? $request_array['mobiliario'] : 0;

	$observacao				= $request_array['observacao'];

	$dono_contato			= $request_array['dono_contato'];
	

	$contatos = new Contatos();
	$contatos->setIdContato($id_contato);
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

	

	$resultado = $contatos->editarContato($contatos);
	if($resultado){ echo 'true'; }else{ echo 'false'; }

});

$app->post('/contatos/deletar', function(Request $request, Response $response){

	$request_array   = $request->getParsedBody();
	$id_contato		 = $request_array['id_contato'];

	$contatos 		 = new Contatos();
	$contatos->setIdContato($id_contato);
	$resultado		 = $contatos->deletarContato($contatos);
	if($resultado){ echo "true"; }else{ echo "false"; }

});



$app->run();