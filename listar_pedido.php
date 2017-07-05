<!DOCTYPE html>
<html ng-app='app'>
<head>
	<title>Listagem de Pedido</title>
	<meta charset="utf-8">

	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/angular_controllers/listaPedidoController.js"></script>

	<script type="text/javascript" src="js/datapicker/jquery.ui.timepicker.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">
	<link rel="stylesheet" type="text/css" href="js/datapicker/jquery.ui.timepicker.css">
	
</head>
<body ng-controller='listaPedidoController'>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Brand</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#" class="active">Lista de Pedidos</a> <span class="sr-only">(current)</span></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li>
	            	<p>Login</p>
	            	<input type="email" class="form-control" id="email_login" />
	            </li>
	            <li>
	            	<p>Senha</p>
	            	<input type="password" class="form-control" id="senha_login" />
	            </li>
	            <li style="padding-left: 30%">
	            	<br/>
	            	<button class="btn btn-primary" align="center" id="logar">Logar</button> 
	            </li>
	            
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<h2>Lista de Pedidos</h2>
		
		<div class="row">
			<div class="col-xs-12">

				<table class="table table-bordered table-hover">
					<thead>
						<th>Serviço</th>
						<th>Descrição</th>
						<th>Data do pedido</th>
						<th>Vagas</th>
						<th>Endereço</th>
						<th>Numero</th>
						<th>Complementar</th>
						<th>estado</th>
						<th>cidade</th>
						<th>Cep</th>
					</thead>					
					<tbody>
						<tr ng-repeat="lista in listaPedidos.data">
							<td>{{ lista.servico }}</td>
							<td>{{ lista.descricao }}</td>
							<td width="15%" >{{ lista.data_pedido }}</td>
							<td>{{ lista.vagas }}</td>
							<td>{{ lista.endereco }}</td>
							<td>{{ lista.numero }}</td>
							<td>{{ lista.complementar }}</td>
							<td>{{ lista.estado }}</td>
							<td>{{ lista.cidade }}</td>
							<td>{{ lista.cep }}</td>
						</tr>
					</tbody>
				</table>
				
			</div>			
		</div>

		
	</div>

	

</body>
</html>