<?php
	
	require_once 'recados.class.php';
	
	require '../model/recados.model.php';
	require '../../phpmailer/PHPMailerAutoload.php';
	

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

		public function getQuemCad(){
			return $this->quem_cad;
		}

		public function setQuemCad($nome, $sobrenome){
			$this->quem_cad = $nome." ".$sobrenome;
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

		// ============================ Pegar cada noticia individual ==========================

		public function pegarNoticiaIndividual($id){
			$recadosModel   = new RecadosModels();
			$resultadoModel = $recadosModel->PegarNoticiaCada($id);

			if($resultadoModel != false){
				$recadosDados = array();
				$resultado 	  = $resultadoModel->fetch_assoc();	
				$recadosDados['titulo']    = utf8_encode($resultado['titulo']);
				$recadosDados['descricao'] = utf8_encode($resultado['descricao']);
				$recadosDados['texto']	   = utf8_encode($resultado['texto']);
				$recadosDados['hora']	   = date('H:i:s' ,strtotime($resultado['data']) );
				$recadosDados['data']	   = date('d/m/Y' ,strtotime($resultado['data']) );
				$recadosDados['status']	   = 'true';

				$resultadoJson = json_encode($recadosDados);
				return $resultadoJson;
			}else{
				return false;
			}


		}

		// ============================ Pegar noticias por paginação ============================

		public function pegarNoticiaPaginacao($num_pagina){
			$start_from = ($num_pagina - 1) * 10;
			$recadosModel   = new RecadosModels();
			$resultadoModel = $recadosModel->PegarNoticiaPaginas($start_from);

			if($resultadoModel != false){
				$recadosDados = array();
				$recadosAux   = array();

				while($row = $resultadoModel->fetch_assoc()){
					$recadosDados['id'] 			 = $row['id'];
					$recadosDados['titulo'] 		 = utf8_encode($row['titulo']);
					$recadosDados['descricao']		 = utf8_encode($row['descricao']);
					$recadosDados['noticias']		 = utf8_encode($row['noticias']);
					$recadosDados['data_publicacao'] = $row['data_publicacao'];
					$recadosDados['imagem']			 = $row['imagem'];
					$recadosDados['anexo']			 = $row['anexo'];
					$recadosAux[] = $recadosDados;
					unset($recadosDados);
 				}
 				
 				
 				return $recadosAux;

			}else{ return false; }

		}

		public function PegarNumPaginas(){
			$recadosModel = new RecadosModels();
			$resultadoModel =  $recadosModel->PegarNumPaginas();
			if($resultadoModel >= 0){ return $resultadoModel; }else{ return 0; }
		}


		// =================== Fim Paginação ===============================================











		// ============================ pegar todos emails dos dep ============================

		public function pegarTodosEmails(){

			$db_dados = new RecadosModels();
			$resultado = $db_dados->pegarTodosEmails();
			$email_array = array();
			if(!$resultado){
				echo "false";
				return false;
			}else{
				while($row = $resultado->fetch_assoc()){
					$email_array[] = $row['email'];					
				}

				return $email_array;
			}

		}


		// ============================= Inserir Notícias Geral =====================================
		
		public function InserirNoticaGeral(){
			$recadosModel = new RecadosModels();
			$noticiaGeral = array();

			$noticiaGeral['titulo'] 		 = $this->titulo;
			$noticiaGeral['descricao']		 = $this->descricao;
			$noticiaGeral['texto']			 = $this->texto;
			$noticiaGeral['tipo']			 = $this->tipo;
			$noticiaGeral['data_publicacao'] = $this->data_publicacao;
			$noticiaGeral['quem_cad']		 = $this->quem_cad;

			$resultado = $recadosModel->InserirNoticiasGerais($noticiaGeral);
			if($resultado){ return true; }else{ return false; }
		}

		// =========================== Mandar Email ============================================

		public function sendEmailGeral($emails, $arquivo){

			 $m = new PHPMailer;
			 $m->CharSet = 'UTF-8';
			 $m->isSMTP();
			 $m->SMTPAuth = true;

			 $m->Host = 'br566.hostgator.com.br';
			 $m->Username = 'news@aqcez.com.br';
			 $m->Password = 'News123*';
			 $m->SMTPSecure = 'ssl';
			 $m->Port = 465;

			 $m->From = 'news@aqcez.com.br';
  			 $m->FromName = 'News';

  			 foreach ($emails as $key => $value) {
  			 	$m->addAddress($value);
  			 }

  			 if(is_array($arquivo)){
  			 	
  			 	foreach ($arquivo['name'] as $name => $value) {
  			 		$file_name   = explode(".", $arquivo['name'][$name]);
  			 		$allowed_ext = array('gif','jpg','jpeg','png','pdf','rar','zip','doc','docx','pps','ppsx', 'ppt','xls','xml','xlsx');
  			 		if(in_array($file_name[1], $allowed_ext)){
  			 			$sourcePath = $arquivo['tmp_name'][$name];
  			 			$sourceName = $arquivo['name'][$name];
  			 			$m->AddAttachment($sourcePath, $sourceName);
  			 		}
  			 	}
  			 }

  			 //exit;

  			 $m->isHTML(true);

  			 $m->Subject = $this->titulo;
  			 $m->Body 	 = $this->texto;
  			 $m->AltBody = $this->descricao;

  			 if($m->send()){
		    	return true;
			  }else{
			  	return false;
			  }

		}

	}