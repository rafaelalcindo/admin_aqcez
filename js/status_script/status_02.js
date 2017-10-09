
$(document).ready(function(){
	//alert('Funcionou');

	iniciarPaginaFluxo();


	$('#ad_orcamento').click(function(){
		var obra  		= $('#obra').val();
		var area  		= $('#area').val();
		var itens 		= $('#itens').val();
		var obs_contato = $('#obs_contato').val();
		var id_user		= $('#id_user').val();

		alert(obra);
		alert(area);
		alert(itens);
		alert(obs_contato);
		alert(id_user);

		var data_primeiro = new FormData();

		data_primeiro.append('obra', obra);
		data_primeiro.append('area', area);
		data_primeiro.append('obs', obs_contato);
		data_primeiro.append('itens', itens);
		data_primeiro.append('id_user', id_user);

		$.ajax({
			
			type: "POST",
			processData: false,
			contentType: false,
			data: data_primeiro,
			url: "sys_fluxo/controller.php/fluxo/first",
			dataType: 'text',
			success: function(data){
				alert("fluxo First: "+data);
			}

		});


	});

	$('#add_fluxo').click(function(){

		var id_user = $('#sele_nome').val();
		var id_step = $('#id_step').val();
		var status  = $('#status').val();
		var visu 	= $('#visu').val();

		//alert("id user: "+id_user+" id step: "+id_step);
		//alert("Status: "+status+" visu: "+visu);

		var dataPassos = new FormData();
		dataPassos.append('step_orc_id', id_step);
		dataPassos.append('usuario_id', id_user);
		dataPassos.append('status', status);
		dataPassos.append('passo_visu', visu);

		$.ajax({
			type: "POST",
			processData: false,
			contentType: false,
			data: dataPassos,
			url: "sys_fluxo/controller.php/fluxo/segue",
			dataType: 'text',
			success: function(data){
				//alert(data);
				if(data == 'true'){
					location.reload();
				}
			}
		});

	});

	function iniciarPaginaFluxo(){
		var id_user		= $('#id_user').val();

		//alert('entrou script');

		var data_id = new FormData();
		data_id.append('id_user', id_user);

		$.ajax({
			type: "POST",
			processData: false,
			contentType: false,
			data: data_id,
			url: "sys_fluxo/controller.php/fluxo/pegarPrimeiro",
			dataType: 'json',
			success: function(data){
				//alert(data);
				$.each(data, function(key, val){

					var FirstBlock = iniciarFluxoPanel(val);
					$('#panel_orc').append(FirstBlock);

					//alert(val.passos.tem_passos);
					$.each(val.passos, function(key, val){
						//alert("Mais teste: "+val.id_user);
						var val_fluxo = addOutrosFluxos(val);
						$("#painel_step"+val.step_id).after(val_fluxo);
						
					});

					var id_user_again = $('#id_user').val();
					verificaPessoaAdd(id_user_again, val.id_step);

				});
			}
		});


		$.ajax({
			type: "POST",
			processData: false,
			contentType: false,
			data: data_id,
			url: "sys_fluxo/controller.php/fluxo/getAllUsers",
			dataType: 'json',
			success: function(data){
				$.each(data, function(key, val){
					var option = "<option value="+val.id_user+">"+val.nome+" "+val.sobrenome+"</option>";
					$('#sele_nome').append(option);
				});
			}
		});


	}

	function iniciarFluxoPanel(objeto){

		var fragment = "<div class='col-md-12 linha_prin' style='overflow-x: auto;' id='container_fluxo"+objeto.id_step+"' >";
        fragment += "<button class='btn btn-danger' style='float: right;' onclick='fecharFluxo("+objeto.id_step+")' id='btn_fecharFluxo"+objeto.id_step+"' >X</button> ";
        fragment += "<table style='margin-top: 60px;' ><tr id='tr_fluxo"+objeto.id_step+"' ><td id='painel_step"+objeto.id_step+"' >";
        fragment += "<div class='panel panel-success'  >";
        fragment += "<div class='panel-heading'>Etapa 1 - pedido de Orçamento</div>";
        fragment += "<div class='panel-body'>";
        fragment += "<label>Obra:</label><p>"+objeto.obra+"</p>";
        fragment += "<label>Obsevação: </label><p>"+objeto.obs+"</p>";
        fragment += "<label>Obsevação: </label><p>"+objeto.itens+"</p>";
        fragment += "<button class='btn btn-default' data-toggle='modal' data-target='#modalContatoInfo'> Informações </button>";
        fragment += "</div></div></td> ";
        return fragment;

	}

	function addOutrosFluxos(objeto){

		var script = "<td style='padding: 30px;'>";
        script += " <span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span>";
        script += "</td><td>";
        script += "<div class='panel panel-success'>";
        script += "<div class='panel-heading'> Orçamento com pessoal de engenharia</div>";
        script += "<div class='panel-body'>";
        script += "<label>Status: </label>";
        script += "<p>"+objeto.status+".</p>";
        script += "<label>Visualizacao: </label>";
        script += "<p>"+objeto.visu+".</p>";
        script += "<label>Adicionar info</label>";
        script += "<button class='btn btn-default' data-toggle='modal' data-target='#modalAddInfo'>Adicionar suas informações</button>";        
        script += "</div></div></td>";

    	return script;
	}

	

	function verificaPessoaAdd(id_user, step_id){
		
		var data_id = new FormData();
		data_id.append('id_user', id_user);
		data_id.append('step_orc_id', step_id);

		$.ajax({

			type: "POST",
			processData: false,
			contentType: false,
			data: data_id,
			url: "sys_fluxo/controller.php/fluxo/checaAuthAdd",
			dataType: 'text',
			success: function(data){
				//alert(data);
				if(data == "true"){
					var fragment = "<td style='padding: 30px;' >";
			        //fragment += "<button class='btn btn-success' id='add_etapa' onclick='addPassos("+num+")' ></button>";
			        fragment += "<button class='btn btn-success' id='add_etapa' onclick='modalAddNovaEtapa("+step_id+")' ></button>";       
			        fragment += "</td></tr></table></div>";
					$("#tr_fluxo"+step_id).append(fragment);
				}
			}

		});
	}

	




});