<?php

	require_once "recados.class.php";
	
	

	class RecadoDep extends Recados
	{
		private $nomeDep;		
		private $tipo;
		
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

		public function getQuemCad(){
			return $this->quem_cad;
		}

		public function setQuemCad($nome, $sobrenome){
			$this->quem_cad = $nome." ".$sobrenome;
		}

		public function setNomeDep($nomeDep){
			$this->nomeDep = $nomeDep;
		}

		public function getNomeDep(){
			return $this->nomeDep;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}

		// ========================================== pegando as últimas publicações ==================================================

		public function PegarNoticiasDepPrimeiraPagina($dep){
			
			
			$recadosModel = new RecadosModels();			
			$resultado = $recadosModel->PegarNoticiasPrimeiraPaginaDep($dep);

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

		public function InserirNoticiaDep(){
			$recadosModel = new RecadosModels();
			$noticiasDep  = array();

			$noticiasDep['titulo'] 			= $this->titulo;
			$noticiasDep['descricao'] 		= $this->descricao;
			$noticiasDep['texto']			= $this->texto;
			$noticiasDep['data_publicacao'] = $this->data_publicacao;
			$noticiasDep['dep']				= $this->nomeDep;
			$noticiasDep['tipo']			= $this->tipo;
			$noticiasDep['quem_cad']		= $this->quem_cad;

			$resultado = $recadosModel->InserirNoticiasDep($noticiasDep);
			if($resultado){ return true; }else{ return false; }

		}

		// ============================ Pegar noticias por paginação ============================

		public function pegarNoticiaPaginacaoDep($num_pagina, $dep){
			$start_from   = ($num_pagina - 1) * 10;
			$recadosModel = new RecadosModels();
			$resultadoModel = $recadosModel->PegarTodasNoticiaPaginaDep($num_pagina, $dep);

			if($resultadoModel != false){
				$recadosDados = array();
				$recadosAux	  = array();

				while ($row = $resultadoModel->fetch_assoc()) {
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

		// ================================ Fim Paginação ===================================


		// ============================ pegar todos emails dos dep ============================

		public function pegarDepEmails($dep){

			$db_dados = new RecadosModels();
			$resultado = $db_dados->PegarDepEmails($dep);
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

		// ========================== pegar todos emails dos Gerente =====================

		public function pegarGerenteEmails() {
			$db_dados = new RecadosModels();
			$resultado = $db_dados->PegarEmailsGerentes();
			$email_array = array();
			if(!$resultado) {
				echo "false";
				return false;
			} else {
				while( $row = $resultado->fetch_assoc()) {
					$email_array[] = $row['email'];
				}
				
				return $email_array;
			}
		}

		// ========================== Enviar emails dos dep ===============================

		public function sendEmailDep($emails, $arquivo){

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
  			 		$allowed_ext = array('gif','jpg','jpeg','png','pdf','rar', 'zip', 'doc', 'docx', 'pps','ppsx','ppt','xls','xml','xlsx') ;
  			 		if(in_array($file_name[1], $allowed_ext)){
  			 			$sourcePath = $arquivo['tmp_name'][$name];
  			 			$sourceName = $arquivo['name'][$name];
  			 			$m->AddAttachment($sourcePath,  $sourceName);
  			 		}
  			 	}
  			 }

  			 $m->isHTML(true);

  			 $m->Subject = $this->titulo;
  			 $m->Body 	 = $this->texto;
  			 $m->Body    .= "<br/><br/>";
  			 $m->Body 	 .= "<b>Messagem enviada por:</b>  ".$this->quem_cad;
  			 $m->AltBody = $this->descricao;

  			 if($m->send()){
		    	return true;
			  }else{
			  	return false;
			  }

		}


	}