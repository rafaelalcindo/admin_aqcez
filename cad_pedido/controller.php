<?php
	


require('../connection.php');

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno($con)){
	echo "Falha ao carregar a Página, problema no banco de dados";
	exit();
}


require_once('Pedido.Class.php');
require_once('Local.Class.php');
require('mdl_cad_pedido.php');





$type_request = $_REQUEST['tipo'];

//echo "type_request: ".$type_request;

switch ($type_request) {

	case 'cad_pedido':			
		cadPedido($con);
	break;

	case 'lista_pedido':		
		ListarPedido($con);
	break;
	
	default:
		echo "entrou default";
		break;
}




function cadPedido($con){

	$servico    = isset($_REQUEST['servico'])?     $_REQUEST['servico']     : null;
	$descricao  = isset($_REQUEST['descricao'])?   $_REQUEST['descricao']   : null;
	$endereco   = isset($_REQUEST['endereco'])?    $_REQUEST['endereco']    : null;
	$numero     = isset($_REQUEST['numero'])? 	   $_REQUEST['numero']      : null;
	$complement = isset($_REQUEST['complement'])?  $_REQUEST['complement']  : null;
	$estado 	= isset($_REQUEST['estado'])?	   $_REQUEST['estado']  	: null;
	$cidade 	= isset($_REQUEST['cidade'])?	   $_REQUEST['cidade']		: null;
	$cep 		= isset($_REQUEST['cep'])?		   $_REQUEST['cep'] 		: null;
	$data 		= isset($_REQUEST['data'])?	       $_REQUEST['data']		: null;

	

	$verifica = verificaDadosPedidos($servico, $descricao, $endereco, $numero, $complement, $estado, $cidade, $cep, $data);

	if($verifica == false)		
		echo "<br/>deu errado";
	else
	$resu_query = InserirDadosClasse($con, $servico, $descricao, $endereco, $numero, $complement, $estado, $cidade, $cep, $data);

	

	if($resu_query)
		echo "true";

}

function ListarPedido($con){

	$getListaPedido = PegarListaPedidos($con);
	$listaPedido = ListarJsonPedidos($getListaPedido);
	mysqli_close($con);
	echo $listaPedido;

}



/*

	$descricao 			 = "Precisamos reformar meu escritório";
	$servico 		     = "Arquitetura";
	$data_comeco_servico = date('Y-m-d');
	$data_cad_pedido	 = date('Y-m-d');
	$vagas_pedido		 = 6;


	$endereco = "Rua das Oliveiras perdidas dos Santos";
	$numero	  = 234;
	$complementar = "Perto do terminal de ônibus";
	$estado = 24;
	$cidade = 1243;
	$cep = "34354-353";


	$pedido = new Pedido();
	$pedido->setDescricao($descricao);
	$pedido->setServico($servico);
	$pedido->setDataComecoServico($data_comeco_servico);
	$pedido->setDataCadPedido($data_cad_pedido);
	$pedido->setVagasPedido($vagas_pedido);

	$local = new Local();
	$local->setEndereco($endereco);
	$local->setNumero($numero);
	$local->setComplementar($complementar);
	$local->setEstado($estado);
	$local->setCidade($cidade);
	$local->setCep($cep);

	$pedido->adicionaLocal($local);

	echo "Pedido Descricao: ".$pedido->getDescricao()."<br/>";
	echo "Pedido Servico: ".$pedido->getServico()."<br/>";
	echo "Pedido Data Comeco Servico: ".$pedido->getDataComecoServico()."<br/>";
	echo "Pedido Data cad Pedido: ".$pedido->getDataCadPedido()."<br/>";
	echo "Pedido Vagas: ".$pedido->getVagasPedido()."<br/>";

	echo "Pedido Local: ".$pedido->exibe();

	echo "<br/>Liberando Memoria";
	gc_collect_cycles();

	echo "<br/>Passando Objeto para Array";

	$array_obj = (array) $pedido;

	echo "<br/> Array: ".print_r($array_obj);

	echo "<br/><br/> Agora passando Para Json";

	$json_obj = json_encode($pedido);

	echo "<br/> Json: ".print_r($json_obj);




*/

















/*      Helper backend     */

function verificaDadosPedidos($serv, $des, $end, $num, $compl, $est, $cid, $cep, $data){

  /*
	echo "serv  ".$serv;
	echo "<br/> des: ".$des;
	echo "<br/> end: ".$end;
	echo "<br/> num: ".$num;
	echo "<br/> compl: ".$compl;
	echo "<br/> est: ".$est;
	echo "<br/> cid: ".$cid;
	echo "<br/> cep: ".$cep;
	echo "<br/> data: ".$data;
  */


	if($serv != null && $des != null && $num != null && $compl != null && $est != null && $cid != null && $cep != null && $data != null){
		return true;
	}

	return false;

}


function InserirDadosClasse($con,$serv ,$des, $end, $num, $compl, $est, $cid, $cep, $data){

		$data_comeco_servico = date('Y-m-d');
		$pedido = new Pedido();
		$pedido->setServico($serv);
		$pedido->setDescricao($des);
		$pedido->setDataComecoServico($data);
		$pedido->setDataCadPedido($data_comeco_servico);
		$pedido->setVagasPedido(5);

		$local = new Local();
		$local->setEndereco($end);
		$local->setNumero($num);
		$local->setComplementar($compl);
		$local->setEstado($est);
		$local->setCidade($cid);
		$local->setCep($cep);

		$pedido->adicionaLocal($local);

		$gravar_pedido = GravarPedido($con, $pedido);
		gc_collect_cycles();

		if($gravar_pedido){
			
			return true;
		}else{
			echo "<br/> Deu errado Cad!";
			return false;
		}

}

function ListarJsonPedidos($getPedidos){

	$pedido_array = array();
	$inserir_pedi = array();








	

	while ($row = mysqli_fetch_array($getPedidos)){
		$inserir_pedi['servico'] 	  = $row['servico'];
		$inserir_pedi['descricao']    = $row['descricao'];
		$inserir_pedi['data_pedido']  = $row['data_pedido'];
		$inserir_pedi['vagas']		  = $row['vagas'];
		$inserir_pedi['endereco']	  = $row['endereco'];
		$inserir_pedi['numero']		  = $row['numero'];
		$inserir_pedi['complementar'] = $row['complementar'];
		$inserir_pedi['estado']		  = utf8_encode($row['estado']);
		$inserir_pedi['cidade']		  = utf8_encode($row['cidade']);
		$inserir_pedi['cep']		  = $row['cep'];

		$pedido_array[] = $inserir_pedi;
		unset($inserir_pedi);
	}

	header('Content-Type: application/json');
	//echo "Array  pedido: ".print_r($pedido_array);
	$dados_json = json_encode($pedido_array);
	return $dados_json;

}





?>
