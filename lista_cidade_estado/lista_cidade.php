<?php

require('../connection.php');
	
	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	if(mysqli_connect_errno($con)){
		echo "Falha ao carregar a Página, problema no banco de dados";
		exit();
	}

	
	header('Content-type: text/html; charset=utf-8');
	$id_estado = $_GET['id'];

	$select_cidade = sprintf("select * from cidade where estado = '%s' order by nome",$id_estado);
	$sql_cidade = mysqli_query($con, $select_cidade);

	$cidade_array = array();
	$inseri_array = array();

	while($row = mysqli_fetch_array($sql_cidade)){
		$inseri_array['id']   = $row['id'];
		$inseri_array['nome'] = utf8_encode($row['nome']);

		$cidade_array[] = $inseri_array;
		unset($inseri_array);
	}

	//echo "Esse é o array: ".print_r($cidade_array);
	header('Content-Type: application/json');
	echo json_encode($cidade_array);

?>
