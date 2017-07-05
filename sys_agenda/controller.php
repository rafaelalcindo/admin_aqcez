<?php

session_start();

require('../login/usuario.Class.php');
require('agenda.Class.php');

@header('Content-Type: application/json');

$requestType = isset($_REQUEST['agenda'])? $_REQUEST['agenda'] : null;




switch ($requestType) {
	case 'salvarAgenda':
		 gravarAgenda();
	break;

	case 'pegarNomesVend':
		nomesVendedoresCalendario();
	break;

	case 'pegarNomeReuni':
		pegarNomesReuni();
	break;

	case 'pegarEventosCalendario':
		pegarEventosCalendario();
	break;

	
	case 'descricaoEvento':
		descricaoEvento();
	break;

	case 'alterarAgenda':
		editarEvento();
	break;

	case 'apagarCalendario':
		apagarEvento();
	break;
	
	default:
		# code...
		break;
}



function gravarAgenda(){

	$nome_evento 	  = isset($_REQUEST['titulo_event'])? 		$_REQUEST['titulo_event'] 		: null;
	$desc_event  	  = isset($_REQUEST['desc_event'])?   		$_REQUEST['desc_event']   		: null;
	$info_event 	  = isset($_REQUEST['info_event'])?			$_REQUEST['info_event']     	: null;
	$data_event	      = isset($_REQUEST['data_event'])?   		$_REQUEST['data_event']     	: null;
	$hora_event_ini   = isset($_REQUEST['hora_event_ini'])?     $_REQUEST['hora_event_ini'] 	: null;
	$hora_event_fim   = isset($_REQUEST['hora_event_fim'])? 	$_REQUEST['hora_event_fim'] 	: null;
	$ResponsavelEvent = isset($_REQUEST['quem_vai'])?		    $_REQUEST['quem_vai'] 			: null;
	$responsavelCad   = isset($_REQUEST['resp_cad'])?			$_REQUEST['resp_cad']	 		: null;

	$telContato		  = isset($_REQUEST['tel_contato'])?		$_REQUEST['tel_contato']		: null;
	$nome_contato	  = isset($_REQUEST['nome_contato'])?		$_REQUEST['nome_contato']		: null;
	$end_contato	  = isset($_REQUEST['end_contato'])?		$_REQUEST['end_contato']		: null;
	$cargo_contato	  = isset($_REQUEST['cargo_contato'])?		$_REQUEST['cargo_contato']	    : null;
	$email_contato	  = isset($_REQUEST['email_contato'])?		$_REQUEST['email_contato']		: null;
	$enviarPresent    = isset($_REQUEST['enviar_presenta'])?	$_REQUEST['enviar_presenta']	: null;



    $data_mod = FomartarDataMysql($data_event);
			   
	$agenda = new Agenda();
	$agenda->setTitulo($nome_evento);
	$agenda->setDescricao($desc_event);
	$agenda->setInfo($info_event);
	$agenda->setData($data_mod);
	$agenda->setHoraIni($hora_event_ini);
	$agenda->setHoroFim($hora_event_fim);

	$agenda->setTelContato($telContato);
	$agenda->setNomeContato($nome_contato);
	$agenda->setEndContato($end_contato);	
	$agenda->setCargoContato($cargo_contato);
	$agenda->setEmailContato($email_contato);
	$agenda->setEnviarPresentacao($enviarPresent);

	$usuario 	   = new Usuario();
	$usuario_array = $usuario->puxarDadosUsuarioId($ResponsavelEvent);
	$usuario_array['respCad'] = $responsavelCad;

	//$agenda->setUsuario($usuario_array);		
	$resu_final = $agenda->unirAgendaUsuario($usuario_array);
	if($resu_final){
		echo "true";
	}else{ echo "false"; }

}




function editarEvento(){
	$nome_evento_edit 	 = isset($_REQUEST['titulo_event_edit'])?   $_REQUEST['titulo_event_edit']   : null;
	$desc_evento_edit 	 = isset($_REQUEST['desc_event_edit'])?     $_REQUEST['desc_event_edit']     : null;
	$info_evento_edit 	 = isset($_REQUEST['info_event_edit'])?     $_REQUEST['info_event_edit']     : null;
	$data_evento_edit    = isset($_REQUEST['data_event_edit'])?     $_REQUEST['data_event_edit']     : null;
	$hora_evento_edi_ini = isset($_REQUEST['hora_event_ini_edit'])? $_REQUEST['hora_event_ini_edit'] : null;
	$hora_evento_edi_fim = isset($_REQUEST['hora_event_fim_edit'])? $_REQUEST['hora_event_fim_edit'] : null;
	$responEvento_edit   = isset($_REQUEST['quem_vai_edit'])? 		$_REQUEST['quem_vai_edit'] 		 : null;
	$idCalenEvent        = isset($_REQUEST['cale_event'])?			$_REQUEST['cale_event'] 		 : null;

	$telContato_edit	  = isset($_REQUEST['tel_contato_edit'])?		$_REQUEST['tel_contato_edit']		: null;
	$nome_contato_edit	  = isset($_REQUEST['nome_contato_edit'])?		$_REQUEST['nome_contato_edit']		: null;
	$end_contato_edit	  = isset($_REQUEST['end_contato_edit'])?		$_REQUEST['end_contato_edit']		: null;
	$cargo_contato_edit	  = isset($_REQUEST['cargo_contato_edit'])?		$_REQUEST['cargo_contato_edit']	    : null;
	$email_contato_edit	  = isset($_REQUEST['email_edit'])?				$_REQUEST['email_edit']				: null;
	$enviarPresent_edit   = isset($_REQUEST['apresent_edit'])?			$_REQUEST['apresent_edit']			: null;

	$data_mod = FomartarDataMysql($data_evento_edit);

	$agenda = new Agenda();
	$agenda->setTitulo($nome_evento_edit);
	$agenda->setDescricao($desc_evento_edit);
	$agenda->setInfo($info_evento_edit);
	$agenda->setData($data_mod);
	$agenda->setHoraIni($hora_evento_edi_ini);
	$agenda->setHoroFim($hora_evento_edi_fim);
	$agenda->setIdCalen($idCalenEvent);

	$agenda->setTelContato($telContato_edit);
	$agenda->setNomeContato($nome_contato_edit);
	$agenda->setEndContato($cargo_contato_edit);
	$agenda->setCargoContato($cargo_contato_edit);
	$agenda->setEmailContato($email_contato_edit);
	$agenda->setEnviarPresentacao($enviarPresent_edit);



	$resu_editar = $agenda->alterCalen($idCalenEvent, $responEvento_edit);
	if($resu_editar){
		echo 'true';
	}else{ echo 'false'; }
	

}

function apagarEvento(){
	$id_user  = isset($_REQUEST['id_user'])? $_REQUEST['id_user'] : null;
	$id_cale  = isset($_REQUEST['id_cale'])? $_REQUEST['id_cale'] : null;

	$agenda = new Agenda();
	$resultado = $agenda->deleteCalendar($id_cale, $id_user);
	if($resultado){ echo 'true'; }else{ echo 'false'; }
}

function pegarEventosCalendario(){
	$agenda = new Agenda();
	$calendarioJson = $agenda->PegarCalendarioEventos();

	echo $calendarioJson;
}



// Pegar os nomes dos Funcionários

function nomesVendedoresCalendario(){

	$usuario = new Usuario();
	
	$listaVendJson =  $usuario->getNomesVendedores();
	echo $listaVendJson;
}

// Pegar os nomes para marcar reuni

function pegarNomesReuni(){
	$id_user = isset($_REQUEST['idUser'])? $_REQUEST['idUser'] : null;

	$usuario = new Usuario();
	$listaVendJson = $usuario->getNomeMarcReuni($id_user);		
	$listaJson = json_encode($listaVendJson);
	echo $listaJson;
}

// Visualizar os eventos
function descricaoEvento(){
	$id_user      = isset($_REQUEST['id_user'])? 	   $_REQUEST['id_user'] 	  : null;
	$idcalenEvent = isset($_REQUEST['calendEventId'])? $_REQUEST['calendEventId'] : null;

	$usuario 	= new Usuario();
	$permission = $usuario->verificarEventoPermission($id_user);
	

	$editable   = $usuario->verificaPodeEditar($id_user, $idcalenEvent);
	if($editable){ $editar = true; }else{ $editar = false; }

	if($permission){
		$agenda = new Agenda();
		$file_json_array = array();
		$file_json_array = $agenda->getCalenInfo($idcalenEvent,$editar);		
		$file_json 		 = json_encode($file_json_array);
		//echo "File Json: ".$file_json;
		echo $file_json;
	}else{
		$agenda = new Agenda();
		$file_json = $agenda->ErrorPermission();
		echo $file_json;
	}
}






















// --------------------------------------- Helper agenda---------------------------------


function FomartarDataMysql($data){
	$dataMod = DateTime::createFromFormat('d/m/Y',$data);
	return $dataMod->format('Y-m-d');
}