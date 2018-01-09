$(document).ready(function(){


	let id_user = $('#id_user').val();
	preecherTabelContatos(id_user);
	preencherTabelaContatosHoje(id_user);

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

	
})


function preecherTabelContatos(id_user){


	let dataIdForm = new FormData();
	dataIdForm.append('dono_contato', id_user);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: dataIdForm,
		url: 'controller/controller.php/contatos/listarContatos',
		async: false,
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
		async: false,
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
		async: false,
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
			location.reload();
		},
		complete: function(){
			$.unblockUI();
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
		bodyTable += "<td> <button type='button' class='btn btn-success' > <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </button> ";
		bodyTable += "<button type='button' class='btn btn-danger' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";		
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
			bodyTable += "<td> <button type='button' class='btn btn-success' > <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> </button> ";
			bodyTable += "<button type='button' class='btn btn-danger' ><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td>";		
			bodyTable += "</tr>";
		}
		
	});

	$('#table_body_hoje').append(bodyTable);
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