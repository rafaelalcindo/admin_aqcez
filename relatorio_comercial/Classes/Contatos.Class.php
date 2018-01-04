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

		public function setSinalFechamento($sinal_fechamento){
			$this->sinal_fechamento = $sinal_fechamento;
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

		public function pegarTodosContato($id_user){
			$sql_query 	  = parent::pegarTodosContatosQuery($id_user);
			$db_contatos  = new model_connection_contato();
			$resultado	  = $db_contatos->Consultar($sql_query);

			if($resultado != false){
				$contatos 	  = array();
				$contatos_aux = array(); 

				while($row = $resultado->fetch_assoc()){
					$contatos_aux['empresa'] = utf8_encode($row['empresa']);
					$contatos_aux['contato'] = utf8_encode($row['contato']);
					$contatos_aux['tel']	 = $row['tel'];
					$contatos_aux['end']	 = utf8_encode($row['end']);
					$contatos_aux['status']  = utf8_encode($row['status']);
					$contatos_aux['retorno'] = $row['retorno'];
					$contatos_aux['sinal']   = $row['sinal'];
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
					$contatos_aux['empresa'] = utf8_encode($row['empresa']);
					$contatos_aux['contato'] = utf8_encode($row['contato']);
					$contatos_aux['tel']	 = $row['tel'];
					$contatos_aux['end']	 = utf8_encode($row['end']);
					$contatos_aux['status']	 = utf8_encode($row['status']);
					$contatos_aux['retorno'] = $row['retorno'];
					$contatos_aux['sinal']	 = $row['sinal'];
					$contatos[] = $contatos_aux;
					unset($contatos_aux);

				}
				return json_encode($contatos);
			}else{ return "[{}]"; }

		}


	}