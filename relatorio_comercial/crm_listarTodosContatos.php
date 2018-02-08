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
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" >
    <link href="../css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
    <link href="../css/easy-autocomplete.themes.min.css" rel="stylesheet" type="text/css" >
    <link href="assets/css/crm_page.css" rel="stylesheet" type="text/css">
    

    <script type="text/javascript" src="../js/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="../js/bootstrap.min.js" ></script>    
    <script type="text/javascript" src="../js/moment.js"></script>
    <script type="text/javascript" src="../js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="../js/jquery.easy-autocomplete.min.js" ></script>
    <script type="text/javascript" src="../js/navGeral/navGeralOriginal.js" ></script>     
    <!-- <script type="text/javascript" src="../js/relatorio_comercial/crm_comercial.js" ></script> -->
    <script type="text/javascript" src="../js/relatorio_comercial/crm_listarGeral.js" ></script>
    

</head>
<body>

    <?php include "navbar/navnoticias.php"; ?>
    <input type="hidden" id="id_user" value="">

    <div class="container2">
        <div class="titulos_menu">
            <h2>Lista de Contato</h2>
            <div class="filtro_inicial">
                <label>Filtrar por nome</label>
                <input type="text" class="form-control" id="filtro_nome" >

            </div>
        </div>
        <br/>
        <hr/>

        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active"><a href="#contato" aria-controls="contato" role="tab" data-toggle="tab">Contatos</a></li>
                   <li role="presentation"><a href="#hoje" aria-controls="hoje" role="tab" data-toggle="tab">Hoje</a></li>
                   <li role="presentation"><a href="#filtro" aria-controls="filtro" role="tab" data-toggle="tab">Filtro</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="contato">
                        <table class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Empresa</th>
                                    <th>Nome Contato</th>
                                    <th>Telefone</th>
                                    <th>Projeto</th>
                                    <th>Turn Key</th>
                                    <th>Interiores</th>
                                    <th>Mobiliario</th>
                                    <th>Total</th>
                                    <th>Situação</th>
                                    <th>Motivo</th>
                                    <th>Probabilidade</th>
                                    <th>Dono do Contato</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="table_todo">
                                
                            </tbody>
                            
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="hoje" >
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Empresa</th>
                                    <th>Nome Contato</th>
                                    <th>Telefone</th>
                                    <th>Projeto</th>
                                    <th>Turn Key</th>
                                    <th>Interiores</th>
                                    <th>Mobiliario</th>
                                    <th>Total</th>
                                    <th>Situação</th>
                                    <th>Motivo</th>
                                    <th>Probabilidade</th>
                                    <th>Dono do Contato</th>
                                </tr>
                            </thead>
                            <tbody id="table_hj_proximo" >
                                
                            </tbody>
                        </table>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="filtro" >
                        <br/>
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <label>Situação</label>
                                <select class="form-control" id="situacao" >
                                    <option value="" >-</option>
                                    <option value="Finalizado Positivo" >Finalizado</option>
                                    <option value="Finalizado Negativo" >Perdido</option>
                                    <option value="Em Andamento" >Em Andamento</option>
                                </select>
                            </div>
                            <div class="col-sm-4"></div>
                        </div><br/><br/>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <th>Data</th>
                                        <th>Empresa</th>
                                        <th>Nome Contato</th>
                                        <th>Telefone</th>
                                        <th>Projeto</th>
                                        <th>Turn Key</th>
                                        <th>Interiores</th>
                                        <th>Mobiliario</th>
                                        <th>Total</th>
                                        <th>Situação</th>
                                        <th>Motivo</th>
                                        <th>Probabilidade</th>
                                        <th>Dono do Contato</th>
                                    </thead>
                                    <tbody id="table_filtro" >
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

</body>
</html>