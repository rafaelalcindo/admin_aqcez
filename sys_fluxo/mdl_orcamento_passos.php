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

	public function SalvarPrimeiroContato($dadosInserir){
		$sql_isertStepOrc = sprintf(" INSERT INTO step_orcamento ( step_orc_obra, step_orc_obs, step_orc_itens)
			VALUES ( '%s', '%s', '%s') ", $dadosInserir['obra'], $dadosInserir['observacao'], $dadosInserir['itens']);
		$resu_gravar = $this->conexao->query($sql_isertStepOrc);

		$last_id = $this->conexao->insert_id;
		//echo "<br/> Ultimo Id: ".$last_id;

		if($resu_gravar){
			//echo "<br/>Entrou na segunda opcao!";
			//echo "<br/> id usuario: ".$dadosInserir['id'];
			//echo "<br/> id_boss usuario: ".$dadosInserir['id_boss'];
			$sql_insertPasso = sprintf("INSERT INTO passos (step_orc_id , usuario_id , usuario_usuario_usuario_id, passos_status, passos_visu)
				VALUES ('%u', '%u', '%u', '%s', '%s') ",$last_id, $dadosInserir['id'], $dadosInserir['id_boss'], 'false', '1' );
			$resu_passos = $this->conexao->query($sql_insertPasso);
			if($resu_passos){
				return true;
			}else{ return false; }
		}else{ return false; }

	}

	public function salvarOutrasPartes($dadosInsert){

		$sql_salvaPartes = sprintf(" INSERT INTO passos (step_orc_id , usuario_id , usuario_usuario_usuario_id, passos_status, passos_visu)
				VALUES ('%u', '%u', '%u', '%s', '%s') ",$dadosInsert['stepId'] );
	}



}

