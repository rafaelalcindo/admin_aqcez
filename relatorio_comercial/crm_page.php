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
    <script type="text/javascript" src="../js/relatorio_comercial/crm_comercial.js" ></script>
    

</head>
<body>

<?php include "../navbar/navnoticias.php"; ?>
<input type="hidden" id="id_user" value="">
    <div class="container2" >
        <div class="titulos_menu">
            <h2>Lista de Contatos</h2>
            <button type="button" class="btn btn-primary" id="btn_modal_contato" data-toggle="modal" data-target="#modal_cad">Adicionar Contato</button>
        </div>
         <br/>
         <hr/>

         <div class="row">
            <div class="col-sm-12" >
                <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Contatos</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hoje</a></li>
                    <li role="presentation"><a href="#filtro" aria-controls="filtro" role="tab" data-toggle="tab">Filtro</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <table class="table table-bordered table-hover" >
                            <thead >
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
                                    <th>Ações</th>
                                    
                                    
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
                                    <th>Ações</th>
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

                    <div role="tabpanel" class="tab-pane" id="filtro">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 align="center">Filtro de Contatos</h3>
                                <br/>
                                <div class="form-inline" id="menu_filtro">
                                    <label>Nome: </label>
                                    <input type="text" class="form-control" id="filtro_contato" name="filtro_contato" placeholder="Filtro Contato">

                                    <label>Data: </label>
                                    <input type="date" class="form-control" id="filtro_data" name="filtro_data" placeholder="Filtro Data">

                                    <button type="button" id="filtro_botao" class="btn btn-info">Filtrar</button>
                                </div>
                                <div class="tabela_filtro">
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
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body_filtro">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                  </div>

                  <hr/>

                  

                  <!-- <button type="button" class="btn btn-success" >
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                  </button>

                  <button type="button" class="btn btn-danger" >
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </button>  -->
                  
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

                    <label>Endereço do Contato</label>
                    <input type="text" class="form-control" placeholder="Endereço" id="cad_endereco" name="cad_endereco" >

                    <label>Situação</label>
                    <select class="form-control" id="cad_situacao" >
                        <option>Em andamento</option>
                        <option>Finalizando positivo</option>
                        <option>Finalizado negativo</option>
                    </select>

                    <label>Selecione o dia do retorno</label>
                    <input type="date" class="form-control" placeholder="Retorno" id="cad_retorno" name="cad_retorno">

                </div>
                <div class="col-sm-6">

                    <label>Motivo</label>
                    <select class="form-control" id="cad_motivo" >
                        <option >Preço</option>
                        <option >Prazo</option>
                        <option >Qualidade</option>
                        <option>Atendimento</option>
                        <option>Assistência técnica</option>
                        <option>Concorrência</option>
                        <option>Análise</option>
                        <option>Suspens</option>
                        <option>Cancel</option>
                    </select>

                    <label>Probabilidade Contato</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Digite de aceitação do contato" id="proba_contato" name="proba_contato">
                        <div class="input-group-addon" >%</div>
                    </div>
                    

                    <label>Nome do Projeto</label>
                    <input type="text" class="form-control" placeholder="Digite o nome do Projeto" id="cad_projeto" name="cad_projeto" >

                    <label>Turn Key</label>
                    <input type="number" class="form-control" placeholder="Digite a Quantidade de Turn Key" id="cad_quant_turn_key" name="cad_quant_turn_key">

                    <label>Interiores</label>
                    <input type="number" class="form-control" placeholder="Digite a Quantidade de Interiores" id="cad_quant_interiores" name="cad_quant_interiores">

                    <label>Mobiliario</label>
                    <input type="number" class="form-control" placeholder="Digite a Quantidade de Mobiliario" id="cad_quant_mobiliario" name="cad_quant_mobiliario">

                    <label>Observação</label>
                    <textarea id="cad_observacao" class="form-control" placeholder="Digite a Observação" ></textarea>


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