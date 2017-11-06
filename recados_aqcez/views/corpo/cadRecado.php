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
                'advlist autolink link lists charmap preview hr pagebreak spellchecker',
                  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
                  'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullpage | forecolor backcolor'  

        });


    </script>    


</head>
<body>

<?php include "../navbar/navnoticias.php";	 ?>

<input type="hidden" id="id_user" value="" >
<input type="hidden" id="nome_user" value="">
<input type="hidden" id="sobrenome_user" value="">
<input type="hidden" id="email_user" value="">

<div class="container">
    <div class="row">
        <div class="col-md-2">
            
            
        </div>
        <div class="col-md-8" >

            <div class="row" >
                <div class="col-md-6" >
                    <h3>titulo:</h3>
                    <input type="text" name="titulo" id="titulo" class="form-control" maxlength='140' >
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



<!-- ============================== modals =========================================== -->

<!-- ======================= modal de confirmação de envio  ============================ -->

<div class="modal fade" id="modal_msg_cad" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Formulário enviando com sucesso</h4>
      </div>
      <div class="modal-body">
        <p>A mensagem foi enviado com sucesso!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</body>