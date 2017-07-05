<!DOCTYPE html>
<html>
<head>
	<title>Index da Página de Teste</title>
	<meta charset="utf-8">
	
	
	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/datapicker/jquery.ui.timepicker.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/paginasHead/index_head.js"></script>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">
	<link rel="stylesheet" type="text/css" href="js/datapicker/jquery.ui.timepicker.css">



	

	<script type="text/javascript">
		
		$(document).ready(function(){

			verificaLogin();

		});

		function verificaLogin(){
			$.ajax({
				type: "POST",
				url: "login/controller.php?login=sessionUsuario",
				dataType: "json",
				success: function(data){
					$('#dropdown_login').children().remove();
					//alert(data.id);
					//alert(data.nome);
					//alert(data.sobrenome);
					var navPainel = mudarNavBar();
					$('#dropdown_login').append(navPainel);
					removeNavOptions();

				}
			});
		}

		function mudarNavBar(){
			var paginaName = window.location.pathname;
			var loginBarra = "<li><a href='#' ><span class='glyphicon glyphicon-user' aria-hidden='true'></span>    Minha Conta</a></li>";
			loginBarra += "<li><a href='login/controller.php?login=deslogar&pageName="+paginaName+"'><span class='glyphicon glyphicon-off' aria-hidden='true'></span>    Logout</a></li>";
			
			return loginBarra;
		}

		function removeNavOptions(){
			$('#nav_options_login').children().remove();
			$('#nav_options_login').append('<li><a href="#">Painel Administrativo</a></li>');
			$('#nav_menu_direita').children().remove();
			$('#nav_menu_direita').append('<p>Menu<span class="caret"></span></p>');
		}


	</script>


	<style type="text/css">

		.payment-methods{
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.payment-methods:after{
			content: "";
			clear: both;
		}

		.payment-method{
			border: 1px solid #ccc;
			box-sizing: border-box;
			float: left;
			height: 70px;
			position: relative;
			width: 120px;
		}

		.payment-method+.payment-method{
			margin-left: 25px;
		}

		.payment-method label {
		  background: #fff no-repeat center center;
		  bottom: 1px;
		  cursor: pointer;
		  display: block;
		  font-size: 0;
		  left: 1px;
		  position: absolute;
		  right: 1px;
		  text-indent: 100%;
		  top: 1px;
		  white-space: nowrap;
		}

		.pagseguro label {
		  background-image: url('img/select_image01.jpg');
		}

		.paypal label {
		  background-image: url('img/select_image02.jpg');
		}

		.bankslip label {
		  background-image: url('img/select_image03.jpg');
		}

		.payment-methods input:focus + label{
			outline: 4px solid #21b4d0;
		}

		.payment-methods input:checked + label:after {
		  background: url(checked.png);
		  bottom: -10px;
		  content: "";
		  display: inline-block;
		  height: 20px;
		  position: absolute;
		  right: -10px;
		  width: 20px;
		}

		@-moz-document url-prefix() {
		  .payment-methods input:checked + label:after {
		    bottom: 0;
		    right: 0;
		    background-color: #21b4d0;
		  }
		} 

	</style>

	<style type="text/css">


		/*.check_img input[type='radio']{

			float: right;
			-webkit-appearance: none;
			
			border: none;
			width: 250px;
			height: 250px;
			background: url('img/select_image01.jpg') left center no-repeat;
			background-size: 200px;

		}

		.check_img input[type='radio']:checked{
			width: 250px;
			height: 250px;
			background: url('img/select_image02.jpg');
			box-shadow: 0px 0px 15px #21b4d0;			
			border: 2px solid #21b4d0;
		} */

		.check_img input[type='radio']{
			opacity: 0.001;
			position: absolute;
		}

		.check_img input[type = 'radio'] + label{
			cursor: pointer;
		}

		.check_img input[type = 'radio'] + label:after{
			display: inline-block;
			content: " ";
			font-size: 30px;
			line-height: 45px;
			text-align: center;
			color: #ccc;
			background-image: url('img/select_image01.jpg');
			background-size: 100px 100px;
			width: 100px;
			height: 100px;
			vertical-align: middle;
			margin: 0 10px;
			border-radius: 10%;
			border: 1px solid grey;
		}

		input[type = 'radio'] + label:hover:after{
			background: #21b4d0;
		}

		input[type = 'radio']:checked + label:after{
			color: #fff;
			background-image: url('img/check01.png');
			background-size: 100px 100px;
			box-shadow: 0 0 8px deepSkyBlue;
			border-color: white;
		}

	</style>


</head>
<body>
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
	      <ul class="nav navbar-nav" id="nav_options_login" >
	        <li class="active"><a href="index.php">HOME <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu" id="dropdown_painel">
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
	      <!--<form class="navbar-form navbar-left" >
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form> -->
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="listar_pedido.php">Lista de Pedidos</a></li>
	        <li class="dropdown">

	          <a href="#" class="dropdown-toggle" id="nav_menu_direita" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><p>Login<span class="caret"></span></p> </a>

	          
		          <ul class="dropdown-menu" id="dropdown_login">
		            <li>
		            	<p>Login</p>
		            	<input type="text" class="form-control" id="usuario_login" />
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

			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="img/escritorio02.jpg" alt="escritorio">
			      <div class="carousel-caption">
			        <h2>Nossos Serviços de construção são os melhores</h2>
			        <p>Somos uma empresa que cuida muito do que vocês tem e sempre se preocupa com a solução de sua empresa.</p>
			      </div>
			    </div>

			    <div class="item">
			      <img src="img/escritorio02.jpg" alt="escritorio02">
			      <div class="carousel-caption">
			        <h2>Temos um ótimos Arquitetos disponiveis</h2>
			        <p>Temos Uma grande equipe de arquiteto sempre disposto a dar o seu melhor para poder deixar sua empresa brilhando.</p>
			      </div>
			    </div>

			    <div class="item">
			      <img src="img/escritorio02.jpg" alt="building01">
			      <div class="carousel-caption">
			        <h2>Fazemos ótimos planejamento de construção</h2>
			        <p>Nosso Engenheiro são os melhores para lidar com várias situções que envolva construção.</p>
			      </div>
			    </div>
			    
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
			<hr/>
			<div class="row"> 
				<dir class="col-xs-12">

					<h2>Faça seu pedido aqui</h2>

					<div  class="form-group">
						<label>selecione o tipo de serviço que gostaria</label>
						<select id="sele_servico" class="form-control">
							<option value="Arquitetura">Aquitetura</option>
							<option value="Engenharia">Engenharia</option>
							<option value="Construcao">Construção</option>
							<option value="Modelagem3D">Modelagem 3D</option>
							<option value="DesenvolvimentoApp">Desenvolvimento de App</option>
							<option value="DesenvolvimentoSite">Desenvolvimento de Site</option>
						</select>
					</div>

					<div class="form-group">
						<label>Descrição do serviço</label>
						<textarea class="form-control" id="descri"></textarea>
					</div>

					<div class="form-group">
						<label>Endereço</label>
						<input type="text" id="endereco" class="form-control" />
					</div>

					<div class="form-group">
						<label>Numero</label>
						<input type="number" id="numero" class="form-control" />
					</div>

					<div class="form-group">
						<label>Complementar</label>
						<input type="text" id="complementar" class="form-control" />
					</div>

					<div class="form-group">
						<label>estado</label>
						<select id="estado" class="form-control">
							<option value="">Selecione um estado</option>
						</select>
					</div>

					<div class="form-group">
						<label>cidade</label>
						<select id="cidade" class="form-control" disabled>
							<option value="">Selecione uma cidade</option>
						</select>
					</div>

					<div class="form-group">
						<label>CEP</label>
						<input type="text" id="cep" class="form-control" />
					</div>

					<div class="form-group">
						<label>Data</label>
						<input type="text" id="data" class="form-control" />
					</div>

					<div class="form-group">

						<ul class="payment-methods">
						  <li class="payment-method paypal">
						    <input name="payment_methods" type="radio" id="paypal">
						    <label for="paypal">PayPal</label>
						  </li>

						  <li class="payment-method pagseguro">
						    <input name="payment_methods" type="radio" id="pagseguro">
						    <label for="pagseguro">PagSeguro</label>
						  </li>

						  <li class="payment-method bankslip">
						    <input name="payment_methods" type="radio" id="bankslip">
						    <label for="bankslip">Boleto</label>
						  </li>
						</ul>

					</div>

					<div class="form-group check_img">
						 
					     	<input type="radio" id="shipadd2" name="address" />
					     	<label for="shipadd2">One</label> &nbsp;&nbsp;&nbsp;&nbsp;					     
					     
					     	<input type="radio" id="shipadd3" name="address" />
					     	<label for="shipadd3">Two</label>

					     	<input type="radio" id="shipadd4" name="address" />
					     	<label for="shipadd4">Three</label>   					     
					     
					</div>

					<br/><br/><br/><br/><br/><br/>

					<button id="soli_pedido" class="btn btn-primary">Solicitar Pedido</button>

				</dir>
			</div>
			

	</div>

	<footer>
		
	</footer>

</body>
</html>