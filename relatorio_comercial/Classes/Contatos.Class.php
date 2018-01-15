<?php
	
	require_once('ContatoQuery.Class.php');
	require_once('../models/mdl_contatos.php');
	
	class Contatos extends ContatoQuery
	{
		private $id_contato;
		private $nome_empresa;
		private $nome_contato;
		private $tel_contato;
		private $end_contato;
		private $status_contato;
		private $retorno_contato;
		private $sinal_fechamento;
		private $donoContato;

		private $motivo;
		private $probabilidade;
		private $projetos;
		private $turn_key;
		private $interiores;
		private $mobiliario;
		private $total;
		private $observacao;
		
		function __construct()
		{
			
		}

		function __destruct(){

		}

		public function setIdContato($id_contato){
			$this->id_contato = $id_contato;
		}

		public function getIdContato(){
			return $this->id_contato;
		}

		public function setNomeEmpresa($nome_empresa){
			$this->nome_empresa = $nome_empresa;
		}

		public function getNomeEmpresa(){
			return $this->nome_empresa;
		}

		public function setNomeContato($nome_contato){
			$this->nome_contato = $nome_contato;
		}

		public function getNomeContato(){
			return $this->nome_contato;
		}

		public function setTelContato($tel_contato){
			$this->tel_contato = $tel_contato;
		}

		public function getTelContato(){
			return $this->tel_contato;
		}

		public function setEndContato($end_contato){
			$this->end_contato = $end_contato;
		}

		public function getEndContato(){
			return $this->end_contato;
		}

		public function setStatusContato($status_contato){
			$this->status_contato = $status_contato;
		}

		public function getStatusContato(){
			return $this->status_contato;
		}

		public function setRetornoContato($retorno_contato){
			$this->retorno_contato = $retorno_contato;
		}

		public function getRetornoContato(){
			return $this->retorno_contato;
		}

		public function setMotivo($motivo){
			$this->motivo = $motivo;
		}

		public function getMotivo(){
			return $this->motivo;
		}

		public function setProbabilidade($probabilidade){
			$this->probabilidade = $probabilidade;
		}

		public function getProbabilidade(){
			return $this->probabilidade;
		}

		public function setProjetos($projetos){
			$this->projetos = $projetos;
		}

		public function getProjetos(){
			return $this->projetos;
		}

		public function setTurnKey($turn_key){
			$this->turn_key = $turn_key;
		}

		public function getTurnKey(){
			return $this->turn_key;
		}

		public function setInteriores($interiores){
			$this->interiores = $interiores;
		}

		public function getInteriores(){
			return $this->interiores;
		}

		public function setMobiliario($mobiliario){
			$this->mobiliario = $mobiliario;
		}

		public function getMobiliario(){
			return $this->mobiliario;
		}

		public function setTotal($total){
			$this->total = $total;
		}

		public function getTotal(){
			return $this->total;
		}

		public function setObservacao($observacao){
			$this->observacao = $observacao;
		}

		public function getObservacao(){
			return $this->observacao;
		}

		public function setSinalFechamento($sinal){

			if($sinal < 20){
				$this->sinal_fechamento = '#990000';
			}else if($sinal >= 20 && $sinal < 40){
				$this->sinal_fechamento = '#ff1a1a';
			}else if($sinal >= 40 && $sinal < 60){
				$this->sinal_fechamento = '#ff751a';
			}else if($sinal >=60 && $sinal < 80){
				$this->sinal_fechamento = '#e6e600';
			}else if($sinal >= 80){
				$this->sinal_fechamento = '#53ff1a';
			}
			
		}

		public function getSinalFechamento(){
			return $this->sinal_fechamento;
		}

		public function setDonoContato($donoContato){
			$this->donoContato = $donoContato;
		}

		public function getDonoContato(){
			return $this->donoContato;
		}


		// ============================================ Fim dos Gets ee Sets ================================================



		public function savarContato($obj){
			$sql_query   = parent::savarContatoQuery($obj);
			$db_contatos = new model_connection_contato();
			$resultado   = $db_contatos->Inserir($sql_query);
			if($resultado){ return true; }else{ return false; }
		}

		public function editarContato($obj){
			$sql_query   = parent::editarContato($obj);
			
			$db_contatos = new model_connection_contato();
			$resultado	 = $db_contatos->Editar($sql_query);			
			if($resultado){ return true; }else{ return false; }
		}

		public function deletarContato($obj){
			$sql_query	 = parent::deletarContato($obj);
			$db_contatos = new model_connection_contato();
			$resultado	 = $db_contatos->Excluir($sql_query);
			if($resultado){ return true; }else{ return false; }
		}

		public function pegarTodosContato($id_user){
			$sql_query 	  = parent::pegarTodosContatosQuery($id_user);
			$db_contatos  = new model_connection_contato();
			$resultado	  = $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos 	  = array();
				$contatos_aux = array(); 

				while($row = $resultado->fetch_assoc()){
					$contatos_aux['id_contatos']	= $row['id_contatos'];
					$contatos_aux['empresa']  		= utf8_encode($row['empresa']);
					$contatos_aux['contato']  		= utf8_encode($row['contato']);
					$contatos_aux['tel']	  		= $row['tel'];
					$contatos_aux['end']	  		= utf8_encode($row['end']);
					$contatos_aux['status']   		= utf8_encode($row['status']);
					$contatos_aux['retorno']  		= $row['retorno'];
					$contatos_aux['sinal']    		= $row['sinal'];
					$contatos_aux['projetos'] 		= utf8_encode($row['projetos']);
					$contatos_aux['turn_key'] 		= $row['turn_key']   != null? $row['turn_key']   : 0;
					$contatos_aux['interiores'] 	= $row['interiores'] != null? $row['interiores'] : 0; 
					$contatos_aux['mobiliario'] 	= $row['mobiliario'] != null? $row['mobiliario'] : 0;
					$contatos_aux['total']			= $row['total']		 != null? $row['total']		 : 0;
					$contatos_aux['probabilidade']  = $row['probabilidade'];
					$contatos_aux['motivo']			= utf8_encode($row['motivo']);
					$contatos_aux['observacao']		= utf8_encode($row['observacao']);

					$contatos[] = $contatos_aux;
					unset($contatos_aux);
				}
				//echo 'Array: '.print_r($contatos);
				return json_encode($contatos);
			}else {  return "[{}]"; }
			
		}

		public function pegarHojeContato($id_user, $obj){
			$sql_query	 = parent::pegarHojeContatoQuery($id_user, $obj->getRetornoContato());
			$db_contatos = new model_connection_contato();
			$resultado	 = $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos 		= array();
				$contatos_aux 	= array();

				while($row = $resultado->fetch_assoc()) {

					$contatos_aux['id_contatos']	= $row['id_contatos'];
					$contatos_aux['empresa']  		= utf8_encode($row['empresa']);
					$contatos_aux['contato']  		= utf8_encode($row['contato']);
					$contatos_aux['tel']	  		= $row['tel'];
					$contatos_aux['end']	  		= utf8_encode($row['end']);
					$contatos_aux['status']   		= utf8_encode($row['status']);
					$contatos_aux['retorno']  		= $row['retorno'];
					$contatos_aux['sinal']    		= $row['sinal'];
					$contatos_aux['projetos'] 		= utf8_encode($row['projetos']);
					$contatos_aux['turn_key'] 		= $row['turn_key']   != null? $row['turn_key']   : 0;
					$contatos_aux['interiores'] 	= $row['interiores'] != null? $row['interiores'] : 0; 
					$contatos_aux['mobiliario'] 	= $row['mobiliario'] != null? $row['mobiliario'] : 0;
					$contatos_aux['total']			= $row['total']		 != null? $row['total']		 : 0;
					$contatos_aux['probabilidade']  = $row['probabilidade'];
					$contatos_aux['motivo']			= utf8_encode($row['motivo']);
					$contatos_aux['observacao']		= utf8_encode($row['observacao']);

					$contatos[] = $contatos_aux;
					unset($contatos_aux);

				}
				return json_encode($contatos);
			}else{ return "[{}]"; }

		}

		public function pegarContatoFiltro($id_user, $nome_contato, $dataHoje){
			$sql_query		= parent::filtroContatoQuery($id_user, $nome_contato, $dataHoje);
			$db_contatos	= new model_connection_contato();
			$resultado		= $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos 		= array();
				$contatos_aux	= array();

				while($row = $resultado->fetch_assoc() ){
					$contatos_aux['id_contatos']	= $row['id_contatos'];
					$contatos_aux['empresa']		= utf8_encode($row['empresa']);
					$contatos_aux['contato']		= utf8_encode($row['contato']);
					$contatos_aux['tel']			= $row['tel'];
					$contatos_aux['end']			= utf8_encode($row['end']);
					$contatos_aux['status']			= utf8_encode($row['status']);
					$contatos_aux['retorno']		= $row['retorno'];
					$contatos_aux['sinal']			= $row['sinal'];
					$contatos_aux['projetos']		= utf8_encode($row['projetos']);
					$contatos_aux['turn_key']		= $row['turn_key']   != null? $row['turn_key']   : 0;
					$contatos_aux['interiores']		= $row['interiores'] != null? $row['interiores'] : 0;
					$contatos_aux['mobiliario']		= $row['mobiliario'] != null? $row['mobiliario'] : 0;
					$contatos_aux['total']			= $row['total']		 != null? $row['total']		 : 0;
					$contatos_aux['probabilidade']	= $row['probabilidade'];
					$contatos_aux['motivo']			= utf8_encode($row['motivo']);
					$contatos_aux['observacao']		= utf8_encode($row['observacao']);

					$contatos[] = $contatos_aux;
					unset($contatos_aux);
				}

				return json_encode($contatos);
			}else{ return "[{}]"; }


		}

		public function pegarNomesContatos($id_user){
			$sql_query		= parent::pegarNomesContatosPessoal($id_user);
			$db_contatos 	= new model_connection_contato();
			$resultado 		= $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos  	  = array();
				$contatos_aux = array();
				while($row = $resultado->fetch_assoc()){
					$contatos_aux['contato'] = $row['contato'];
					$contatos[]	= $contatos_aux;
					unset($contatos_aux);
				}

				return json_encode($contatos);
			}else{ return "[{}]"; }
		}

		// ======================================== Vizu Geral Administrativos ========================================

		public function pegarContatosGeral(){
			$sql_query 	   = parent::pegarTodosContatosAdmin();
			$db_contatos   = new model_connection_contato();
			$resultado	   = $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$resultadoJson = ListarInfoAdmin($resultado);
				return $resultadoJson;
			}else{ return "[{}]"; }
		}

		public function pegarContatoFiltroAdmin($filtro){	
			$sql_query	 = parent::pegarTodosContatosFiltroAdmin($filtro);
			$db_contatos = new model_connection_contato();
			$resultado	 = $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$resultadoJson = ListarInfoAdmin($resultado);
				return $resultadoJson;
			}else{ return "[{}]"; }
		}

		public function pegarContatoFiltroProximoAdmin($dataHoje){

			$sql_query		= parent::pegarHojeContatoQueryAdmin($dataHoje);
			$db_contatos	= new model_connection_contato();
			$resultado		= $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$resultadoJson = ListarInfoAdmin($resultado);
				return $resultadoJson;
			}else{ return "[{}]"; }

		}

		public function pegarNomesContatosAdmin(){
			$sql_query		= parent::pegarNomesContatosAdmin();
			$db_contatos	= new model_connection_contato();
			$resultado 		= $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos  	  = array();
				$contatos_aux = array();
				while($row = $resultado->fetch_assoc()){
					$contatos_aux['contato'] = $row['contato'];
					$contatos[]	= $contatos_aux;
					unset($contatos_aux);
				}

				return json_encode($contatos);
			}else{ return "[{}]"; }
		}




	}



	// ========================================== Helpers no Processmaento =======================================

	function ListarInfoAdmin($resultado){
		$contatos 		= array();
		$contatos_aux 	= array();

		while($row = $resultado->fetch_assoc()){
			$contatos_aux['id_contatos'] 	= $row['id_contatos'];
			$contatos_aux['empresa']		= utf8_encode($row['empresa']);
			$contatos_aux['contato']		= utf8_encode($row['contato']);
			$contatos_aux['tel']			= $row['tel'];
			$contatos_aux['end']			= utf8_encode($row['end']);
			$contatos_aux['status']			= utf8_encode($row['status']);
			$contatos_aux['retorno']		= $row['retorno'];
			$contatos_aux['sinal']			= $row['sinal'];
			$contatos_aux['projetos']		= utf8_encode($row['projetos']);
			$contatos_aux['turn_key']		= $row['turn_key'] 		!= null? $row['turn_key']   	: 0;
			$contatos_aux['interiores']		= $row['interiores']	!= null? $row['interiores'] 	: 0;
			$contatos_aux['mobiliario']		= $row['mobiliario']	!= null? $row['mobiliario'] 	: 0;
			$contatos_aux['total']			= $row['total']			!= null? $row['total']			: 0;
			$contatos_aux['probabilidade']	= $row['probabilidade'];
			$contatos_aux['motivo']			= utf8_encode($row['motivo']);
			$contatos_aux['observacao']		= utf8_encode($row['observacao']);
			$contatos_aux['dono_nome']		= utf8_encode($row['dono_nome']);
			$contatos_aux['dono_sobrenome'] = utf8_encode($row['dono_sobrenome']);

			$contatos[]	= $contatos_aux;
			unset($contatos_aux);
		}

		return json_encode($contatos);
	}