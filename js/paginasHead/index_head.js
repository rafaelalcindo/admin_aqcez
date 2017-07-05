
		
		
		$(document).ready(function(){
			getEstado();

			
			

			$('#data').datepicker({

				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom', 'Seg', 'ter','Qua','Qui','Sex','Sáb'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Aug','Set','Out','Nov','Dez'],
				nextText: "Próximo",
				prevText: "Anterior",
				minDate: '0d'

			});

			$('#soli_pedido').click(function(){
				var servico    = $('#sele_servico').val();
				var descricao  = $('#descri').val();
				var endereco   = $('#endereco').val();
				var numero 	   = $('#numero').val();
				var complement = $('#complementar').val();
				var estado     = $('#estado').val();
				var cidade 	   = $('#cidade').val();
				var cep        = $('#cep').val();
				var data 	   = $('#data').val();

				//alert("Serviço: "+servico+" Descri: "+descricao+" Endereco: "+endereco+" Numero: "+numero+" Complementar: "+complement+" estado: "+estado+" cidade: "+cidade+" cep: "+cep+" data: "+data );

				var validarPedi = {
					servico: servico,
					descricao: descricao,
					endereco: endereco,
					numero: numero,
					complement: complement,
					estado: estado,
					cidade: cidade,
					cep: cep,
					data: data
				}
				
				if(validarForm(validarPedi)){
					$.ajax({
						type: "POST",
						url: "cad_pedido/controller.php?servico="+servico+"&descricao="+descricao+"&endereco="+endereco+"&numero="+numero+"&complement="+complement+"&estado="+estado+"&cidade="+cidade+"&cep="+cep+"&data="+data+"&tipo=cad_pedido",
						dataType: "text",
						async: false,
						success: function(data){
							alert(data);
							if(data == 'true'){
								window.location.href= 'listar_pedido.php';
							}
						}
					});
				}else{
					alert('Preencha todos os campos!');
				}

			});


			$('#logar').click(function(){
				
				var usuario_login = $('#usuario_login').val();
				var usuario_senha = $('#senha_login').val();

				//alert(usuario_login+"  "+usuario_senha);

				if(usuario_login.trim() != '' && usuario_senha.trim() != '' ){
					
					$.ajax({
						type: "POST",
						url: "login/controller.php?login=logarUsuario&usuario="+usuario_login+"&senha="+usuario_senha,
						dataType: "text",
						success: function(data){
							alert(data);
							if(data == 'true'){
								alert('logou');
								location.reload();
							}else{
								alert('falha de login, verifique o seu usuário ou senha');
							}
						}	
					});
				}else{
					alert('campos deixados em branco');
				}

				
			});


		});

		function validarForm(Objeto){
			if(Objeto.servico.trim() == '' 			|| Objeto.servico == null){
				return false;
			}else if(Objeto.descricao.trim() == ''	|| Objeto.descricao == null){
				return false;
			}else if(Objeto.endereco.trim() == ''	|| Objeto.endereco == null ){
				return false;
			}else if(Objeto.numero.trim() == '' 	|| Objeto.numero == null){
				return false;
			}else if(Objeto.complement.trim() == '' || Objeto.complement == null){
				return false;
			}else if(Objeto.estado.trim() == '' 	|| Objeto.estado == null){
				return false;
			}else if(Objeto.cidade.trim() == '' 	|| Objeto.cidade == null){
				return false;
			}else if(Objeto.cep.trim() == '' 		|| Objeto.cep == null){
				return false;
			}else if(Objeto.data.trim() == ''		|| Objeto.data == null){
				return false;
			}else{
				return true;
			}
		}

		function getEstado(){
			$.getJSON("lista_cidade_estado/lista_estado.php", function(data){
				$.each(data, function(key, val){					
					var texto_inserir = "<option value="+val.id+">"+val.nome+"</option>";
					$('#estado').append(texto_inserir);
				});
			});
		}

		$(function(){
			$('#estado').change(function(){
				var id = $(this).val();
				
				$.ajax({
					type: "POST",
					url: "lista_cidade_estado/lista_cidade.php?id="+id,
					dataType: "json",
					success: function(data){
						$('#cidade').children('.cidade').remove();
						$('#cidade').removeAttr('disabled').focus();
						$.each(data, function(key, val){
							var texto_cid_in = "<option value="+val.id+" class='cidade'>"+val.nome+"</option>";
							$('#cidade').append(texto_cid_in);
						});
						
					}
				});

			});
		});


