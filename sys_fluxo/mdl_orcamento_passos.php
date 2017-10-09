<?php

require_once('../db_connection.php');

class ConnectionOrcPasso{

	private $conexao;

	public function __construct(){
		$db_connection = new Db_connectio();
		$this->conexao = $db_connection->getConnection();
	}

	function __destruct(){

	}

		

}

