<?php

	//require('agenda');
	require_once('../db_connection.php');

	class connection_agenda
	{	
		private $conexao;
		
		public function __construct()
		{
			$db_connection = new Db_connectio();
            $this->conexao = $db_connection->getConnection();
		}

		public function __destruct(){

		}

		public function salvarAgenda($agenda, $usuario){
			$getLastId = InsertAgendaAndGetId($agenda, $this->conexao);
			if($getLastId != false){
				$resu_ligar = LigarAgendaUsuario($getLastId, $usuario, $this->conexao);
				if($resu_ligar){
					return true;
				}else{ return false; }
			}else{ return false; }

		}

		public function pegarEventosAgenda(){
			$getEventAgenda = getEventoAgendaSQL($this->conexao);
			if($getEventAgenda != false){
				return $getEventAgenda;
			}else{ return false; }
		}

		public function getDescAgenda($id_calen){
			$getDescAgenda = getDescEventAgendaSQL($this->conexao, $id_calen);
			if($getDescAgenda != false){
				return $getDescAgenda;
			}else{ return false; }			
		}

		public function editarAgenda($agenda){
			$getEditedAgenda = atualizarAgenda($this->conexao, $agenda);
			if($getEditedAgenda){
				return true;
			}else{ return false; }
		}

		public function deletarAgenda($id_cale){
			$deleteAgenda = DeletingCalendar($this->conexao ,$id_cale);
			if($deleteAgenda){ return true; }else{ return false; }
		}

		// ============================================= Relatorios de Agenda ==================================

		public function pegarNomesDepComercio(){
			$pegarNomeComercio = pegarNomesComercial($this->conexao);
			if($pegarNomeComercio){ return $pegarNomeComercio; }else{ false; }
		}
		
	}





	function LigarAgendaUsuario($id_agenda, $usuario, $conexao){
			$sql_agenda = sprintf("insert into usuario_has_calendario 
						(usuario_usuario_id,  calendario_calendario_id, usuario_fez_registro_id)
							values
						('%u','%u', '%u')",$usuario['id'],$id_agenda, $usuario['respCad']);
			$resu_ligar = $conexao->query($sql_agenda);
			//echo "Resu ligar: ".print_r($resu_ligar);
			if($resu_ligar){
				return true;
			}else{ return false; }
		}

	function InsertAgendaAndGetId($agenda, $conexao){
			//echo "<br/>agenda: ".print_r($agenda);
			//$color = getColorMeans($agenda['desc']);
			//exit();
			$sql_agenda = sprintf("insert into calendario
			(calendario_titulo, calendario_desc, calendario_data, calendario_hora_inicio, calendario_hora_fim, calendario_color, calendario_info, tel_contato, nome_contato, end_contato, cargo_contato, email_contato, enviar_presentacao)
			values
			('%s','%s','%s', '%s','%s','%s', '%s','%s','%s','%s', '%s', '%s', '%u')", 
			$agenda['titulo'], 
			$agenda['desc'], 
			$agenda['data'], 
			$agenda['hora_ini'], 
			$agenda['hora_fim'],
			$agenda['cor'],
			$agenda['info'],
			$agenda['tel_contato'],
			$agenda['nome_contato'],
			$agenda['end_contato'],
			$agenda['cargo_contato'],
			$agenda['email_contato'],
			$agenda['enviar_presenta']);

			$resu_agenda =  $conexao->query($sql_agenda);
			$resu_last_id = $conexao->insert_id;

			//echo "id insert: ".$resu_last_id;

			if($resu_agenda){
				return $resu_last_id;
			}else{ return false; }
	}

	function atualizarAgenda($conexao, $agenda){
		$cor_update    = getColorMeans($agenda['info']);
		
		$sql_set_event = sprintf("update calendario set calendario_titulo = '%s', calendario_desc = '%s', calendario_data = '%s', 
		calendario_hora_inicio = '%s', calendario_hora_fim = '%s', 
		calendario_color = '%s',
		calendario_info = '%s',
		tel_contato = '%s', nome_contato = '%s', end_contato = '%s', cargo_contato = '%s', email_contato = '%s', enviar_presentacao = '%u'
		where 
		calendario_id = '%u' ",
		$agenda['titulo'],
		$agenda['desc'],
		$agenda['data'],
		$agenda['h_inicio'],
		$agenda['h_fim'],
		$cor_update,
		$agenda['info'],		
		$agenda['tel_contato'],
		$agenda['nome_contato'],
		$agenda['end_contato'],
		$agenda['cargo_contato'],
		$agenda['email_contato'],
		$agenda['enviar_presenta'],
		$agenda['cale_id']);
		
		$resu_update = $conexao->query($sql_set_event);

		if($resu_update){
			$atuLigacao = atualizarAgendaUsuario($conexao, $agenda['cale_id'],$agenda['quem_vai']);
			if($atuLigacao){ return true; } else { return false; }
		}else { return false; }
	}

	function atualizarAgendaUsuario($conexao, $idCalen, $idQuemVai){
		//echo "quem vai: ".$idQuemVai;
		$sql_updateAgeUsu = sprintf("update usuario_has_calendario set 
					usuario_usuario_id = '%u'
					where calendario_calendario_id = '%u' ",$idQuemVai,$idCalen);
		$resu_upAgeUsu = $conexao->query($sql_updateAgeUsu);
		if($resu_upAgeUsu){
			return true;
		}else{ return false;}
	}

	
	function getEventoAgendaSQL($conexao){
		$sql_get_all_event = sprintf("select calendario_id as 'id', calendario_titulo as 'titulo', calendario_desc as 'desc', calendario_info as 'info' ,calendario_data as 'data', 
						calendario_hora_inicio as 'inicio', calendario_hora_fim as 'fim', calendario_color as 'color'
						from calendario");
		$resu_get_event = $conexao->query($sql_get_all_event);

		if($resu_get_event){
			return $resu_get_event;
		}else{ return false; }

	}

	function getDescEventAgendaSQL($conexao, $id_calendario){		
		$sql_get_all_eventDesc = "select 
					usu.usuario_nome as 'nome', usu.usuario_sobrenome as 'sobrenome', usu.usuario_cargo as 'cargo', usu.usuario_nivel as 'nivel',
					cale.calendario_titulo as 'titulo', cale.calendario_desc as 'desc', cale.calendario_info as 'info' ,DATE_FORMAT(cale.calendario_data, '%d/%m/%Y') as 'data', cale.calendario_hora_inicio as 'h_inicio',
					cale.calendario_hora_fim as 'h_fim', cale.calendario_color as 'color', 
					cale.tel_contato as 'tel_contato', cale.nome_contato as 'nome_contato', cale.end_contato as 'end_contato', cale.cargo_contato as 'cargo_contato',
					cale.email_contato as 'email_contato', cale.enviar_presentacao as 'presentacao'

					from 
					usuario usu, usuario_has_calendario usu_cale, calendario cale
					where
					usu.usuario_id 	   = usu_cale.usuario_usuario_id and
					cale.calendario_id = usu_cale.calendario_calendario_id and
					cale.calendario_id = ".$id_calendario;
		
		$resu_get_all_descEvent = $conexao->query($sql_get_all_eventDesc);
		if($resu_get_all_descEvent){
			return $resu_get_all_descEvent;
		}else{ return false; }

	}


//================================================= listar relatorios agenda =============================================


	function pegarNomesComercial($conexao){
		$sql_nomes 	 = sprintf("select usuario_nome as 'nome', usuario_sobrenome as 'sobrenome' from usuario where usuario_cargo = 'vendedor'");
		$resul_query = $conexao->query($sql_nomes);
		if($resul_query->num_rows > 0){ return $resul_query; }else{ return false; }
	}








	function DeletingCalendar($conexao ,$id_cale){

		//echo "id cale: ".$id_cale."<br/>";
		$sql_delete_lig = sprintf("delete from usuario_has_calendario where calendario_calendario_id = '%u' ",$id_cale);
		$resul_deleteLig = $conexao->query($sql_delete_lig);
		if($resul_deleteLig){

			$sql_delete_cale = sprintf("delete  from calendario where calendario_id = '%u' ",$id_cale);
			$resu_delete_cale = $conexao->query($sql_delete_cale);
			if($resu_delete_cale){
				return true;
			}else{ return false; }

		}else{ return false; }
	}



	function getColorMeans($info){
		if($info == 'Pessoal'){
				return '#EB6021';
			}else if($info == 'Reuniao_propria'){
				return '#0B3E4C';
			}else if($info == 'Reuniao_ferramenta'){
				return '#17713B';
			}else if($info == 'Compromisso_aqcez'){
				return '#612B70';
			}else if($info == 'go_construct'){
				return '#737373';
			}else{
				return null;
			}
	}


