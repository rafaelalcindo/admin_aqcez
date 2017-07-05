<?php
	
	require('../connection.php');
	
	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	if(mysqli_connect_errno($con)){
		echo "Falha ao carregar a Página, problema no banco de dados";
		exit();
	}

	
	header('Content-type: text/html; charset=utf-8');


	$select_estado = sprintf("select * from estado");
	$sql_estado = mysqli_query($con, $select_estado);

	$estado_array = array();
	$inseri_array = array();
	while($row = mysqli_fetch_array($sql_estado)){
		$inseri_array['id'] = $row['id'];
		$inseri_array['nome'] = utf8_encode($row['nome']);
		$inseri_array['uf'] = $row['uf'];

		$estado_array[$row['id']] = $inseri_array;
		unset($inseri_array);

	}

	//echo "Este é o array: ".print_r($estado_array);
	header('Content-Type: application/json');
	echo json_encode($estado_array);

