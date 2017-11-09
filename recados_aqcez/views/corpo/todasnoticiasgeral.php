<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startmin - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../../../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../../css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../assets/css/corpoGeral/corpoGeral.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/recadosgerais/recadosgerais.css">

    <script type="text/javascript" src="../../../js/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="../../../js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="../../../js/navGeral/navGeral.js" ></script>
    <script type="text/javascript" src="../assets/js/paginaTodasNoticiaGeral.js"></script>

</head>
<body>

<?php include "../navbar/navnoticias.php";	 ?>

    <div class="container" >
        <input type="hidden" id="dep_user" name="dep_user" value="">
        <input type="hidden" id="id_user" name="id_user" value="" >
        <input type="hidden" id="nome_user" name="nome_user" value="">
        <input type="hidden" id="email_user" name="email_user"  value="">

        <div class="row">
            <div class="bgWhite col-md-12" style="text-align: center;" >
                <h2>Todas as notícias</h2>
                <hr/>

                <div class="list-group" id="painel_noticias">

                  

                </div>

            </div>
        </div>

    </div>

</body>