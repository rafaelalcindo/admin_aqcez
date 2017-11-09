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

    <script type="text/javascript" src="../assets/js/paginaGeralGetNoticiasAll.js" ></script>


</head>
<body>

<?php include "../navbar/navnoticias.php";	 ?>

<div class="container"  >

  <input type="hidden" id="dep_user" name="dep_user" value="">
  <input type="hidden" id="id_user" name="id_user" value="" >
  <input type="hidden" id="nome_user" name="nome_user" value="">
  <input type="hidden" id="email_user" name="email_user"  value="">


  <div class="row">
    <div class="bgWhite col-md-7"  >

      <h3>Notícias Gerais</h3>
      <hr/>
      <div class="row justify-content-start" >
        <div class="col-md-11" id="geralNews">

         <!-- 
         <div class="card" id="main_noticia" style="width: 100%;" >
            <div class="card-body">
              <h4 class="card-title">{{ noticia[0] }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">{{ noticia[1] }}</h6>
              <p class="card-text">{{ noticia[2] }}</p>
              <a href="#" class="card-link">Ler mais</a>

            </div>
          </div> 
          -->
          
         <!--
         <br/>

          <button type="button" class="btn btn-outline-secondary">Visualizar mais</button> 
          -->

        </div>
      </div>

    </div>
    &nbsp;
    <div class="bgWhite col-md-4 ml-auto" id="grupo_dep">
      <h3>Notícia de departamento</h3>
      <hr/>
      <div class="row justify-content-start" >
        <div class="col-12"  >


          <div class="list-group" id="depNews">
            <!-- 
            <a href="#"  class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ dep_new[0] }}</h5>
                <small>{{ dep_new[1] }}</small>
              </div>
              <p class="mb-1">{{ dep_new[2] }}</p>
              <small>Donec id elit non mi porta.</small>
            </a> -->


          </div>
          <br/>


          <button type="button" class="btn btn-warning">Visualizar mais</button>

        </div>
      </div>
    </div>


  </div>
</div>

</body>
</html>