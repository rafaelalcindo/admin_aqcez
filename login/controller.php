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





























//--------------------------------------------  Helper functions -------------------------------------------------





//----------------------------------------- SESSIONS and COOKIES _-------------------------------------------------------





function addSessionAndCookie($login, $senha){
	$_SESSION['login_usuario'] = $login;
	$_SESSION['senha_usuario'] = $senha;

	setcookie("login_usuario", $login, time() + 60 * 60 * 24 * 7);
	setcookie("senha_usuario", $senha, time() + 60 * 60 * 24 * 7);

}

function logoutSessionCookie(){
	unset($_SESSION['login_usuario']);
	unset($_SESSION['senha_usuario']);


	unset($_COOKIE['login_usuario']);
	unset($_COOKIE['senha_usuario']);

	setcookie("login_usuario","", time() -3600);
	setcookie("senha_usuario","", time() -3600);
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