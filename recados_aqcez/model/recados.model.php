<?php

	require_once("../../db_connection.php");

	class RecadosModels
	{

		private $conexao;

		public function __construct(){
			$db_connection = new Db_connectio();
            $this->conexao = $db_connection->getConnection();
		}

		function __destruct(){
			$this->conexao->close();
		}

	// ============================================= Notícias Gerais ==========================================
		public function InserirNoticiasGerais($noticiasGerais){

		}

		public function PegarNoticiasPrimeiraPagina(){
			$pegarNoticias = pegarNoticiiasPrimeiraPagina($this->conexao);
			if($pegarNoticias != false){ return $pegarNoticias; }else{ return false; }
		}

		public function PegarNoticiaPaginas($num_paginas){
			
		}


		// ========================================= Notícias Dep ============================================

		public function PegarNoticiasPrimeiraPaginaDep(){
			$pegarNoticiasDep = pegarNoticiaPrimeiraPaginaDep($this->conexao);
			if($pegarNoticiasDep != false){ return $pegarNoticiasDep; }else{ return false; }
		}


				
	}




	// ============================================= Notícias Gerais ================================

	function pegarNoticiiasPrimeiraPagina($conexao){
		$sql_prim_pagina = sprintf("select id_noticias as 'id', titulo_noticia as 'titulo', descricao_noticia as 'descricao', texto_noticia as 'noticias',
										data_publicacao_noticia as 'data_publicacao', img_noticia as 'imagem', anexo_noticia as 'anexo'
										from noticias where noticiaTipo = 'noticiaGeral'");
		$resul_query = $conexao->query($sql_prim_pagina);
		if($resul_query){
			return $resul_query;
		}else{ return false; }
	}




	// ============================================= Notícias Dep ====================================


	function pegarNoticiaPrimeiraPaginaDep($conexao){
		$sql_prim_dep = sprintf("select id_noticias as 'id', titulo_noticia as 'titulo', descricao_noticia as 'descricao', texto_noticia as 'texto', data_publicacao_noticia as 'data',
							nomeDep_noticia as 'nomeDep', noticiaTipo as 'tipo', quem_cad_noticia as 'quem_cad'
							from noticias where nomeDep_noticia = 'marketing'");
		$resul_query = $conexao->query($sql_prim_dep);

		if($resul_query){
			return $resul_query;	
		}else{ return false; }
	}
