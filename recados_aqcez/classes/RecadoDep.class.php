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

		// ========================== Enviar emails dos dep ===============================

		public function sendEmailDep($emails){

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