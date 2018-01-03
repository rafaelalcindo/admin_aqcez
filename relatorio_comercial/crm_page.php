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
    

    <script type="text/javascript" src="../js/jquery-1.12.4.min.js" ></script>
    <script type="text/javascript" src="../js/bootstrap.min.js" ></script>    
    <script type="text/javascript" src="../js/moment.js"></script>
    <script type="text/javascript" src="../js/jquery.blockUI.js"></script>    
    <script type="text/javascript" src="../js/navGeral/navGeralOriginal.js" ></script>     
    <script type="text/javascript" src="../js/relatorio_comercial/crm_comercial.js" ></script>
    

</head>
<body>

<?php include "../navbar/navnoticias.php"; ?>
<input type="hidden" id="id_user" value="">
    <div class="container" >
         <h2>Lista de Contatos</h2>
         <hr/>

         <div class="row">
            <div class="col-sm-12" >
                <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Contatos</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hoje</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <table class="table table-bordered table-hover" >
                            <thead >
                                <tr>
                                    <th>Empresa</th>
                                    <td>Contato</th>
                                    <td>Telefone</th>
                                    <td>Endereço</th>
                                    <th>Status</th>
                                    <th>Retorno</th>
                                    <th>Sinal</th>
                                </tr>                                
                            </thead>
                            <tbody id="table_body_todos">

                            <!-- 
                                <tr>
                                    <td>Microsoft</td>
                                    <td>Bill Gates</td>
                                    <td>11 5534.2342</td>
                                    <td>Rua dos Rurais 83</td>
                                    <td> Ativo </td>
                                    <td> 14/01/2018 </td>
                                    <td><div style="height: 25px; width: 100%; background-color: #ff3333;"  ></div></td>
                                </tr>

                                <tr>
                                    <td>Apple</td>
                                    <td>Tim Cook</td>
                                    <td>11 5534.2342</td>
                                    <td>Rua das Maçãs 83</td>
                                    <td> Ativo </td>
                                    <td> 18 /01/2018 </td>
                                    <td><div style="height: 25px; width: 100%; background-color: #ff3333;"  ></div></td>
                                </tr>
                            -->

                            </tbody>                        
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        
                        <table class="table table-bordered table-hover" >
                            <thead >
                                <tr>
                                    <th>Empresa</th>
                                    <td>Contato</th>
                                    <td>Telefone</th>
                                    <td>Endereço</th>
                                    <th>Status</th>
                                    <th>Retorno</th>
                                    <th>Sinal</th>
                                </tr>                                
                            </thead>
                            <tbody id="table_body_hoje">

                            <!-- 
                                <tr>
                                    <td>Microsoft</td>
                                    <td>Bill Gates</td>
                                    <td>11 5534.2342</td>
                                    <td>Rua dos Rurais 83</td>
                                    <td> Ativo </td>
                                    <td> 14/01/2018 </td>
                                    <td><div style="height: 25px; width: 100%; background-color: #ff3333;"  ></div></td>
                                </tr>

                                <tr>
                                    <td>Apple</td>
                                    <td>Tim Cook</td>
                                    <td>11 5534.2342</td>
                                    <td>Rua das Maçãs 83</td>
                                    <td> Ativo </td>
                                    <td> 18 /01/2018 </td>
                                    <td><div style="height: 25px; width: 100%; background-color: #ff3333;"  ></div></td>
                                </tr>
                            -->

                            </tbody>                        
                        </table>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">3</div>
                    <div role="tabpanel" class="tab-pane" id="settings">4</div>
                  </div>

                  <hr/>

                  <button type="button" class="btn btn-primary" id="btn_modal_contato" data-toggle="modal" data-target="#modal_cad">Adicionar Contato</button>
            </div>             
         </div>
    </div>

    <!-- ============================================ Modals Aqui ===============================================  -->


    <!-- =============================== modal Cadastrar Contato ============================================= -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_cad" aria-labelledby="modal_cad">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Salvar Contato</h3>
          </div>
          <div class="modal-body">
            <h2>Cadastro de Contato</h2>
            <div class="row">
                <div class="col-sm-6" style="border-right: 3px solid #a6a6a6">
                    <label>Nome da Empresa</label>
                    <input type="text" class="form-control" placeholder="Empresa" id="cad_empresa" name="cad_empresa">

                    <label>Nome do Contato</label>
                    <input type="text" class="form-control" placeholder="Contato" id="cad_contato" name="cad_contato">

                    <label>Telefone do Contato</label>
                    <input type="text" class="form-control" placeholder="Telefone de Contato" id="cad_telefone" name="cad_telefone" >

                </div>
                <div class="col-sm-6">
                    <label>Endereço do Contato</label>
                    <input type="text" class="form-control" placeholder="Endereço" id="cad_endereco" name="cad_endereco" >

                    <label>Status</label>
                    <select class="form-control" id="cad_status" >
                        <option value="Ativo" >Ativo</option>
                        <option value="Em espera" >Em espera</option>
                    </select>

                    <label>Selecione o dia do retorno</label>
                    <input type="date" class="form-control" placeholder="Retorno" id="cad_retorno" name="cad_retorno">

                    <label>Sinal</label>
                    <select class="form-control" id="cad_sinal" >
                        <option value="#2ad813" >Verde</option>
                        <option value="#3f7bdb" >Azul</option>
                        <option value="#ff0a2a" >Vermelho</option>
                    </select>

                </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-success" id="btn_salvar">Salvar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>