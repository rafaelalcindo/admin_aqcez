<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require '../login/usuario.Class.php';
require 'pedi_orc.class.php';

$app = new \Slim\App;

$app->post('/fluxo/first', function (Request $request, Response $response) {

	$obra_em = isset($_POST['obra'])?       $_POST['obra']    : null;
	$area    = isset($_POST['area'])?       $_POST['area']    : null;
	$obs	 = isset($_POST['obs'])?	    $_POST['obs']     : null;
	$itens   = isset($_POST['itens'])?      $_POST['itens']   : null;
	$id_user = isset($_POST['id_user'])?    $_POST['id_user']    : null;

    $pedi_orc     = new PediOrc();
    $usuarioDados = new Usuario();

    $pedi_orc->setObra_em($obra_em);
    $pedi_orc->setArea($area);
    $pedi_orc->setObservacao($obs);
    $pedi_orc->setIten($itens);

    $usuario_dados = $usuarioDados->puxarDadosUsuarioId($id_user);
    $resultado_primeiro = $pedi_orc->gravarPrimeiroPedido($usuario_dados);
    if($resultado_primeiro){ echo "true"; }else{ echo "false"; }
    
});


$app->post('/fluxo/segue', function (Request $request, Response $response) {

    $step_orc_id = isset($_POST['step_orc_id'])? $_POST['step_orc_id']  : null;
    $user_id     = isset($_POST['usuario_id'])?  $_POST['usuario_id']   : null;
    $status      = isset($_POST['status'])?      $_POST['status']       : null;
    $passo_visu  = isset($_POST['passo_visu'])?  $_POST['passo_visu']   : null;

    $pedi_next_step = new PediOrc();
    $usuarioDados   = new Usuario();

    $usuario_dados = $usuarioDados->puxarDadosUsuarioId($id_user);

    $pedi_next_step->setStatus($status);
    $pedi_next_step->setPassoVisu($passo_visu);

    
    
});





$app->run();