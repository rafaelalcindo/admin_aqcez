<!DOCTYPE html>
<html>
<head>
	<title>Relatório</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/relatorio_agenda/relatorio_agenda.css" rel="stylesheet" type="text/css" >
    

    <script type="text/javascript" src="../js/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="../js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="../js/navGeral/navGeralOriginal.js" ></script>
   

</head>
<body>

<?php include "../navbar/navnoticias.php";	 ?>

    <div class="container">

        <div class="row">
            <div class="col-md-3" >
                
            </div>
            <div class="periodo col-md-1" >
                <h4>Período:</h4>
            </div>
            <div class="col-md-2">
                <label>de:</label>
                <input type="date" id="data_ini" name="data_ini" class="form-control" value="">
            </div>
            <div class="col-md-2">
                <label>até:</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control" value="" >
            </div>
            <div class="periodo col-md-2">
                <button type="button" id="consultar" class="btn btn-primary" >Consultar</button>
            </div>
        </div>

        <div class="espaco row" >

            <div class="col-md-2">
                
            </div>
            <div class="col-md-8" > 
                <table class="table table-bordered" >
                    <tr>
                        <th>Data</th>
                        <th>Millena</th>
                        <th>reikarou</th>
                        <th>braian</th>
                        <th>Calton</th>
                    </tr>
                    <tr>
                        <td>23/11/2017</td>
                        <td> Reunião com a DP,<br/> reuniaõ com mac </td>
                        <td> - </td>
                        <td> - </td>
                        <td> reunião com a C&A </td>
                    </tr>
                    <tr>
                        <td>26/11/2017</td>
                        <td> - </td>
                        <td> Maria o Mario, <br/>reunião amanha </td>
                        <td> Teste de Categoria </td>
                        <td> reunião com a C&A 02 </td>
                    </tr>
                    <tr>
                        <td> <h4 >Total </h4> </td>
                        <td> <h4> 2 </h4> </td>
                        <td> <h4> 2 </h4> </td>
                        <td> <h4> 1 </h4> </td>
                        <td> <h4> 2 </h4> </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2" >
                
            </div>

        </div>

    </div>

</body>
</html>