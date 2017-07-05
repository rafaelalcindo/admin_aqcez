<?php

session_start();

require('../login/usuario.Class.php');
require('agenda.Class.php');

@header('Content-Type: application/json');

$requestType = isset($_REQUEST['agenda'])? $_REQUEST['agenda'] : null;