<?php
	require('db_login_sql.Class.php');

	class Usuario{

		private $nome;
		private $sobrenome;
		private $cargo;
		private $nivel;
		private $login;
		private $senha;

		private $chefe;
		private $departamento;
		private $email;
		private $permissao;
		
		public function __construct(){

		}

		public function __destruct(){

		}

		public function getNome(){
			return $this->nome;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getSobrenome(){
			return $this->sobrenome;
		}

		public function setSobrenome($sobrenome){
			$this->sobrenome = $sobrenome;
		}

		public function getCargo(){
			return $this->cargo;
		}

		public function setCargo($cargo){
			$this->cargo = $cargo;
		}

		public function getNivel(){
			return $this->nivel;
		}

		public function setNivel($nivel){
			$this->nivel = $nivel;
		}

		public function getLogin(){
			return $this->login;
		}

		public function setLogin($login){
			$this->login = $login;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function getSenha(){
			return $this->senha;
		}


		public function setChefe($chefe){
			$this->chefe = $chefe;
		}

		public function getChefe(){
			return $this->chefe;
		}

		public function setDepartamento($deporatamento){
			$this->departamento = $deporatamento;
		}

		public function getDepartamento(){
			return $this->departamento;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setPermissao($permissao){
			$this->permissao = $permissao;
		}

		public function getPermissao(){
			return $this->permissao;
		}



		// ================================== Métodos de Ação =========================================================


		public function verificaUsuario($login, $senha){
			$db_login = new Connection_login();
			$verification = $db_login->verificaUsuariDb($login, $senha);
			if($verification){
				return true;
			}else{ return false; }
		}

		public function logarUsuario($login, $senha){
			$db_login  = new Connection_login();
			$logarUser = $db_login->pegarDadosUsuario($login, $senha);
			$usuario_dados = array();
			while($row = $logarUser->fetch_assoc()){
				$usuario_dados['id']        = $row['id'];
				$usuario_dados['nome']      = utf8_encode($row['nome']);
				$usuario_dados['sobrenome'] = utf8_encode($row['sobrenome']);
				$usuario_dados['cargo']     = utf8_encode($row['cargo']);
				$usuario_dados['nivel']		= $row['nivel'];
				$usuario_dados['login']    	= $row['login'];
				$usuario_dados['senha']		= $row['senha'];
				$usuario_dados['position']  = $row['position'];
				$usuario_dados['email']		= $row['email'];
				$usuario_dados['dep']		= $row['dep'];
			}
			$usuario_dados['logar'] = true;
			header("Content-Type: application/json");
			$usu_dados_json = json_encode($usuario_dados);
			unset($usuario_dados);
			return $usu_dados_json;
		}

		public function puxarDadosUsuario($login, $senha){

		}

		public function verificarPermissoes($login, $senha){
			
		}

		public function puxarDadosUsuarioId($id){
			$db_dados 	= new Connection_login();
			$dados_user = $db_dados->getDadosUsuarioId($id);
			$dados_usuario = array();
			while($row = $dados_user->fetch_assoc()){
				$dados_usuario['id'] 		= $row['id'];
				$dados_usuario['nome'] 		= utf8_encode($row['nome']);
				$dados_usuario['sobrenome'] = utf8_encode($row['sobrenome']);
				$dados_usuario['cargo'] 	= utf8_encode($row['cargo']);
				$dados_usuario['nivel'] 	= $row['nivel'];
				$dados_usuario['login'] 	= $row['login'];
				$dados_usuario['gcm']		= $row['gcm'];
				$dados_usuario['email']		= $row['email'];
			}
			return $dados_usuario;
		}

		//---------------------------  Parte da Agendas --------------------------------------------------------

		public function getDadosLigarAgenda($login, $senha){
			$db_dados  = new Connection_login();
			$dadosUser = $db_dados->pegarDadosUsuario($login,$senha);
			$dados_usuario = array();
			while ($row = $dadosUser->fetch_assoc()){
				$dados_usuario['id']   		= $row['id'];
				$dados_usuario['nome'] 		= utf8_encode($row['nome']);
				$dados_usuario['sobrenome'] = utf8_encode($row['sobrenome']);
				$dados_usuario['cargo'] 	= utf8_encode($row['cargo']);
				$dados_usuario['nivel']		= $row['nivel'];
				$dados_usuario['login']		= $row['login'];

			}
			return $dados_usuario;
		}



		public function getNomesVendedores(){

			$db_dados = new Connection_login();
			$dadosListaVendedor = $db_dados->getDadosVendedores();
			$dadosVendedores = array();
			$dadosVendHelp   = array();
						

			while($row = $dadosListaVendedor->fetch_assoc() ){
				$dadosVendHelp['id']          = $row['id'];
				$dadosVendHelp['nome'] 	      = utf8_encode($row['nome']);
				$dadosVendHelp['sobrenome']   = utf8_encode($row['sobrenome']);
				$dadosVendHelp['quant_reuni'] = $db_dados->getQuantReuni($row['id']);
				$dadosVendedores[] = $dadosVendHelp;
				unset($dadosVendHelp);
			}
			header('Content-Type: application/json');
			$dadosVendJson = json_encode($dadosVendedores);
			unset($dadosVendedores);
			return $dadosVendJson;
		}


		public  function getDadosVendedoresComercial(){
			$db_dados = new Connection_login();
			$dadosListaVendedor = $db_dados->getDadosVendedoresComercial();
			$dadosVendedores  = array();
			$dadosVendHelp	  = array();

			while($row = $dadosListaVendedor->fetch_assoc()){
				$dadosVendHelp['id'] 		  = $row['id'];
				$dadosVendHelp['nome']		  = utf8_encode($row['nome']);
				$dadosVendHelp['sobrenome']   = utf8_encode($row['sobrenome']);				
				$dadosVendedores[] = $dadosVendHelp;
				unset($dadosVendHelp);
			}

			$dadosVendJson = json_encode($dadosVendedores);
			unset($dadosVendedores);
			return $dadosVendJson;

		}


		public function getNomeMarcReuni($id_user){
			$db_dados = new Connection_login();
			$dados_permission = $db_dados->getPermissionVerCalendario($id_user);
			$row = $dados_permission->fetch_assoc();
			$dadosVendedores = array();
			$dadosVendHelp 	 = array();
			$nivelUser = (int) $row['nivel'];

			if($nivelUser <= 2){
				$dados_vend = $db_dados->getDadosVendedoresSelect();

				while($row = $dados_vend->fetch_assoc()){
					$dadosVendHelp['id'] 		= $row['id'];
					$dadosVendHelp['nome']  	= utf8_encode($row['nome']);
					$dadosVendHelp['sobrenome'] = utf8_encode($row['sobrenome']);
					$dadosVendedores[] = $dadosVendHelp;
					unset($dadosVendHelp);
				}
				
				return $dadosVendedores;
			}else{
				$dados_vend = $db_dados->getDadosVendMarcar($id_user);
				while($row = $dados_vend->fetch_assoc()){
					$dadosVendHelp['id'] 	    = $row['id'];
					$dadosVendHelp['nome'] 	    = utf8_encode($row['nome']);
					$dadosVendHelp['sobrenome'] = utf8_encode($row['sobrenome']);
					$dadosVendedores[] = $dadosVendHelp;
					unset($dadosVendHelp);
				}
												
				return $dadosVendedores;
			}// fim do else dados pessoais marcar reuni
		}

		public function getNomeConvidadoReuni(){
			$db_dados 	= new Connection_login();
			$dados_vend = $db_dados->getDadosVendedoresSelect();
			$dadosVendHelp 	 = array();
			$dadosVendedores = array();

			while( $row = $dados_vend->fetch_assoc()){
				$dadosVendHelp['id'] 		= $row['id'];
				$dadosVendHelp['nome']  	= utf8_encode($row['nome']);
				$dadosVendHelp['sobrenome'] = utf8_decode($row['sobrenome']);
				$dadosVendedores[] = $dadosVendHelp;
				unset($dadosVendHelp);
			}

			return $dadosVendedores;
		}

		public function registrarGCM($login, $senha, $gcm){
			$db_inserGcm = new Connection_login();
			$resul_insert = $db_inserGcm->salvarRegistroGCM($login, $senha, $gcm);
			if($resul_insert){ return true; }else{ return false; }
		}

		public function enviarNotificationPush($id_user){
			$db_dados 	= new Connection_login();
			$dados_user = $db_dados->getDadosUsuarioId($id_user);
			$dados_usuario = array();
			while($row = $dados_user->fetch_assoc()){
				$dados_usuario['id'] 		= $row['id'];
				$dados_usuario['nome'] 		= utf8_encode($row['nome']);
				$dados_usuario['sobrenome'] = utf8_encode($row['sobrenome']);
				$dados_usuario['cargo'] 	= utf8_encode($row['cargo']);
				$dados_usuario['nivel'] 	= $row['nivel'];
				$dados_usuario['login'] 	= $row['login'];
				$dados_usuario['gcm']		= $row['gcm'];
			}
			
			$resu_noti = $db_dados->enviarNotificationPush($dados_usuario);			
			return $resu_noti;
		}

		public function enviarNotificationPushDinamica($id_user, $menssagem){
			$db_dados 		= new Connection_login();
			$dados_user		= $db_dados->getDadosUsuarioId($id_user);
			$dados_usuario = array();
			while($row = $dados_user->fetch_assoc()){
				$dados_usuario['id'] 		= $row['id'];
				$dados_usuario['nome']		= $row['nome'];
				$dados_usuario['sobrenome'] = $row['sobrenome'];
				$dados_usuario['cargo']		= $row['cargo'];
				$dados_usuario['nivel']		= $row['nivel'];
				$dados_usuario['login']		= $row['login'];
				$dados_usuario['gcm']		= $row['gcm'];
			}
			$resu_noti = $db_dados->EnviarNotificationPushDinamica($dados_usuario, $menssagem);
			return $resu_noti;
		}

		public function pegarEmailsPorIds($ids){
			$db_dados 		= new Connection_login();
			$emails 		= array();
			foreach ($ids as $key => $value) {
				$resultado = $db_dados->getDadosUsuarioId($value);
				$result    = $resultado->fetch_assoc();
				$emails[]  = $result['email'];
			}
			return $emails;
		}

		// ======================================= Cadastrar Usuário =======================================

		public function cadastrarUsuario(){

			$dd_inserirusuario = new Connection_login();

			$inserirUsuario = array();
			$inserirUsuario['nome'] 	 	= $this->nome;
			$inserirUsuario['sobrenome'] 	= $this->sobrenome;
			$inserirUsuario['cargo']	 	= $this->cargo;
			$inserirUsuario['nivel']	 	= $this->nivel;
			$inserirUsuario['login']	 	= $this->login;
			$inserirUsuario['senha']	 	= $this->senha;
			$inserirUsuario['chefe']	 	= $this->chefe;
			$inserirUsuario['dep'] 			= $this->departamento;
			$inserirUsuario['email']		= $this->email;
			$inserirUsuario['permissao']	= $this->permissao;

			$resultado = $dd_inserirusuario->cadastrarUser($inserirUsuario);
			if($resultado){ return true; }else{ return false; }

		}

		// ==================================== PermissõesParaCadNoticias ===================================

		public function permissaoCadNoticias($id){
			$db_dados = new Connection_login();
			$resultado = $db_dados->VerificarPermissao($id);
			$permissao = $resultado->fetch_assoc();
			if(!$permissao){
				return false;
			}else{
				if($permissao['permissao'] == 256 || $permissao['permissao'] == 376){
					return true;
				}else{ return false; }
			}

		}


		// =============================== Pegar Email de todos do departamento ===============================

		public function PegarTodosEmailsDepartamento(){
			$db_dados = new Connection_login();
			$resultado = $db_dados->GetAllEmails();
			$email_array = array();
			if(!$resultado){
				return false;
			}else{
				while($row = $resultado->fetch_assoc()){
					$email_array['email'] = $row['email'];
				}

				//echo print_r($email_array);
			}
		}


		//========================================== Funções Helpers ======================================



		function verificarEventoPermission($id_user){
			$db_dadosCalPerm = new Connection_login();
			$resu_calPerm    = $db_dadosCalPerm->getPermissionVerCalendario($id_user);
			$row = $resu_calPerm->fetch_assoc();
			$nivelUser  = (int) $row['nivel'];

			if($nivelUser <= 3){
				return true;
			}else{ return false; }			
		}

		function verificaPodeEditar($id_user, $cale_id){
			$db_dadosPodeEditar = new Connection_login();
			$resu_editar 		= $db_dadosPodeEditar->verificaSeusFuncionarios($id_user);
			if($resu_editar){
				
				return true;
			}else{
				$resu_editar = $db_dadosPodeEditar->verificaSeuCalendario($id_user, $cale_id);
				if($resu_editar){
					
					return true;
				}else{ 
					$resu_editar = $db_dadosPodeEditar->verificaAcimaDoChefe($id_user);
					if($resu_editar){
						
						return true;
					}else{ return false; }
				 }
			}
		}






		// ================================ Enviar Notificação push ================================

		/*function enviarNotificaitionPush($usuario){
			$to = $usuario['gcm'];
			define( 'API_ACCESS_KEY', 'AIzaSyBqa0xsTSf70YmE7CELG8yjOQ9iO9LxjIc');
			$title="Você possui um novo agendamento.";
			$message= "Olá ".usuario['nome']." ".usuario['sobrenome']." Você possui novos agendamentos, entre no App e confira ";
			$image = "https://d30y9cdsu7xlg0.cloudfront.net/png/58041-200.png";

			$registrationIds = array($to);
		    $msg = array('message' => $message,'title' => $title,'vibrate' => 1,'sound' => 1, 'image' => $image);
		    $fields = array('registration_ids' => $registrationIds, 'data' => $msg, 'image_url' => $image );
		    $headers = array('Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json');
		    $ch = curl_init();
		    
		    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		    curl_setopt( $ch,CURLOPT_POST, true );
		    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		    $result = curl_exec($ch);
		    curl_close( $ch );		    
			$resu_array = json_decode($result);
			echo $resu_array->success;
		    if($resu_array->success){
		    	return true;
		    }else{ return false; }

		} */



	}
	