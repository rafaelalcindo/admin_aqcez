<?php

	require_once('../../db_connection.php');
	require_once('Interface_crud_contatos.php');

	class model_connection_contato implements ContatosInterface{

		private $conexao;

		public function __construct(){
			$db_connection = new Db_connectio();
			$this->conexao = $db_connection->getConnection();
		}

		public function __destruct(){

		}

		public function Inserir($sql){
			$this->conexao->set_charset("utf8");
			$this->conexao->query("SET NAMES 'utf8'");
			$this->conexao->query('SET character_set_connection=utf8');
			$this->conexao->query('SET character_set_client=utf8');
			$this->conexao->query('SET character_set_results=utf8');
			
			$resultado = $this->conexao->query($sql);
			if($resultado){return true; }else{ return false; }
		}

		public function Consultar($sql){
			$this->conexao->set_charset("utf8");
			$this->conexao->query("SET NAMES 'utf8'");
			$this->conexao->query('SET character_set_connection=utf8');
			$this->conexao->query('SET character_set_client=utf8');
			$this->conexao->query('SET character_set_results=utf8');
			
			$resultado = $this->conexao->query($sql);
			if($resultado->num_rows > 0){ return $resultado; }else{ return false; }
		}

		public function Editar($sql){
			$this->conexao->set_charset("utf8");
			$this->conexao->query("SET NAMES 'utf8'");
			$this->conexao->query('SET character_set_connection=utf8');
			$this->conexao->query('SET character_set_client=utf8');
			$this->conexao->query('SET character_set_results=utf8');
			
			$resultado = $this->conexao->query($sql);
			if($resultado){return true; }else{ return false; }
		}

		public function Excluir($sql){
			$resultado = $this->conexao->query($sql);
			if($resultado){ return true; }else{ return false; }
		}

	}