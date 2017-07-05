<?php

/**
* 
*/
require('mdl_orcamento_passos.php');

class PediOrc {

	private $obra_em;
	private $area;
	private $observacao;
	private $itens;

	private $status;
	private $passo_visu;
	private $step_id;
	
	function __construct()
	{
		
	}

	function __destruct(){

	}

	public function getObra_em(){
		return $this->obra_em;
	}

	public function setObra_em($obra_em){
		$this->obra_em = $obra_em;
	}

	public function getArea(){
		return $this->area;
	}

	public function setArea($area){
		$this->area = $area;
	}

	public function getObservacao(){
		return $this->observacao;
	}

	public function setObservacao($observacao){
		$this->observacao = $observacao;
	}

	public function getItens(){
		return $this->itens;
	}

	public function setIten($itens){
		$this->itens = $itens;
	}

	// next Step -----------------------------------------------------------

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setPassoVisu($passo_visu){
		$this->passo_visu = $passo_visu;
	}

	public function getPassoVisu(){
		return $this->passo_visu;
	}

	public function setStepId($step_id){
		$this->step_id = $step_id;
	}

	public function getStepId(){
		return $this->step_id;
	}


	public function gravarPrimeiroPedido($userdados){

		$gravarPrimeiro = new ConnectionOrcPasso();

		$FirstContato = array();

		//Primeiros Passos...
		$FirstContato['obra'] 		= $this->obra_em;
		$FirstContato['area'] 		= $this->area;
		$FirstContato['observacao'] = $this->observacao;
		$FirstContato['itens']		= $this->itens;

		//Segundo Passo ligar com contato

		$FirstContato['id']        = $userdados['id'];
		$FirstContato['id_boss']   = $userdados['id_boss'];
		$FirstContato['nome']      = $userdados['nome'];
		$FirstContato['sobrenome'] = $userdados['sobrenome'];
		$FirstContato['cargo']     = $userdados['cargo'];

		$resultado = $gravarPrimeiro->SalvarPrimeiroContato($FirstContato);

		if($resultado){ return true; }else{ return false; }

	}


	public function salvarSegundaParte($userdados){

		$gravarOutrasPartes = new ConnectionOrcPasso();

		$otherContato = array();

		$otherContato['status'] 	= $this->status;
		$otherContato['passoVisu']	= $this->passo_visu;
		$otherContato['stepId']		= $this->step_id;

		// Outros Passos

		$otherContato['id'] = $userdados['id'];
		$otherContato['id_boss'] = $otherContato['id_boss'];



	}

	

}