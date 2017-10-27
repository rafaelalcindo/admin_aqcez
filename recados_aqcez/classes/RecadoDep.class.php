<?php

	require_once "recados.class.php";

	class RecadoDep extends Recados
	{
		private $nomeDep;
		private $quem_cad;
		
		function __construct()
		{
			
		}

		function __destruct(){

		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setTexto($texto){
			$this->texto = $texto;
		}

		public function getTexto(){
			return $this->texto;
		}

		public function setDataPublicacao($data_publicacao){
			$this->data_publicacao = $data_publicacao;
		}

		public function getDataPublicacao(){
			return $this->data_publicacao;
		}

		public function setNomeDep($nomeDep){
			$this->nomeDep = $nomeDep;
		}

		public function getNomeDep(){
			return $this->nomeDep;
		}

		// ========================================== pegando as últimas publicações ==================================================

		public function PegarNoticiasDepPrimeiraPagina(){
			$recadosModel = new RecadosModels();
			$resultado = $recadosModel->PegarNoticiasPrimeiraPaginaDep();

			$recadosDados = array();
			$recadosAux   = array();

			while($row = $resultado->fetch_assoc()){
				$recadosDados['id']		   = $row['id'];
				$recadosDados['titulo']    = utf8_encode($row['titulo']);
				$recadosDados['descricao'] = utf8_encode($row['descricao']);
				$recadosDados['texto']	   = utf8_encode($row['texto']);
				$recadosDados['data']	   = $row['data'];
				$recadosDados['nomeDep']   = $row['nomeDep'];
				$recadosDados['tipo']	   = $row['tipo'];
				$recadosDados['quem_cad']  = $row['quem_cad'];
				$recadosAux[] = $recadosDados;
				unset($recadosDados);
			}

			return $recadosAux;
		}

		public function PegarNoticiaDepPaginas($pagina){

		}


	}