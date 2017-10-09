<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require '../login/agenda.Class.php';

$app = new \Slim\App;

$app->post('/fluxo/first', function (Request $request, Response $response) {

	$obra_em = isset($_REQUETS['obra'])?    $_REQUETS['obra']    : null;
	$area    = isset($_REQUETS['area'])?    $_REQUETS['area']    : null;
	$obs	 = isset($_REQUETS['obs'])?	    $_REQUETS['obs']     : null;
	$itens   = isset($_REQUETS['itens'])?   $_REQUETS['itens']   : null;
	$id_user = isset($_REQUETS['id_user'])? $_REQUETS['id_user'] : null;   
    
    $pedi_orc = new PediOrc();
    $usuarioDados = new Usuario();

    $pedi_orc->setObra_em($obra_em);
    $pedi_orc->setArea($area);
    $pedi_orc->setObservacao($obs);
    $pedi_orc->setIten($itens);

    $usuario_dados = $usuarioDados->puxarDadosUsuarioId($id_user);

    $pedi_orc->gravarPrimeiroPedido($usuario_dados);
    
});





$app->run();