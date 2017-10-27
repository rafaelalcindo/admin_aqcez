<?php
	
	require_once 'recados.class.php';
	require '../model/recados.model.php';
	

	class RecadoGeral extends Recados
	{
		private $imagem;
		private $anexo;
		private $palavra_chave;
		private $tipo;

		function __construct()
		{
			
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

		public function setImagem($imagem){
			$this->imagem = $imagem;
		}

		public function getImagem(){
			return $this->imagem;
		}

		public function setAnexo($anexo){
			$this->anexo = $anexo;
		}

		public function getAnexo(){
			return $this->anexo;
		}

		public function setPalavraChave($palavra_chave){
			$this->palavra_chave = $palavra_chave;
		}

		public function getPalavraChave(){
			return $this->palavra_chave;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		public function getTipo(){
			return $this->tipo;
		}


		//========================================= funções a partes===================================

		// ============================== função pegar noticia ====================================

		public function pegarNoticiasPrimeiraPagina(){
			$recadosModel = new RecadosModels();
			$resultado 	  = $recadosModel->PegarNoticiasPrimeiraPagina();

			$recadosDados = array();
			$recadosAux   = array();

			while ($row = $resultado->fetch_assoc()) {
				$recadosDados['id']				 =  $row['id'];
				$recadosDados['titulo']     	 = utf8_encode($row['titulo']);
				$recadosDados['descricao']  	 = utf8_encode($row['descricao']);
				$recadosDados['noticias']		 = utf8_encode($row['noticias']);
				$recadosDados['data_publicacao'] = $row['data_publicacao'];
				$recadosDados['imagem']			 = $row['imagem'];
				$recadosDados['anexo']			 = $row['anexo'];
				$recadosAux[] = $recadosDados;
				unset($recadosDados);
			}
			
			
			return $recadosAux;
		}

		// ============================ Pegar noticias por paginação ============================

		public function pegarNoticiaPaginacao($num_pagina){
			
		}

		public function InserirNoticaGeral(){
			$recadosModel = new RecadosModels();
			$noticiaGeral = array();

			$noticiaGeral['titulo'] 		 = $this->titulo;
			$noticiaGeral['descricao']		 = $this->descricao;
			$noticiaGeral['texto']			 = $this->texto;
			$noticiaGeral['tipo']			 = $this->tipo;
			$noticiaGeral['data_publicacao'] = $this->data_publicacao;

			$resultado = $recadosModel->InserirNoticiasGerais($noticiaGeral);
			if($resultado){ return true; }else{ return false; }
		}

	}