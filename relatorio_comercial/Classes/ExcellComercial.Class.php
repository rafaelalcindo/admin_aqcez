<?php

	require_once 'vendor/autoload.php';
	require_once('ContatoQuery.Class.php');
	require_once('../models/mdl_contatos.php');

	use PhpOffice\PhpSpreadsheet\IOFactory;
 	
 	class ExcellComercial extends ContatoQuery
 	{

 		private $projeto = array();
 		
 		
 		function __construct()
 		{
 			
 		}

 		public  function criarObjetoFromExcell($file){
 			$inputFileType = 'Xls';
 			$inputFileName = $file;

 			$reader 	 = IOFactory::createReader($inputFileType);
 			$spreadsheet = $reader->load($inputFileName);

 			$sheetData	 = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
 			return $sheetData;
 		}

 		public function InserirNomes($valores){
 			$this->projeto['dia'] 	   		 = $valores['B'];
 			$this->projeto['mes'] 			 = $valores['C'];
 			$this->projeto['ano'] 			 = $valores['D'];
 			$this->projeto['projeto'] 	  	 = $valores['F'];
 			$this->projeto['turn_key']	 	 = $valores['G'];
 			$this->projeto['interiores'] 	 = $valores['H'];
 			$this->projeto['mobiliario'] 	 = $valores['I'];
 			$this->projeto['total'] 	  	 = $valores['J'];
 			$this->projeto['situacao']	  	 = $valores['K'];
 			$this->projeto['motivo']	  	 = $valores['L'];
 			$this->projeto['probabilidade']  = $valores['M'];
 			$this->projeto['observacao']	 = $valores['N'];
 		}

 		public function verificaAtualizacao(){
 			$sql_query_veriProjeto = parent::queryVerificaProjeto($this->projeto['projeto']);
 			$db_contatos 		   = new model_connection_contato();
 			$resultado 			   = $db_contatos->Consultar($sql_query_veriProjeto);

 			//verifica se realmente o projeto já existe no banco
 			if($resultado != false){

 			}
 		}


 	}


 	function construirString()

















 	// ============================== ferifica atualizacao ==========================

