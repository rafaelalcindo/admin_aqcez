<?php
	require('db_login_sql.Class.php');

	class Usuario{

		private $nome;
		private $sobrenome;
		private $cargo;
		private $nivel;
		private $login;
		private $senha;
		
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

			echo "Valor do id: ". $id;
			$db_dados 	= new Connection_login();
			$dados_user = $db_dados->getDadosUsuarioId($id);

			$dados_usuario = array();
			while($row = $dados_user->fetch_assoc()){

				$dados_usuario['id'] 		= $row['id'];
				$dados_usuario['id_boss']   = $row['id_boss'];
				$dados_usuario['nome'] 		= utf8_encode($row['nome']);
				$dados_usuario['sobrenome'] = utf8_encode($row['sobrenome']);
				$dados_usuario['cargo'] 	= utf8_encode($row['cargo']);
				$dados_usuario['nivel'] 	= $row['nivel'];
				$dados_usuario['login'] 	= $row['login'];
				
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

		



	}
	