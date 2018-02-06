$(document).ready(function(){

	var listagem = []

	ListarTodosContatos();
	listarDataHoje();

	let nomesContatos = listaNomesContatos();
	
	var options = {
		data: nomesContatos,
		getValue: "contato",
		list: {
			match:{
				enabled: true
			}
		}
	};

	$('#filtro_nome').easyAutocomplete(options);

	$('#filtro_nome').bind("change paste keyup", function(){
		console.log($(this).val());
		listagem['nome'] = $(this).val();
		listarPorFiltro(listagem);
	});

	$('#situacao').change(function(){
		let situacao = $("#situacao option:selected").val();
		console.log(situacao);
	});

})

// ====================================== Listagem de Dados ====================================================
function ListarTodosContatos(){
	$.ajax({
		type: 'get',
		url: 'controller/controller.php/contatos/listarTodosContatosComercial',
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
			preencherTodosOsDados(data);
		},
		complete: function(){
			$.unblockUI();
		}

	});
}

function listarPorFiltro(listagem){

	let listagem_pass = new FormData();

	if(listagem['nome'] !== undefined){
		listagem_pass.append('filtro_nome', listagem['nome']);
	}

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: listagem_pass,
		url: 'controller/controller.php/contatos/listarTodosContatosPorFiltro',
		dataType: 'json',
		success: function(data){
			$('#table_todo').children().remove();
			preencherTodosOsDados(data);
		}

	});
}

function listarDataHoje(){
	$.ajax({
		type: 'get',
		url: 'controller/controller.php/contatos/listarTodosContatosPorFiltroProximo',
		dataType: 'json',
		success: function(data){
			preencherTodosOsDadosHojeProximo(data);
		}
	});
}

// ===================================================== Listar Busca por Nome ================================================

function listaNomesContatos(){
	let nomescontatos = '';
	$.ajax({
		type: 'get',
		url: 'controller/controller.php/contatos/PegarNomesContatos',
		async: false,
		dataType: 'json',
		success: function(data){
			nomescontatos = data;

		}
	});

	return nomescontatos;
}

// ======================================================== Listar Filtro ========================================================

function pegarContatosPeloStatus($status){
 	
 	let passaStatus = new FormData();
 	passaStatus.append("situacao", $status);

	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: passaStatus,
		url: '',
		dataType: 'json',
		beforeSend: function(){
			$.blockUI({ 
				message: '<h2>Um momento, estamos processando seus dados...</h2>',
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

		},
		complete: function(){
			$.unblockUI();
		}

	});
}

// ======================================================  Preencher os Dados ===================================================

function preencherTodosOsDados(data){
	let bodyTable = '';

	$.each(data, function(key, val){
		if(val.retorno !== undefined){
			bodyTable += "<tr>";
			bodyTable += "<td>"+val.retorno+"</td><td>"+val.empresa+"</td><td>"+val.contato+"</td><td>"+val.tel+"</td><td>"+val.projetos+"</td>";
			bodyTable += "<td>"+val.turn_key+"</td><td>"+val.interiores+"</td><td>"+val.mobiliario+"</td><td>"+val.total+"</td><td>"+val.status+"</td>";
			bodyTable += "<td>"+val.motivo+"</td><td style='background-color: "+val.sinal+"' >"+val.probabilidade+"%</td><td>"+val.dono_nome+" "+val.dono_sobrenome+"</td>";
			bodyTable += "</tr>";
		}
	});

	$('#table_todo').append(bodyTable);
}

function preencherTodosOsDadosHojeProximo(data){
	let bodyTable = '';

	$.each(data, function(key, val){
		if(val.retorno !== undefined){
			bodyTable += "<tr>";
			bodyTable += "<td>"+val.retorno+"</td><td>"+val.empresa+"</td><td>"+val.contato+"</td><td>"+val.tel+"</td><td>"+val.projetos+"</td>";
			bodyTable += "<td>"+val.turn_key+"</td><td>"+val.interiores+"</td><td>"+val.mobiliario+"</td><td>"+val.total+"</td><td>"+val.status+"</td>";
			bodyTable += "<td>"+val.motivo+"</td><td style='background-color: "+val.sinal+"' >"+val.probabilidade+"%</td><td>"+val.dono_nome+" "+val.dono_sobrenome+"</td>";
			bodyTable += "</tr>";
		}
	});

	$('#table_hj_proximo').append(bodyTable);
}