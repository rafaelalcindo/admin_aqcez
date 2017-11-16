<?php
	
	require('db_agenda_sql.Class.php');

	/**
	* 
	*/
	class Agenda 
	{
		private $idCalen;
		private $titulo;
		private $descricao;
		private $info;
		private $data;
		private $hora_ini;
		private $hora_fim;
		private $cor;
		private $cor_significado;
		private $usuario;
		private $telContato;
		private $nomeContato;
		private $endContato;

		private $cargoContato;
		private $emailContato;
		private $enviarPresentacao;
		


		function __construct()
		{
			# code...
		}

		function __destruct(){

		}

		public function getIdCalen(){
			return $this->idCalen;
		}

		public function setIdCalen($idCalen){
			$this->idCalen = $idCalen;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function getDescricao(){
			return $this->descricao;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public function getInfo(){
			return $this->info;
		}

		public function setInfo($info){
			$this->info = $info;
			$color = selecionaCor($info);
			$this->cor = $color;
		}

		public function getData(){
			return $this->data;
		}

		public function setData($data){
			$this->data = $data;
		}

		public function getHoraIni(){
			return $this->hora_ini;
		}

		public function setHoraIni($hora_ini){
			$this->hora_ini = $hora_ini;
		}

		public function getHoraFim(){
			return $this->hora_fim;
		}

		public function setHoroFim($hora_fim){
			$this->hora_fim = $hora_fim;
		}

		public function getCor(){
			return $this->cor;
		}

		public function setCor($cor){
			$this->cor = $cor;
		}

		public function getCorSignificado(){
			return $this->cor_significado;
		}

		public function setCorSignificado($cor_sign){
			$this->cor_significado = $cor_sign;
		}

		public function getUsuario(){
			return $this->usuario;
		}

		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		public function setTelContato($telContato){
			$this->telContato = $telContato;
		}

		public function getTelContato(){
			return $this->telContato;
		}

		public function setNomeContato($nomeContato){
			$this->nomeContato = $nomeContato;
		}

		public function getNomeContato(){
			return $this->nomeConsetEndContatotato;
		}

		public function setEndContato($endContato){
			$this->endContato = $endContato;
		}

		public function getEndContato(){
			return $this->endContato;
		}

		public function setCargoContato($cargoContato){
			$this->cargoContato = $cargoContato;
		}

		public function getCargoContato(){
			return $this->cargoContato;
		}

		public function setEmailContato($emailContato){
			$this->emailContato = $emailContato;
		}

		public function getEmailContato(){
			return $this->emailContato;
		}
		
		public function setEnviarPresentacao($enviarPresentacao){
			$this->enviarPresentacao = $enviarPresentacao;
		}

		public function getEnviarPresentacao(){
			return $this->enviarPresentacao;
		}

		

		public function unirAgendaUsuario($usuario){
			$db_agenda = new connection_agenda();
			//echo "Usuario: ".print_r($usuario);
			$agenda = array();
			$agenda['titulo']          = $this->titulo;
			$agenda['desc'] 	       = $this->descricao;
			$agenda['info']            = $this->info;
			$agenda['data'] 	       = $this->data;
			$agenda['hora_ini']        = $this->hora_ini;
			$agenda['hora_fim']        = $this->hora_fim;
			$agenda['cor'] 	 	       = $this->cor;
			$agenda['cor_sign']        = $this->cor_significado;
			$agenda['tel_contato']     = $this->telContato;
			$agenda['nome_contato']    = $this->nomeContato;
			$agenda['end_contato']	   = $this->endContato;
			$agenda['cargo_contato']   = $this->cargoContato;
			$agenda['email_contato']   = $this->emailContato;
			$agenda['enviar_presenta'] = $this->enviarPresentacao;
			

			
			//echo "Agenda: ".print_r($agenda);
			$resuAgenda = $db_agenda->salvarAgenda($agenda, $usuario);
			if($resuAgenda){
				
				return true;
			}else{ return false; }

		}


		public function PegarCalendarioEventos(){
			header('Content-Type: application/json; charset=utf-8');
			$db_agenda = new connection_agenda();
			$agenda_calendario = $db_agenda->pegarEventosAgenda();
			//echo "Resultado: ".print_r($agenda_calendario)." <br/>";
			$agenda_array = array();
			$agenda_array_format = array();
			while($row = $agenda_calendario->fetch_assoc()){
				$agenda_array['id']    			 = $row['id'];
				$agenda_array['title'] 			 = utf8_encode(utf8_decode($row['titulo']));
				$agenda_array['desc'] 			 = utf8_encode(utf8_decode($row['desc']));
				$agenda_array['info'] 			 = $row['info'];
				$agenda_array['start'] 			 = $row['data']."T".$row['inicio'];
				$agenda_array['end']   			 = $row['data']."T".$row['fim'];
				$agenda_array['url'] 			 = '';
				$agenda_array['backgroundColor'] = isset($row['color'])? $row['color'] : 'pink';
				$agenda_array_format[] = $agenda_array;
				unset($agenda_array);
			}
			
			$agenda_json = json_encode($agenda_array_format);
			//echo "<br/><br/>Resultado: ".print_r($agenda_array_format)." <br/>";
			//echo "<br/><br/>Resultado:".print_r($agenda_json)."<br/>";
			return $agenda_json;

		}

		public function getCalenInfo($id_cale,$editar){
			$db_cale_info = new connection_agenda();
			$cale_info    = $db_cale_info->getDescAgenda($id_cale);	

			$info_agenda = array();
			$info_array  = array();
			$info_agenda['result'] = true;

			while($row = $cale_info->fetch_assoc()){
				$info_agenda['nome'] 	  	  = utf8_encode(utf8_decode($row['nome']));
				$info_agenda['sobrenome'] 	  = utf8_encode(utf8_decode($row['sobrenome']));
				$info_agenda['cargo'] 	  	  = utf8_encode(utf8_decode($row['cargo']));
				$info_agenda['titulo'] 	  	  = utf8_encode(utf8_decode($row['titulo']));
				$info_agenda['nivel'] 	  	  = $row['nivel'];
				$info_agenda['desc']      	  = utf8_encode(utf8_decode($row['desc']));
				$info_agenda['info']      	  = ajustarInfo($row['info']);
				$info_agenda['data'] 	  	  = $row['data'];
				$info_agenda['h_inicio']  	  = $row['h_inicio'];
				$info_agenda['h_fim']     	  = $row['h_fim'];
				$info_agenda['color'] 	  	  = isset($row['color'])? $row['color'] : 'pink';
				$info_agenda['editar']    	  = $editar;
				$info_agenda['tel_contato']   = $row['tel_contato'];
				$info_agenda['nome_contato']  = utf8_encode(utf8_decode($row['nome_contato']));
				$info_agenda['end_contato']   = utf8_encode(utf8_decode($row['end_contato']));
				$info_agenda['cargo_contato'] = utf8_encode(utf8_decode($row['cargo_contato']));
				$info_agenda['email_contato'] = utf8_encode(utf8_decode($row['email_contato']));
				$info_agenda['presentacao']	  = $row['presentacao'];
				$info_array[] = $info_agenda;
				unset($info_agenda);
			}
			//echo "array: ".print_r($info_agenda);
			return $info_array;

		}

		public function ErrorPermission(){
			$info_array = array();
			$info_array['result'] = false;
			return json_encode($info_array);
		}

		public function alterCalen($id_cale, $id_quem_vai){
			$db_agenda_edit = new connection_agenda();
			$agenda = array();
			$agenda['titulo']   = $this->titulo;
			$agenda['desc']     = $this->descricao;
			$agenda['data']     = $this->data;
			$agenda['h_inicio'] = $this->hora_ini;
			$agenda['h_fim']    = $this->hora_fim;
			$agenda['info'] 	= $this->info;
			$agenda['cale_id']  = $id_cale;
			$agenda['quem_vai'] = $id_quem_vai;

			$agenda['tel_contato']     = $this->telContato;
			$agenda['nome_contato']    = $this->nomeContato;
			$agenda['end_contato']	   = $this->endContato;
			$agenda['cargo_contato']   = $this->cargoContato;
			$agenda['email_contato']   = $this->emailContato;
			$agenda['enviar_presenta'] = $this->enviarPresentacao;

			$resu_alter_cale = $db_agenda_edit->editarAgenda($agenda);
			if($resu_alter_cale){
				return true;
			}else{ return false; }


		}

		public function deleteCalendar($id_cale, $id_user){
			$db_deleting_Agenda = new connection_agenda();
			$resu_delete = $db_deleting_Agenda->deletarAgenda($id_cale);
			if($resu_delete){ return true; }else{ return false; }
		}


		// ==================================== Relatorio agenda ====================================


		public function ListarReuniaoMarcado($data){
			$db_relatos = new connection_agenda();
			$resultNomes   	 = $db_relatos->pegarNomesDepComercio();
			$nomes_array 	 = array();
			$nomes_array_aux = array();
			
			if($data[1] == null ){
				$resultDatas = $db_relatos->ListarDataSelecionada($data);
			}else{
				$resultDatas = $db_relatos->ListarDatasSelecionada($data);				
			}

			if($resultNomes != false && $resultDatas != false){
				while($row = $resultNomes->fetch_assoc()){
					$nomes_array['nome'] 	  = $row['nome'];
					$nomes_array['sobrenome'] = $row['sobrenome'];
					$nomes_array_aux[] = $nomes_array;
					unset($nomes_array);
				}
				echo "<br/>Resultado array: ".print_r($nomes_array_aux);
				exit;
			}else{ return false; }

		}



		// selecionar Cor
		
		

	}

	function selecionaCor($info){
			if($info == 'Pessoal'){
				return '#EB6021';
			}else if($info == 'Reuniao_propria'){
				return '#0B3E4C';
			}else if($info == 'Reuniao_ferramenta'){
				return '#17713B';
			}else if($info == 'Compromisso_aqcez'){
				return '#612B70';
			}else if($info == 'go_construct'){
				return '#737373';
			}else{
				return null;
			}
	}

	function ajustarInfo($info){
		if($info == 'Pessoal'){
			return 'Pessoal';
		}else if($info == 'Reuniao_propria'){
			return 'Reunião Própria';
		}else if($info == 'Reuniao_ferramenta'){
			return 'Reunião Ferramenta';
		}else if($info == 'Compromisso_aqcez'){
			return 'Compromisso Aqcez';
		}else if($info == 'go_construct'){
			return 'Go Construct';
		}
	}

	

	