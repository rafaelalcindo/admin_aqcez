$(document).ready(function(){


	let id_user = $('#id_user').val();
	preecherTabelContatos(id_user);
	preencherTabelaContatosHoje(id_user);

	let nomescontatos = ListarNomesContatosPessoal(id_user);
	console.log(nomescontatos);

	var options = {
		data: nomescontatos,
		getValue: "contato",
		list: {
			match:{
				enabled: true
			}
		}
	};

	$('#filtro_contato').easyAutocomplete(options);

	$('#div_barra_de_progresso').hide();
	$('#btn_importar_ex_carregado').hide();

	$("#btn_importar_excell").on('change', function(){
		
		if($(this).val() != '' && $(this).val() != undefined ){
			
			let validacao = validarArquivo($("#btn_importar_excell").prop('files')[0]);
			if(validacao){
				$('#div_barra_de_progresso').show('slow');
				carregarBarra();
			}else{
				alert('Por favor coloque arquivo com extensão .xls');
			}
		}
	});

	$('#btn_salvar').click(function(){

		let cad_contato = [];

		cad_contato['empresa']  	 = $('#cad_empresa').val();
		cad_contato['contato']  	 = $('#cad_contato').val();
		cad_contato['telefone'] 	 = $('#cad_telefone').val();
		cad_contato['endereco'] 	 = $('#cad_endereco').val();
		cad_contato['status']   	 = $('#cad_situacao').val();
		cad_contato['retorno']  	 = $('#cad_retorno').val();
		cad_contato['motivo']    	 = $('#cad_motivo').val();
		cad_contato['probabilidade'] = $('#proba_contato').val();
		cad_contato['projeto']		 = $('#cad_projeto').val();
		cad_contato['turn_key']		 = $('#cad_quant_turn_key').val();
		cad_contato['interiores']	 = $('#cad_quant_interiores').val();
		cad_contato['mobiliario']	 = $('#cad_quant_mobiliario').val();
		cad_contato['observacao']	 = $('#cad_observacao').val();

		cad_contato['id_user']  = $('#id_user').val();

		
		if(validacaoCadastro(cad_contato)){
			salvarContato(cad_contato);
		}


	});

	$('#btn_editar').click(function(){
		let edit_contato = [];

		edit_contato['empresa']  		= $('#edit_empresa').val();
		edit_contato['contato']			= $('#edit_contato').val();
		edit_contato['telefone']		= $('#edit_telefone').val();
		edit_contato['endereco']		= $('#edit_endereco').val();
		edit_contato['status']			= $('#edit_situacao').val();
		edit_contato['retorno'] 		= $('#edit_retorno').val();
		edit_contato['motivo']			= $('#edit_motivo').val();
		edit_contato['probabilidade']	= $('#edit_proba_contato').val();
		edit_contato['projeto']			= $('#edit_projeto').val();
		edit_contato['turn_key']		= $('#edit_quant_turn_key').val();
		edit_contato['interiores']		= $('#edit_quant_interiores').val();
		edit_contato['mobiliario']		= $('#edit_quant_mobiliario').val();
		edit_contato['observacao']		= $('#edit_observacao').val();

		edit_contato['id_user']			= $('#id_user').val();
		edit_contato['id_contato']		= $('#edit_id_contato').val();

		if(validacaoCadastro(edit_contato)){
			EditarContato(edit_contato);	
		}		

	});


	$('#filtro_contato').bind("change paste keyup",function(){
		let filtro_contato = [];

		$('#table_body_filtro').children().remove();
		
		filtro_contato['id_user'] 		= $('#id_user').val();
		filtro_contato['nome_contato']	= $('#filtro_contato').val();
		filtro_contato['filtro_data']	= $('#filtro_data').val();

		console.log("nome: "+ filtro_contato['nome_contato']);
		console.log("filtro: "+ filtro_contato['filtro_data']);


		preencherTebelaContatoFiltro(filtro_contato);


	});


	$('#btn_importar_ex_carregado').click(function(){
		let file_upload_excell = $("#btn_importar_excell").prop('files')[0];
		let id_user			   = $('#id_user').val();

		let uploadfile = new FormData();
		uploadfile.append('excell', file_upload_excell);
		uploadfile.append('dono_contato', id_user);
		console.log('entrou no click')
		salvarUploadExcell(uploadfile);

	});



	
})


// ===================================================== Preencher Contatos ================================================


function preecherTabelContatos(id_user){


	let dataIdForm = new FormData();
	dataIdForm.append('dono_contato', id_user);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dataIdForm,
		url: 'controller/controller.php/contatos/listarContatos',
		
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Buscando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){
			preencherDadosTotais(data);
		},
		complete: function(){
			$.unblockUI();
		}


	});
	
}

function preencherTabelaContatosHoje(id_user){
	let dataHoje = GetDataHoje();
	
	let TabelaHoje = new FormData();
	TabelaHoje.append('dono_contato', id_user);
	TabelaHoje.append('dataHoje', dataHoje);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: TabelaHoje,
		url: 'controller/controller.php/contatos/listarhoje',
		
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Buscando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){
			preencherDadosContatosHoje(data);
		},
		complete: function(){
			$.unblockUI();
		}

	})
}

function preencherTebelaContatoFiltro(dados_filtro){
	let dadosEnviar		= new FormData();
	dadosEnviar.append('dono_contato', dados_filtro['id_user']);
	dadosEnviar.append('nome_contato', dados_filtro['nome_contato']);
	dadosEnviar.append('data_reuni',   dados_filtro['filtro_data']);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dadosEnviar,
		url: 'controller/controller.php/contatos/listarFiltro',		
		dataType: 'json',
		beforeSend: function(){
			/*$.blockUI({ 
				message: '<h2>Buscando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } }); */
		},
		success: function(data){
			preencherDadosContatosFiltro(data);
		},
		complete: function(){
			//F$.unblockUI();
		}
	})
}

// ============================================  preencher nomesContatos ============================================

	function ListarNomesContatosPessoal(id_user){
		let dadosEnviar		= new FormData();
		let nomescontatos = '';

		dadosEnviar.append('dono_contato', id_user);

		$.ajax({
			type: 'post',
			processData: false,
			contentType: false,
			data: dadosEnviar,
			url: 'controller/controller.php/contatos/PegarNomescontatosPessoal',
			async: false,
			dataType: 'json',
			success: function(data){
				nomescontatos = data;
			}
		});

		return nomescontatos;
	}




// ================================================== CRUD CRM ======================================================


function salvarContato(contato){

	let dadosEnviar = new FormData();
	dadosEnviar.append('nome_emp', contato['empresa']);
	dadosEnviar.append('nome_contato', contato['contato']);
	dadosEnviar.append('tel_contato', contato['telefone']);
	dadosEnviar.append('end_contato', contato['endereco']);
	dadosEnviar.append('status_contato', contato['status']);
	dadosEnviar.append('retorno_contato', contato['retorno']);
	dadosEnviar.append('motivo_contato', contato['motivo']);
	dadosEnviar.append('probabilidade_contato', contato['probabilidade'] );
	dadosEnviar.append('projetos', contato['projeto']);
	dadosEnviar.append('turn_key', contato['turn_key']);
	dadosEnviar.append('interiores', contato['interiores']);
	dadosEnviar.append('mobiliario', contato['mobiliario']);
	dadosEnviar.append('observacao', contato['observacao']);

	dadosEnviar.append('dono_contato', contato['id_user']);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dadosEnviar,
		url: 'controller/controller.php/contatos/salvar',		
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Salvando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){
			limparCamposSalvar();
			location.reload();
		},
		complete: function(){
			$.unblockUI();
		}

	});

}

function salvarUploadExcell(dataForm){
	console.log('entrou no salvar')
	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dataForm,
		url: 'controller/controller.php/contatos/importarContatosExcell',
		
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Mandando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){
			console.log(data);
			//console.log(data.status);
			window.location.reload();
		},
		complete: function(){
			$.unblockUI();
			window.location.reload();
		}
	});
}

function EditarContato(contato){
	let dadosEditar = new FormData();
	dadosEditar.append('nome_emp', contato['empresa']);
	dadosEditar.append('nome_contato', contato['contato']);
	dadosEditar.append('tel_contato', contato['telefone']);
	dadosEditar.append('end_contato', contato['endereco']);
	dadosEditar.append('status_contato', contato['status']);
	dadosEditar.append('retorno_contato', contato['retorno']);
	dadosEditar.append('motivo_contato', contato['motivo']);
	dadosEditar.append('probabilidade_contato', contato['probabilidade']);
	dadosEditar.append('projetos', contato['projeto']);
	dadosEditar.append('turn_key', contato['turn_key']);
	dadosEditar.append('interiores', contato['interiores']);
	dadosEditar.append('observacao', contato['observacao']);
	dadosEditar.append('dono_contato', contato['id_user']);
	dadosEditar.append('id_contato', contato['id_contato']);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dadosEditar,
		url: 'controller/controller.php/contatos/editar',
		
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Editando Dados</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){
			location.reload();
		},
		complete: function(){
			$.unblockUI();
		}

	});
}



function preencherDadosEditar(id){
	
	let dadosEditar = new FormData();

	dadosEditar.append('id_contato', id);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dadosEditar,
		url: 'controller/controller.php/contatos/pegarContato',
		async: false,
		dataType: 'json',
		success: function(data){
			limparComposEditar();
			preencherDadosEditarForm(data);
			$('#modal_edit').modal('show');
		}
	});
}

function openDeletarModal(id){
	$('#del_id_contato').val('');
	$('#del_id_contato').val(id);
	$('#modal_deletar').modal('show');
}

function deletarDadosContato(){
	let id = $('#del_id_contato').val();
	let dadosDeletar = new FormData();

	dadosDeletar.append('id_contato', id);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dadosDeletar,
		url: 'controller/controller.php/contatos/deletar',
		async: false,
		dataType: 'text',
		success: function(data){
			if(data == 'true'){
				location.reload();
			}else{
				alert('Falha de deletar o cliente!');
			}
		}
	});
}





// ============================================= preencher dados ========================================================================

function preencherDadosTotais(data){

	let bodyTable = "";
	$.each(data, function(key, val){
		bodyTable += "<tr>";
		bodyTable += "<td>"+val.retorno+"</td><td>"+val.empresa+"</td><td>"+val.contato+"</td><td>"+val.tel+"</td><td>"+val.projetos+"</td>";
		bodyTable += "<td>"+val.turn_key+"</td><td>"+val.interiores+"</td><td>"+val.mobiliario+"</td><td>"+val.total+"</td><td>"+val.status+"</td>";
		bodyTable += "<td>"+val.motivo+"</td><td style='background-color: "+val.sinal+"' >"+val.probabilidade+"%</td>"
		bodyTable += "<td> <button type='button' data-toggle='modal' data-target='modal_edit' onclick='preencherDadosEditar("+val.id_contatos+")' class='btn btn-success' > <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </button> ";
		bodyTable += "<button type='button' id='btn_modal_deletar' class='btn btn-danger' onclick='openDeletarModal("+val.id_contatos+")' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";		
		bodyTable += "</tr>";
	})
	

	$('#table_body_todos').append(bodyTable);

}

function preencherDadosContatosHoje(data){
	let bodyTable = '';
	$.each(data, function(key, val){

		if(val.retorno !== undefined){
			bodyTable += "<tr>";
			bodyTable += "<td>"+val.retorno+"</td><td>"+val.empresa+"</td><td>"+val.contato+"</td><td>"+val.tel+"</td><td>"+val.projetos+"</td>";
			bodyTable += "<td>"+val.turn_key+"</td><td>"+val.interiores+"</td><td>"+val.mobiliario+"</td><td>"+val.total+"</td><td>"+val.status+"</td>";
			bodyTable += "<td>"+val.motivo+"</td><td style='background-color: "+val.sinal+"' >"+val.probabilidade+"%</td>"
			bodyTable += "<td> <button type='button' data-toggle='modal' data-target='modal_edit' onclick='preencherDadosEditar("+val.id_contatos+")' class='btn btn-success' > <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </button> ";
			bodyTable += "<button type='button' class='btn btn-danger' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";		
			bodyTable += "</tr>";
		}
		
	});

	$('#table_body_hoje').append(bodyTable);
}

function preencherDadosContatosFiltro(data){
	let bodyTable = '';
	$.each(data, function(key, val){
		if(val.retorno !== undefined){
			bodyTable += "<tr>";
			bodyTable += "<td>"+val.retorno+"</td><td>"+val.empresa+"</td><td>"+val.contato+"</td><td>"+val.tel+"</td><td>"+val.projetos+"</td>";
			bodyTable += "<td>"+val.turn_key+"</td><td>"+val.interiores+"</td><td>"+val.mobiliario+"</td><td>"+val.total+"</td><td>"+val.status+"</td>";
			bodyTable += "<td>"+val.motivo+"</td><td style='background-color: "+val.sinal+"' >"+val.probabilidade+"%</td>"
			bodyTable += "<td> <button type='button' data-toggle='modal' data-target='modal_edit' onclick='preencherDadosEditar("+val.id_contatos+")' class='btn btn-success' > <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </button> ";
			bodyTable += "<button type='button' class='btn btn-danger' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";		
			bodyTable += "</tr>";
		}
	})

	$('#table_body_filtro').append(bodyTable);
}

function limparCamposSalvar(){
	$('#cad_empresa').val('');
	$('#cad_contato').val('');
	$('#cad_telefone').val('');
	$('#cad_endereco').val('');
	$('#cad_retorno').val('');
	$('#proba_contato').val('');
	$('#cad_projeto').val('');
	$('#cad_quant_turn_key').val('');
	$('#cad_quant_interiores').val('');
	$('#cad_quant_mobiliario').val('');
	$('#cad_observacao').val('');
}

function limparComposEditar(){
	$('#edit_empresa').val('');
	$('#edit_contato').val('');
	$('#edit_telefone').val('');
	$('#edit_endereco').val('');
	$('#edit_retorno').val('');
	$('#edit_proba_contato').val('');
	$('#edit_projeto').val('');
	$('#edit_quant_turn_key').val('');
	$('#edit_quant_interiores').val('');
	$('#edit_quant_mobiliario').val('');
	$('#edit_observacao').val('');
	$('#edit_id_contato').val('');
}

function preencherDadosEditarForm(data){
	$('#edit_id_contato').val(data[0].id_contatos);
	$('#edit_empresa').val(data[0].empresa);
	$('#edit_contato').val(data[0].contato);
	$('#edit_telefone').val(data[0].tel);
	$('#edit_endereco').val(data[0].end);
	$('#edit_retorno').val(data[0].retorno);
	$('#edit_proba_contato').val(data[0].probabilidade);
	$('#edit_projeto').val(data[0].projetos);
	$('#edit_quant_turn_key').val(data[0].turn_key);
	$('#edit_quant_interiores').val(data[0].interiores);
	$('#edit_quant_mobiliario').val(data[0].mobiliario);
	$('#edit_observacao').val(data[0].observacao);

}







//============================================ helper Functions ========================================================


function validacaoCadastro(contato){
	if(contato['empresa'].trim() == ''){
		alert('Por favor digite o nome da empresa!');
		return false;
	}else if(contato['contato'].trim() == ''){
		alert('Por favor digite o nome do seu contato!');
		return false;
	}else if(contato['telefone'].trim() == ''){
		alert('Por favor digite o telefone do seu contato!')
		return false;
	}else if(contato['endereco'].trim() == ''){
		alert('Por favor digite o endereco do contato');
		return false;
	}else if(contato['retorno'].trim() == ''){
		alert('Por favor digite a data do retorno');
		return false;
	}else if(contato['probabilidade'].trim() == '' ){
		alert('Por favor digite a probabilidade de aceitação');
		return false;
	}else if(contato['projeto'].trim() == ''){
		alert('Por favor digite o nome do projeto');
		return false;
	}else{
		return true;
	}
}





//-------- - - - - - - - -- - -   Formatar Data --- - - - - - - - -- - - - - - - - - -

function GetDataHoje(){
	let dia     = new Date();
	let formato = moment(dia).format('YYYY-MM-DD');
	return formato;
}


//-------------------------------- Validando arquivos ---------------------------------

function validarArquivo(file){
	let ext_permitida = ['xls'];
	let extention = file.name.split('.').pop().toLowerCase();
	if($.inArray(extention, ext_permitida) ){
		return false;
	}else{ return true; }

}


function carregarBarra(){
	let val = 0;
	let intervalo = setInterval(() => {
		val = val + 1;
		$('#barra_carrega_excell').css("width", val+"%");
		if(val == 100){
			clearInterval(intervalo);
			$('#btn_importar_ex_carregado').show();
		}

	}, 50);
}
