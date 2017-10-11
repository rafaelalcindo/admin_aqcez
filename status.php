<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startmin - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="css/bootstrap-theme.min.css" type="text/css" href="">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js" ></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



    <script type="text/javascript">
        
        $(document).ready(function(){       
            
            verificaLogin();        
            $('#pn_caleda').click(function(){
                window.location.href = 'agenda.html';
            });

            $('#pn_Lista').click(function(){
                window.location.href = 'lista_solicitacao.html';
            });

        });

        function verificaLogin(){
            $.ajax({
                type: "POST",
                url: "login/controller.php?login=sessionUsuario",
                dataType: "json",
                success: function(data){

                    if(data != null && data != false){
                        
                        //$('#dropdown_login').children().remove();

                        $('#id_user').val(data.id);
                        
                        //alert(data.id);
                        //alert(data.nome);
                        //alert(data.sobrenome);
                        
                        
                        removeNavOptions(data.nome, data.sobrenome);
                    }else{
                        window.location.href = 'index.html';
                    }

                }
            }).fail(function(data){
                window.location.href = 'index.html';
            });
        }

        
        function mudarNavBar(){
            var paginaName = window.location.pathname;
            var loginBarra = "<li><a href='#' ><span class='glyphicon glyphicon-user' aria-hidden='true'></span>    Minha Conta</a></li>";
            loginBarra += "<li><a href='login/controller.php?login=deslogar&pageName="+paginaName+"'><span class='glyphicon glyphicon-off' aria-hidden='true'></span>    Logout</a></li>";
            
            return loginBarra;
        }

        function removeNavOptions(nome, sobrenome){
            $('#nav_name_ident').children().remove();
            $('#nav_name_ident').append("Bem vindo "+nome+" "+sobrenome+" ");
        }

    </script>

    <script src="js/status_script/status.js" type="text/javascript"></script>


    <style type="text/css">
    
        .pn_topo:hover{
            box-shadow: inset 0 1px 1px rgb(255, 133, 51), 0 0 8px rgb(255, 133, 59);
        }

        .linha_prin{
            
            border-radius: 12px;
            padding-top: 1%;
            margin-top: 3%;
            background-color: #ffffff;
            box-shadow: 0px 2px 10px #595959;
        }

        .panel{
            width: 220px;
        }

        #add_etapa{
            background: url('img/add_item.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 25px;
            width: 50px;
            height: 50px;
            border-radius: 25px; 
        }

        #remove_flux{
            float: left;
            border-radius: 25px;
        }

    </style>

</head>
<body>
<input type="hidden" id="id_user" value="" />
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Painel Administrativo</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#" id="nav_name_ident"><i class="fa fa-home fa-fw"></i> </a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>Menu <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>Minha Conta</a>
                    </li>                    
                    <li class="divider"></li>
                    <li><a href="login/controller.php?login=deslogar&pageName=index.html"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        
    </nav>

    <!-- Page Content -->
    
        <div class="container-fluid" style="margin-top: 3%;">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Fluxo de pedido de orçamento.</h1>
                    <button class="btn btn-primary btn-large" id="ad_orcamen" data-toggle="modal" data-target="#modalAddEvento" >Adicionar Orçamento.</button>

                    <div class="row" id="panel_orc" style="margin: 2%;">

                    <!--
                        <div class="col-md-12 linha_prin" style="overflow-x: auto;">
                           <table>
                               <tr>
                                  
                                   <td>
                                       <div class="panel panel-success">
                                          <div class="panel-heading">Etapa 1 - pedido de Orçamento</div>
                                          <div class="panel-body">
                                            <select class="form-control">
                                               <option>Igor</option>
                                               <option>Edu</option>
                                               <option>Edinola</option>
                                           </select>
                                          </div>
                                        </div>
                                   </td>

                                   <td style="padding: 30px;">
                                       <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                   </td>
                                   <td>
                                       <div class="panel panel-success">
                                          <div class="panel-heading">Etapa 2 - Orçamento com pessoal de engenharia</div>
                                          <div class="panel-body">
                                            <select class="form-control">
                                               <option>Igor</option>
                                               <option>Edu</option>
                                               <option>Edinola</option>
                                           </select>
                                          </div>
                                        </div>
                                   </td>

                                   <td style="padding: 30px;">
                                       <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                   </td>
                                   <td>
                                       <div class="panel panel-danger">
                                          <div class="panel-heading">Etapa 3 - Com pessoal de vendas</div>
                                          <div class="panel-body">
                                            <select class="form-control">
                                               <option>Igor</option>
                                               <option>Edu</option>
                                               <option>Edinola</option>
                                           </select>
                                          </div>
                                        </div>
                                   </td>

                                   <td style="padding: 30px;">
                                       <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                   </td>
                                   <td>
                                       <div class="panel panel-info">
                                          <div class="panel-heading">Etapa 4 - Pessoal de engenharia</div>
                                          <div class="panel-body">
                                            <select class="form-control">
                                               <option>Igor</option>
                                               <option>Edu</option>
                                               <option>Edinola</option>
                                           </select>
                                          </div>
                                        </div>
                                   </td>

                                   <td style="padding: 30px;">
                                       <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                   </td>

                               </tr>
                           </table>
                          
                        </div>
                        -->


                    </div>
                </div>
            </div>
            <!-- ... Your content goes here ... -->

        </div>
    

<!-- ================================================= Modals Adicionar =============================================================== -->


    <div class="modal fade" id="modalAddEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Criar Fluxo do Orçamento</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="obra">Digite o Segmento</label>
                      <input type="text" class="form-control" id="obra"  placeholder="Digite a Obra" />  

                      <label for="obra">Digite os Itens</label>
                      <input type="text" class="form-control" id="itens" placeholder="Digite os Intes Pedidos" />  

                      <label for="obra">Digite a area do projeto</label>
                      <input type="text" class="form-control" id="area"  placeholder="Digite a area do projeto" /> 

                      <label for="obs_contato">Digite as observações</label>
                      <textarea class="form-control" id="obs_contato"></textarea>
                    </div>
                    
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="contato_nome">Digite o nome do Contato</label>
                      <input type="text" class="form-control" id="contato_nome"   placeholder="Digite o nome do contato" />  

                      <label for="obra">Digite o número do contato</label>
                      <input type="text" class="form-control" id="numero_contato" placeholder="Digite o número do contato" />  

                      <label for="obra">Digite o email do contato</label>
                      <input type="text" class="form-control" id="email_contato"  placeholder="Digite o email do contato" />  
                    </div>
                  </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary"  id="ad_orcamento" data-dismiss="modal">Salvar</button>
            </div>
          </div>
        </div>
      </div>

<!-- ============================================ Modal Add Passos ========================================== -->


    <div class="modal fade" id="modalAddPassos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Addicionar Passos</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                    <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" placeholder="Titulo" />

                      <label for="descricao">Descrição</label>
                      <textarea id="descricao" class="form-control" ></textarea>

                    </div>
                    
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>Selecione a próxima pessoa</label>
                      <select class="form-control">
                        
                        <option>Fulano</option>
                        <option>Ciclano</option>
                        <option>Clonalo</option>
                      </select>
                    </div>
                  </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ======================================= Modal Add Info ===================================== -->

      <div class="modal fade" id="modalAddInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Addicionar as Suas Informações.</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-xs-2"></div>
                  <div class="col-xs-8">
                    <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" placeholder="Titulo" />

                      <label for="descricao">Descrição</label>
                      <textarea id="descricao" class="form-control" ></textarea>

                    </div>
                    
                  </div>
                  <div class="col-xs-2"></div>          
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ================================== Modal Edit Info ====================================== -->

      <div class="modal fade" id="modalEditInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Addicionar as Suas Informações.</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-xs-2"></div>
                  <div class="col-xs-8">
                    <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" value="Marcos Nacimento de Melo" placeholder="Titulo" />

                      <label for="descricao">Descrição</label>
                      <textarea id="descricao" class="form-control"  >
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                      </textarea>

                    </div>
                    
                  </div>
                  <div class="col-xs-2"></div>          
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- ================================== Modal visu Info ====================================== -->

      <div class="modal fade" id="modalVizuInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Vizualizar Informações.</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-xs-2"></div>
                  <div class="col-xs-8">
                    <div class="form-group">
                      <label for="titulo">Responsável</label>
                      <p>Felipe Trinker da Silva</p>

                      <label for="descricao">Descrição</label>
                      <p style='border: 1px solid #e6e6e6; text-align: justify; text-justify: inter-word; padding: 3px; ' >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

                    </div>
                    
                  </div>
                  <div class="col-xs-2"></div>          
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar</button>
            </div>
          </div>
        </div>
      </div>


    <!-- ================================== Modal Primeiro Contato Info =================================== -->


      <div class="modal fade" id="modalContatoInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Informações</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                      <div class="form-group">
                        <label for="nome_cli">Nome do Cliente:</label>
                        <p>Fulano Da Silva Santos</p>

                        <label for="telefone">Telefone:</label>
                        <p>(11) 98342-2452</p>

                        <label for="email" >Email:</label>
                        <p>fulano_silva@megastore.com.br </p>

                      </div>
                      
                    </div>

                    <div class="col-xs-6">
                      <div class="form-group">

                        <label>Primeiro Contato</label>
                        <p>Michael Tayler</p>
                        
                        <label>Email</label>
                        <p>michael_tayler@gmail.com</p>

                      </div>
                    </div>
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                
              </div>
            </div>
          </div>
        </div>
      


  </div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

</body>
</html>
