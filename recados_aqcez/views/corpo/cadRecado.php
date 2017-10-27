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

    <script type="text/javascript" src="../../../js/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="../../../js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="../../../js/navGeral/navGeral.js" ></script>
    <script type="text/javascript" src="../../../js/tinymce/tinymce.min.js" ></script>

    <script type="text/javascript" src="../assets/js/cadastrarNews.js" ></script>


    <script type="text/javascript">


        tinymce.init({
            selector: '#mytextarea',
            language: 'pt_BR',
            language: 'pt_BR',
            theme: 'modern',
            width: 600,
            height: 300,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                  'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'  

        });


    </script>    


</head>
<body>

<?php include "../navbar/navnoticias.php";	 ?>
<input type="hidden" id="id_user" value="" >

<div class="container">
    <div class="row">
        <div class="col-md-2">
            
            
        </div>
        <div class="col-md-8" >

            <div class="row" >
                <div class="col-md-6" >
                    <h3>titulo:</h3>
                    <input type="text" name="titulo" id="titulo" class="form-control" >
                </div>
            </div>

            <div class="row" >                
                <div class="col-md-8" >
                    <h3>Descrição:</h3>
                    <input type="text" name="descricao" id="descricao" class="form-control" >
                </div>                
            </div>

            <div class="row" >
                <div class="col-md-8" >
                    <h3>Selecione o tipo de mensagem.</h3>
                    <select class="form-control" id="select_tipo" >
                        <option value="geral" >Geral</option>
                        <option value="dep" >Departamento</option>
                    </select>
                </div>
            </div>

            <div class="row" id="div_dep" >
                <div class="col-md-8" >
                    <h3>Selecione o Departamento</h3>
                    <select class="form-control" id="select_dep" >
                        <option value="comercial" >Comercial</option>
                        <option value="marketing" >Marketing</option>
                        <option value="engenharia" >Engenharia</option>
                        <option value="financeiro" >Financeiro</option>
                        <option value="compras" >Compras</option>
                    </select>
                </div>
            </div>

            <div class="row" >
                <div class="col-md-8" >
                    <h3>Digite o seu texto:</h3>
                    <textarea id="mytextarea"></textarea>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-md-8">
                    <button type="button" id="btn_enviar" class="btn btn-primary btn-lg" >Enviar</button>
                </div>
            </div>

        </div>
        <div class="col-md-2" >
            
        </div>
    </div>
</div>


</body>