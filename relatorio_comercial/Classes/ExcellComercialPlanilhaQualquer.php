<?php

	require_once '../vendor/autoload.php';
	require_once('ContatoQuery.Class.php');
	require_once('../models/mdl_contatos.php');

	use PhpOffice\PhpSpreadsheet\IOFactory;

	class ExcellComercialPlanilhaQualquer extends ContatoQuery
 	{
 		private $projetos 	= array();

 		private $empresa  	= array();
 		private $empresaId 	= '';

 		private $contato   	= array();
 		private $contatoId 	= '';

 		private $telefone  	= array();
 		private $telefoneId = '';

 		private $celular 	= array();
 		private $celularId  = '';

 		private $endereco	= array();
 		private $enderecoId = '';

 		function __construct(){	}

 		public function ChecarDiretorioDono($id_dono){
 			$target_dir =  "../upload_excell/".$id_dono;
 			if(!is_dir($target_dir)){
 				mkdir($target_dir);
 				return $target_dir;
 			}else{
 				return $target_dir;
 			}
 		}

 		public function verificaExtensaoArquivo($arquivo){
 			$nameFile  		= $arquivo['name'];
 			$nameFileArray 	= explode(".", $nameFile);
 			$ext 			= end($nameFileArray);
 			if($ext == 'xls'){
 				return true;
 			}else{
 				return false;
 			}
 		}

 		public function moverArquivoUpload($arquivo, $target_dir){
 			$target_file = $target_dir."/".basename($arquivo['name']);
 			if(move_uploaded_file($arquivo['tmp_name'], $target_file)){
 				return $target_file;
 			}else{
 				return false;
 			}
 		}

 		public function criarObjetoFromExcell($file){
 			$inputFileType = 'Xls';
 			$inputFileName = $file;

 			$reader = IOFactory::createReader($inputFileType);
 			$spreadSheet = $reader->load($inputFileName);

 			$sheetData   = $spreadSheet->getActiveSheet()->toArray(null, true, true, true);
 			return $sheetData;
 		}



 		// Empresa --------------------------------------------

 		public function addEmpresaKey($empresaId){
 			$this->empresaId =  $empresaId;
 		}

 		public function getKeyEmpresa(){
 			return $this->empresaId;
 		}

 		public function AddEmpresa($empresa){
 			array_push($this->empresa, $empresa);
 		}



 		public function verificaEmpresa($key, $empresa){
 				
 			$empresa = preg_replace('/\s+/','',$empresa);
 			if($empresa == 'Empresa'){  				
 				$this->empresaId = $key; 
 				return 1;
 			}else if($empresa == 'empresa'){
 				$this->empresaId = $key; 
 				return 1;
 			}else{
 				return 0;
 			}
 		}

 		// Contato ---------------------------------------------

 		public function addContatoKey($contatoId){
 			$this->contatoId = $contatoId;
 		}

 		public function getKeyContato(){
 			return $this->contatoId;
 		}

 		public function AddContato($contato){
 			array_push($this->contato, $contato);
 		}

 		public function verificaContato($key, $contato){
 			$contato = preg_replace('/\s+/','',$contato);
 			if($contato == 'Contato'){
 				$this->contatoId = $key;
 				return 1;
 			}else if($contato == 'contato'){
 				$this->contatoId = $key;
 				return 1;
 			}else{
 				return 0;
 			}
 		}

 		// Telefone ----------------------------------------

 		public function addTelefoneKey($telefoneId){
 			$this->telefoneId = $telefoneId;
 		}

 		public function getkeyTelefone(){
 			return $this->telefoneId;
 		}

 		public function addTelefone($telefone){
 			array_push($this->telefone, $telefone);
 		}

 		public function verificaTelefone($key, $telefone){
 			$telefone = preg_replace('/\s+/','', $telefone);
 			if($telefone == 'Telefone'){
 				$this->telefoneId = $key;
 				return 1;
 			}else if($telefone == 'telefone'){
 				$this->telefoneId = $key;
 				return 1;
 			}else{
 				return 0;
 			}
 		}

 		// Celular -------------------------------------

 		public function addCelularKey($celularId){
 			$this->celularId = $celularId;
 		}

 		public function getkeyCelular(){
 			return $this->celularId;
 		}

 		public function addCelular($celular){
 			array_push($this->celular, $celular);
 		}

 		public function verificaCelular($key, $celular){
 			$celular = preg_replace('/\s+/','', $celular);
 			if($celular == 'Celular'){
 				$this->celularId = $key;
 				return 1;
 			}else if($celular == 'celular'){
 				$this->celularId = $key;
 				return 1;
 			}else{
 				return 0;
 			}
 		}

 		// Endereço ---------------------------------

 		public function addEnderecoKey($enderecoId){
 			$this->enderecoId = $enderecoId;
 		}

 		public function getkeyEndereco(){
 			return $this->enderecoId;
 		}

 		public function addEndereco($endereco){
 			array_push($this->endereco, $endereco);
 		}

 		public function verificaEndereco($key, $endereco){
 			$endereco = preg_replace('/\s+/','', $endereco);
 			if($endereco == 'Endereço'){
 				$this->enderecoId = $key;
 				return 1;
 			}else if($endereco == 'endereco'){
 				$this->enderecoId = $key;
 				return 1;
 			}else {
 				return 0;
 			}
 		}


 		public function pegarTodosDadosArray(){
 			echo "<br/>".print_r($this->empresa);
 			echo "<br/>".print_r($this->contato);
 			echo "<br/>".print_r($this->telefone);
 			echo "<br/>".print_r($this->celular);
 			echo "<br/>".print_r($this->endereco);
 		}






 	}