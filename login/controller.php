<?php

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: X-Requested-With, Content-Type'); 

require('../connection.php');

	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	if(mysqli_connect_errno($con)){
		echo "Falha ao carregar a Página, problema no banco de dados";
		exit();
	}

session_start();



require('usuario.Class.php');



$request_type = isset($_REQUEST['login'])?   $_REQUEST['login']   : null;
$login_usu 	  = isset($_REQUEST['usuario'])? $_REQUEST['usuario'] : null;
$senha_usu	  = isset($_REQUEST['senha'])?   $_REQUEST['senha']   : null;
$gcm_usu	  = isset($_REQUEST['gcm'])?	 $_REQUEST['gcm']	  : null;
$id_usu		  = isset($_REQUEST['id'])?		 $_REQUEST['id']	  : null;

switch ($request_type) {
	case 'logarUsuario':
	 	fazerLogin($login_usu, $senha_usu);
	break;

	case 'sessionUsuario':
		autenticarUsuario();
	break;

	case 'sessionUsuarioPhone':
		autenticarUsuarioPhone($login_usu, $senha_usu);
	break;

	case 'deslogar':
		fazerLogout();
	break;

	case 'registrarGCM':
		registrarGCM($login_usu, $senha_usu, $gcm_usu);
	break;

	case 'veriPermissionNews':
		verificaPermission($id_usu);
	break;

	case 'cadastrarUser':
		cadastrarUsuario();
	break;
	
	default:
		# code...
		break;
}



function fazerLogin($login, $senha){

	$usuario = new Usuario();
	$retorno_veri = $usuario->verificaUsuario($login, $senha);

	if($retorno_veri){
		$usuarioDados = $usuario->logarUsuario($login,$senha);
		addSessionAndCookie($login, $senha);
		echo $usuarioDados;
	}else{
		$logar = array();
		$logar['logar'] = false;
		$logarShow = json_encode($logar);
		echo $logarShow;
	}

}

function fazerLogout(){
	$pagaName = isset($_REQUEST['pageName'])? $_REQUEST['pageName'] : 'index.html' ;
	logoutSessionCookie();
	header("Location: ../index.html ");
}

function autenticarUsuarioPhone($login, $senha){
	$usuario = new Usuario();
	$retorno_veri = $usuario->verificaUsuario($login, $senha);
	if($retorno_veri){
		$usuarioDados = $usuario->logarUsuario($login,$senha);
		echo $usuarioDados;
	}else{
		$logar = array();
		$logar['logar'] = false;
		$logarShow = json_encode($logar);
		echo $logarShow;
	}
}


function autenticarUsuario(){
	$usuario = new Usuario();
	$resultado_auth = verificarUsuSession();
	if($resultado_auth){
		$jsonCode = $usuario->logarUsuario($_SESSION['login_usuario'], $_SESSION['senha_usuario']);
		echo $jsonCode;
	}else{
		echo "false";
	}
}

function registrarGCM($login, $senha, $gcm){
	$usuario = new Usuario();
	$resultado_gcm = $usuario->registrarGCM($login, $senha, $gcm);
	if($resultado_gcm){ echo 'true'; }else{ echo 'false'; }
}


// ==================================== verificarPermissão Cad Notíicias =====================================

function verificaPermission($id){
	$usuario = new usuario();
	$status = array();
	$resultado = $usuario->permissaoCadNoticias($id);
	if($resultado){ $status['status'] = 'true'; }else{ $status['status'] = 'false'; }
	$resulJson = json_encode($status);
	echo $resulJson;
}

// ================================== Cadastrar Usuário ===============================


function cadastrarUsuario(){
	$nome_user 		= isset($_POST['nome'])? 		$_POST['nome'] 		: '';
	$sobrenome_user = isset($_POST['sobrenome'])?	$_POST['sobrenome'] : '';
	$cargo_user		= isset($_POST['cargo'])?		$_POST['cargo']		: '';
	$dep_user		= isset($_POST['dep'])?			$_POST['dep']		: '';
	$nivel_user		= isset($_POST['nivel'])?		$_POST['nivel']		: '';
	$login_user		= isset($_POST['login'])?		$_POST['login']		: '';
	$senha_user		= isset($_POST['senha'])?		$_POST['senha']		: '';
	$chefe_user		= isset($_POST['chefe'])?		$_POST['chefe']		: '';
	$email_user		= isset($_POST['email'])?		$_POST['email']		: '';
	$permissao_user = isset($_POST['permissao'])?	$_POST['permissao'] : '';

	$usuarioCad = new Usuario();

	$usuarioCad->setNome($nome_user);
	$usuarioCad->setSobrenome($sobrenome);
	$usuarioCad->setCargo($cargo_user);
	$usuarioCad->setNivel($nivel_user);
	$usuarioCad->setLogin($login_user);
	$usuarioCad->setSenha($senha);
	$usuarioCad->setChefe($chefe_user);
	$usuarioCad->setDepartamento($dep_user);
	$usuarioCad->setEmail($email);
	$usuarioCad->setPermissao($permissao_user);

}




























//--------------------------------------------  Helper functions -------------------------------------------------





//----------------------------------------- SESSIONS and COOKIES _-------------------------------------------------------





function addSessionAndCookie($login, $senha){
	$_SESSION['login_usuario'] = $login;
	$_SESSION['senha_usuario'] = $senha;

	setcookie("login_usuario", $login, time() + 60 * 60 * 24 * 7,  "/");
	setcookie("senha_usuario", $senha, time() + 60 * 60 * 24 * 7,  "/");

}

function logoutSessionCookie(){
	unset($_SESSION['login_usuario']);
	unset($_SESSION['senha_usuario']);


	unset($_COOKIE['login_usuario']);
	unset($_COOKIE['senha_usuario']);

	setcookie("login_usuario","", time() -3600, "/");
	setcookie("senha_usuario","", time() -3600, "/");
}

function verificarUsuSession(){
	if((isset($_COOKIE['login_usuario']) && isset( $_COOKIE["senha_usuario"] )) || (isset($_SESSION['login_usuario']) && isset($_SESSION['senha_usuario'])) ){
		if(isset($_COOKIE['login_usuario']) && isset($_COOKIE['senha_usuario'])){
			$_SESSION['login_usuario'] = $_COOKIE['login_usuario'];
			$_SESSION['senha_usuario'] = $_COOKIE['senha_usuario'];
			return true;
		}else{return false;}
	}else{return false;}
}