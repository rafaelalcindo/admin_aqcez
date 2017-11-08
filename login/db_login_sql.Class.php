<?php

	require_once('../db_connection.php');

	class Connection_login{
		private $conexao;

		public function __construct(){
			$db_connection = new Db_connectio();
            $this->conexao = $db_connection->getConnection();
		}

		public function verificaUsuariDb($login, $senha){
			$sql_veri = sprintf("select * from usuario where usuario_login = '%s' and usuario_senha = '%s' ",$login,$senha);
			$resul_consu = $this->conexao->query($sql_veri);

			//echo "<br/> resu consul: ".print_r($resul_consu);

			if($resul_consu->num_rows > 0){
				return true;
			}else{ return false; }

		}


		public function pegarDadosUsuario($login, $senha){
			$sql_get_user = sprintf("SELECT usuario_id as 'id', usuario_nome as 'nome', usuario_sobrenome as 'sobrenome',  
					usuario_cargo as 'cargo', usuario_nivel as 'nivel', usuario_login as 'login', usuario_senha as 'senha',
					usuario_posi_vend as 'position', usuario_email as 'email', usuario_dep as 'dep'
					FROM usuario
					where
					usuario_login = '%s' and
					usuario_senha = '%s'",$login, $senha);
			$resul_consu = $this->conexao->query($sql_get_user);

			if($resul_consu->num_rows == 1){
				return $resul_consu;
			}else{ return false; }
		}

		// pegar dados vendedores

		public function getDadosVendedores(){

			$sql_get_sellers = sprintf("select usuario_id as 'id', usuario_nome as 'nome', usuario_sobrenome as 'sobrenome' from usuario where usuario_nivel <= 3 and usuario_nivel > 1 ");
			$resu_consu = $this->conexao->query($sql_get_sellers);
			if($resu_consu->num_rows > 0){
				return $resu_consu;
			}else{
				return false;
			}
		}

		public function getDadosVendedoresSelect(){

			$sql_get_sellers = sprintf("select usuario_id as 'id', usuario_nome as 'nome', usuario_sobrenome as 'sobrenome' from usuario where usuario_nivel <= 3  and usuario_nivel > 1 ");
			$resu_consu = $this->conexao->query($sql_get_sellers);
			if($resu_consu->num_rows > 0){
				return $resu_consu;
			}else{
				return false;
			}
		}

		public function getQuantReuni($id_user){
			$sql_qntReuni = sprintf("select
										count(*) as 'qt_reuni'
										from usuario usu, usuario_has_calendario uhc, calendario cale
										where
										usu.usuario_id 	   	  = uhc.usuario_usuario_id 	  and
										cale.calendario_id 	  = uhc.calendario_calendario_id and
										(cale.calendario_color = '#17713B' or cale.calendario_color = '#0B3E4C')
										and cale.calendario_data >= curdate() and
										usu.usuario_id = '%u' ",$id_user);
			$resu_qntReuni =  $this->conexao->query($sql_qntReuni);
			if($resu_qntReuni->num_rows > 0){
				while($row = $resu_qntReuni->fetch_assoc()){
					$qnt_reuni = $row['qt_reuni'];
				}
				return $qnt_reuni;				
			}else{
				return 0;
			}
		}

		// fim pegar dados vendedores
		public function getDadosVendMarcar($id_user){
			$sql_get_marcReu = sprintf("select usuario_id as 'id', usuario_nome as 'nome', usuario_sobrenome as 'sobrenome' from usuario where usuario_id = '%u' and usuario_nome <> 'admin' ",$id_user);
			$resu_consu = $this->conexao->query($sql_get_marcReu);

			if($resu_consu->num_rows > 0){
				return $resu_consu;
			}else{ return false; }
		}
		
		public function getDadosUsuarioId($id){
			$sql_get_dadosId = sprintf("SELECT usuario_id as 'id', usuario_nome as 'nome', usuario_sobrenome as 'sobrenome',  
					usuario_cargo as 'cargo', usuario_nivel as 'nivel', usuario_login as 'login', usuario_senha as 'senha',
					usuario_cod_gcm as 'gcm'
					FROM usuario where usuario_id = '%u' ", $id);
			$resu_consuId = $this->conexao->query($sql_get_dadosId);
			if($resu_consuId->num_rows > 0){
				return $resu_consuId;
			}else{ return false; }
		}

		
		public function getPermissionVerCalendario($id){
			$sql_get_permissionVisuCalen = sprintf("select usuario_nivel as 'nivel' from usuario where usuario_id = '%u' ",$id);
			$resu_consuPermiVisuCalen = $this->conexao->query($sql_get_permissionVisuCalen);
			//	echo "Visao permission: ".print_r($resu_consuPermiVisuCalen);
			if($resu_consuPermiVisuCalen->num_rows > 0){
				return $resu_consuPermiVisuCalen;
			}else{ return false; }
		}


		// Privilegio de editar calendario -----------------------------------------------------------------------

		public function verificaSeusFuncionarios($id){
			$sql_verifica_func = sprintf("select usu.usuario_nome as 'nome', usu.usuario_sobrenome as 'sobrenome', usu.usuario_usuario_id as 'id_chefe', chefe.usuario_nome as 'boss'
from usuario usu, usuario chefe where usu.usuario_usuario_id = '%u' and chefe.usuario_id = usu.usuario_usuario_id",$id);
			$resu_veri_func = $this->conexao->query($sql_verifica_func);
			if($resu_veri_func->num_rows > 0){
				return true;
			}else{
				false;
			}
		}

		public function verificaSeuCalendario($id, $caleId){
			
			$sql_verifica_seuCale = sprintf("select
					usu.usuario_nome as 'nome', usu.usuario_cargo as 'cargo', usu.usuario_nivel as 'nivel', 
					cale.calendario_titulo as 'titulo', cale.calendario_desc as 'desc'
					from usuario usu, calendario cale, usuario_has_calendario usuCale where
					usu.usuario_id     = usuCale.usuario_usuario_id and
					cale.calendario_id = usuCale.calendario_calendario_id and
					usuCale.usuario_usuario_id = '%u' and
					usuCale.calendario_calendario_id = '%u' ",$id, $caleId);

			$resu_veri_seuCale = $this->conexao->query($sql_verifica_seuCale);
			if($resu_veri_seuCale->num_rows > 0){
				return true;
			}else{ return false; }			
		}

		public function verificaAcimaDoChefe($id){
			
			$sql_verificaChefoes = sprintf("select usuario_nome from usuario where usuario_id = '%u' and usuario_nivel <= 2", $id);
			$resu_veriChefe = $this->conexao->query($sql_verificaChefoes);
			if($resu_veriChefe->num_rows > 0){
				return true;
			}else{ return false; }
		}

		// ========================================== Registrar GCM ================================================

		public function salvarRegistroGCM($login, $senha, $gcm){
			$sql_insert = sprintf("update usuario set usuario_cod_gcm = '%s' where usuario_login = '%s' and usuario_senha = '%s' ", $gcm, $login, $senha);
			$resu_update = $this->conexao->query($sql_insert);
			if($resu_update){
				return true;
			}else{ return false; }
		}

		// ======================================= Enviar Notification Push ========================================

		public function enviarNotificationPush($usuario){
			$to = $usuario['gcm'];
			define( 'API_ACCESS_KEY', 'AIzaSyBqa0xsTSf70YmE7CELG8yjOQ9iO9LxjIc');
			$title="Você possui um novo agendamento.";
			$message= "Olá ".$usuario['nome']." ".$usuario['sobrenome']." Você possui novos agendamentos, entre no App e confira ";
			$image = "http://aqcez.com.br/ameeting.png.png";

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
			
		    if($resu_array->success){
		    	return true;
		    }else{ return false; }
		}


		// ============================================== Cadastrar Noticias Permissão ==================================

		public function VerificarPermissao($id){
			$sql_veri   = sprintf("select usuario_permissao_cad as 'permissao' from usuario where usuario_id = %u ", $id);
			$resu_query = $this->conexao->query($sql_veri); 
			if($resu_query->num_rows > 0){
				return $resu_query;
			}else{ return false; }
		}

		// =========================================== Cadastrar Usuário =======================================

		public function cadastrarUser($user){
			
			$stmt = $this->conexao->prepare("insert into usuario
				(usuario_nome, usuario_sobrenome, usuario_cargo, usuario_dep, usuario_nivel, usuario_login, usuario_senha, usuario_usuario_id, 
													usuario_email, usuario_permissao_cad)
													values
													(?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");

			$stmt->bind_param('ssssissisi',$user['nome'], $user['sobrenome'], $user['cargo'], $user['dep'], $user['nivel'], $user['login'], $user['senha'], $user['chefe'], $user['email'], $user['permissao']);

			$resultado = $stmt->execute();
			if($resultado){ return true; }else{ return false; }
		}
				

	}