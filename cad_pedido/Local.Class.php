<?php

class Local{

	private $endereco;
	private $numero;
	private $complementar;	
	private $estado;
	private $cidade;
	private $cep;

	/*function __destruct(){
		echo "<br/><br/>A Classe Local foi destruida!";
	}*/

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}

	public function getComplementar(){
		return $this->complementar;
	}

	public function setComplementar($complementar){
		$this->complementar = $complementar;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

}

