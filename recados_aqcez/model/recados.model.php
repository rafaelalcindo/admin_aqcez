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
			$InserirNoticia = InserirNoticiaGeral($this->conexao, $noticiasGerais);
			if($InserirNoticia){ return true; }else{ return false; }
		}

		public function PegarNoticiasPrimeiraPagina(){
			$pegarNoticias = pegarNoticiasPrimeiraPaginaGeral($this->conexao);
			if($pegarNoticias != false){ return $pegarNoticias; }else{ return false; }
		}

		public function PegarNoticiaPaginas($num_paginas){
			
		}

		public function PegarNoticiaCada($id){
			$pegarNoticiaCada = PegarNoticiaGeralCada($this->conexao, $id);
			if($pegarNoticiaCada != false){ return $pegarNoticiaCada; }else{ return false; }
		}


		// ========================================= Notícias Dep ============================================

		public function PegarNoticiasPrimeiraPaginaDep(){
			$pegarNoticiasDep = pegarNoticiaPrimeiraPaginaDep($this->conexao);
			if($pegarNoticiasDep != false){ return $pegarNoticiasDep; }else{ return false; }
		}

		public function InserirNoticiasDep($noticiasDep){
			$inserirNoticia = InserirNoticiasDep($this->conexao, $noticiasDep);
			if($inserirNoticia){ return true; }else{ return false; }
		}

		public function PegarDepEmails($dep){
			$pegarDepEmail = pegarEmailsDep($this->conexao ,$dep);
			if($pegarDepEmail != false){ return $pegarDepEmail; }else{ return false; }
		}

		// ======================================= Pegar Emails para enviar ===============================

		public function pegarTodosEmails(){
			$sql_getEmails = sprintf("select usuario_email as 'email' from usuario");
			$resu_query = $this->conexao->query($sql_getEmails);
			if($resu_query->num_rows > 0){
				return $resu_query;
			}else{ return false; }
		}


				
	}




	// ============================================= Notícias Gerais ================================

	function pegarNoticiasPrimeiraPaginaGeral($conexao){
		$sql_prim_pagina = sprintf(" select id_noticias as 'id', titulo_noticia as 'titulo', descricao_noticia as 'descricao', texto_noticia as 'noticias',
										data_publicacao_noticia as 'data_publicacao', img_noticia as 'imagem', anexo_noticia as 'anexo'
										from noticias where noticiaTipo = 'geral' order by id_noticias desc limit 5 ");
		$resul_query = $conexao->query($sql_prim_pagina);
		if($resul_query){
			return $resul_query;
		}else{ return false; }
	}

	function InserirNoticiaGeral($conexao, $noticiaGeral){

		$stmt = $conexao->prepare("insert into noticias 
								(titulo_noticia, descricao_noticia, texto_noticia, 
								data_publicacao_noticia,
								noticiaTipo, quem_cad_noticia)
								values 
								( ?, ?, ?, ?, ?, ? )");
		$stmt->bind_param('ssssss', $noticiaGeral['titulo'], $noticiaGeral['descricao'], $noticiaGeral['texto'], $noticiaGeral['data_publicacao'],   $noticiaGeral['tipo'], $noticiaGeral['quem_cad']);

		$resultado = $stmt->execute();
		if($resultado){ return true; }else{ return false; }
	}

	function PegarNoticiaGeralCada($conexao, $id){
		$sql_select_news = sprintf("select titulo_noticia as 'titulo', descricao_noticia as 'descricao', texto_noticia as 'texto', data_publicacao_noticia as 'data' from noticias where id_noticias = '%u' ",$id);
		$resul_query = $conexao->query($sql_select_news);
		if($resul_query){ return $resul_query; }else{ return false; }
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

	function InserirNoticiasDep($conexao, $noticiasDep){
		//echo "<br/> array: ".print_r($noticiasDep);
		$stmt = $conexao->prepare("insert into noticias 
									(titulo_noticia, descricao_noticia, texto_noticia, 
									data_publicacao_noticia,
									nomeDep_noticia,
									noticiaTipo,
									quem_cad_noticia)
									values 
									( ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param('sssssss', 	$noticiasDep['titulo'], $noticiasDep['descricao'], $noticiasDep['texto'], $noticiasDep['data_publicacao'], $noticiasDep['dep'], $noticiasDep['tipo'], $noticiasDep['quem_cad'] );

		$resultado = $stmt->execute();	
		if($resultado){ return true; }else{ return false; }

	}

	function pegarEmailsDep($conexao, $dep){
		$sql_emailDep = sprintf("select usuario_email as 'email' from usuario where usuario_dep = '%s' ", $dep);
		$resul_query = $conexao->query($sql_emailDep);
		if($resul_query){ return $resul_query; }else{ return false; }
	}


