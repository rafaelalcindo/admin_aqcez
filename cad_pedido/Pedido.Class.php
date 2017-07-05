<?php

require_once('Local.Class.php');

class Pedido{

	private $descricao;
	private $servico;
	private $data_comeco_serv;
	private $data_cad_pedido;
	private $vagas_pedido;
	public $local;

	function __construct(){

	}

	/*function __destruct(){
		echo "<br/>A Classe Pedido foi destruida com sucesso!";
	}*/

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getServico(){
		return $this->servico;
	}

	public function setServico($servico){
		$this->servico = $servico;
	}

	public function getDataComecoServico(){
		return $this->data_comeco_serv;
	}

	public function setDataComecoServico($data_comeco_serv){
		$data_comeco_serv_set   = FormataDataMysql($data_comeco_serv);
		$this->data_comeco_serv = $data_comeco_serv_set;
	}

	public function getDataCadPedido(){
		return $this->data_cad_pedido;
	}

	public function setDataCadPedido($data_cad_pedido){
		$this->data_cad_pedido = $data_cad_pedido;
	}

	public function getVagasPedido(){
		return $this->vagas_pedido;
	}

	public function setVagasPedido($vagas_pedido){
		$this->vagas_pedido = $vagas_pedido;
	}


	// Metodos da Classe.......................................................................


	public function adicionaLocal(Local $local){
		$this->local = $local;
	}
	

	public function exibe(){
		foreach ($this->local as $local) {
			echo $local->getEndereco()."<br/>";
			echo $local->getNumero()."<br/>";
			echo $local->getComplementar()."<br/>";
			echo "estado: ".$local->getEstado()."<br/>";
			echo "cidade: ".$local->getCidade()."<br/>";
			echo "cep: ".$local->getCep()."<br/>";
		}
	}

   


}


 function FormataDataMysql($data){
		$dataMod = DateTime::createFromFormat('d/m/Y',$data);
		return $dataMod->format('Y-m-d');
	}

