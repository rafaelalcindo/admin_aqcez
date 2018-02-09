<?php

	require_once '../vendor/autoload.php';
	require_once('ContatoQuery.Class.php');
	require_once('../models/mdl_contatos.php');

	use PhpOffice\PhpSpreadsheet\IOFactory;
 	
 	class ExcellComercial extends ContatoQuery
 	{

 		private $projeto = array();
 		
 		
 		function __construct()
 		{
 			
 		}

 		public function checkDiretorioUpload($id_dono){
 			$target_dir = "../upload_excell/".$id_dono;
 			if(!is_dir($target_dir)){
 				mkdir($target_dir);
 				return $target_dir;
 			}else{
 				return $target_dir;
 			}
 		}

 		public function verificaExtensaoArquivo($arquivo){
 			$nameFile = $arquivo['name'];
 			$nameFileArray = explode(".", $nameFile);
 			$ext 	  	   = end($nameFileArray);
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
 			$this->projeto['mes'] 			 = validaMes( $valores['C'] );
 			$this->projeto['ano'] 			 = $valores['D'];
 			$this->projeto['projeto'] 	  	 = $valores['F'];
 			$this->projeto['turn_key']	 	 = $valores['G'];
 			$this->projeto['interiores'] 	 = $valores['H'];
 			$this->projeto['mobiliario'] 	 = $valores['I'];
 			$this->projeto['total'] 	  	 = $valores['J'];
 			$this->projeto['situacao']	  	 = selecionarSituacao($valores['K']);
 			$this->projeto['motivo']	  	 = selecionaMotivo($valores['L']);
 			$this->projeto['probabilidade']  = $valores['M'];
 			$this->projeto['sinal_empresa']  = sinalEmpresa($valores['M']);
 			$this->projeto['observacao']	 = $valores['N'];
 		}

 		public function verificaAtualizacao($id_dono){
 			$sql_query_veriProjeto = parent::queryVerificaProjeto($this->projeto['projeto'], $id_dono);
 			//echo "<br/>".$sql_query_veriProjeto;
 			$db_contatos 		   = new model_connection_contato();
 			$resultado 			   = $db_contatos->Consultar($sql_query_veriProjeto);
 			//echo "resultado ".var_dump($resultado);

 			//verifica se realmente o projeto já existe no banco
 			if($resultado != false){
 				// atualizar
 				$sql_atualizar = parent::atualizarListaExcell($this->projeto, $id_dono);
 				//echo "<br/>".$sql_atualizar;
 				$resultado	   = $db_contatos->Editar($sql_atualizar);
 				//echo "<br/> resu: ".$resultado;
 				if($resultado){ return $resultado; }else{ return false; }
 			}else{
 				// cadastrar
 				//echo "<br/>entrou cadastrar";
 				$sql_cadastro  = parent::cadastrarListaExcell($this->projeto, $id_dono);
 				//echo "<br/>".$sql_cadastro;
 				$resultado	   = $db_contatos->Inserir($sql_cadastro);
 				if($resultado){ return $resultado; }else{ return false; }
 			}
 		}


 	}


	function sinalEmpresa($sinal){
		if($sinal >= 0 && $sinal < 25){
			$sinal_fechamento = '#ff1a1a';
			return $sinal_fechamento;
		}else if($sinal >= 25 && $sinal < 50){
			$sinal_fechamento = '#ff751a';
			return $sinal_fechamento;
		}else if($sinal >=50 && $sinal < 75){
			$sinal_fechamento = '#ffff1a';
			return $sinal_fechamento;
		}else if($sinal >= 75){
			$sinal_fechamento = '#53ff1a';
			return $sinal_fechamento;
		}
	}

 	function selecionarSituacao($num){
 		if($num == 1){
 			$situacao = "Em Andamento";
 			return $situacao;
 		}else if($num == 2){
 			$situacao = "Finalizado Positivo";
 			return $situacao;
 		}else if($num == 3){
 			$situacao = "Finalizado Negativo";
 			return $situacao; 
 		}
 	}

 	function selecionaMotivo($num){
 		if($num == 1){
 			$motivo = "Preço";
 			return $motivo;
 		}else if($num == 2){
 			$motivo = "Prazo";
 			return $motivo;
 		}else if($num == 3){
 			$motivo = "Qualidade";
 			return $motivo;
 		}else if($num == 4){
 			$motivo = "Atendimento";
 			return $motivo;
 		}else if($num == 5){
 			$motivo = "Assistência Técnica";
 			return $motivo;
 		}else if($num == 6){
 			$motivo = "Concorrência";
 			return $motivo;
 		}else if($num == 7){
 			$motivo = "Análise";
 			return $motivo;
 		}else if($num == 8){
 			$motivo = "Suspens";
 			return $motivo;
 		}else if($num == 9){
 			$motivo = "Cancel";
 			return $motivo;
 		}
 	}



 	function validaMes($mes){
 		$mes = "".$mes; 		
 		if(strpos($mes, "0") !== false){ 			
 			if(strlen($mes) == 2){
 				return $mes;
 			}
 		}else{ 
 			if(strlen($mes) == 2){
 				return $mes;
 			}else{ return "0".$mes; }
 		}
 	}

















 	// ============================== ferifica atualizacao ==========================

