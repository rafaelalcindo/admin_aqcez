<?php

	/**
	* 
	*/
	class Passosorc{
		
		private $resposta;
		private $descricao;
		private $status;
		private $visu;
		
		function __construct()
		{
			# code...
		}

		function __destruct(){

		}

		public function getResporta(){
			return $this->resposta;
		}

		public function setResposta($resposta){
			$this->resposta = $resposta;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setStatus($status){
			$this->status = $status;
		}

		public function getVisu(){
			return $this->visu;
		}

		public function setVisu($visu){
			$this->visu = $visu;
		}



	}