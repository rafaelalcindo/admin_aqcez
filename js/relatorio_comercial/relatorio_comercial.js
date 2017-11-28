$(document).ready(function(){

	$('#consultar').click(function(){

		let data_ini = $('#data_ini').val();
		let data_fim = $('#data_fim').val();

		LimparDadosTabela();

		if(data_ini.trim() != ''){
			getRelatorio(data_ini, data_fim);
		}else{
			let currentDate = new Date();
			let day   = currentDate.getDate();
			let month = currentDate.getMonth()+1;
			let year  = currentDate.getFullYear();
			let formatar = year+"-"+month+"-"+day;
			data_ini = formatar;			
			getRelatorio(data_ini, data_fim);
		}		
		
	});	

	getNomesComercial();

	let id_user = $('#id_user').val();
	verificaPermissaoVisurelatorio(id_user);

});


function getRelatorio(data_ini, data_fim){
	let data = new FormData();
	data.append('data_ini', data_ini);
	data.append('data_fim', data_fim);

	$.ajax({
		type: 'POST',
		processData: false,
		contentType: false,
		data: data,
		url: '../sys_agenda/controller.php?agenda=relatorioVisitas',
		async: false,
		dataType: "json",
		success: function(data){
		 	
				$.each(data,function(i, item){					
					//console.log(i);
					constructBody(i, item);
				});
			
		}
	});

	$.ajax({
		type: 'POST',
		processData: false,
		contentType: false,
		data: data,
		url: '../sys_agenda/controller.php?agenda=ListarQuantReuni',
		async: false,
		dataType: "json",
		success: function(data){
			CalcuQuantEventos(data);
		}
	});
}

function getNomesComercial(){
	$.ajax({
		type: 'get',
		url: '../sys_agenda/controller.php?agenda=ReuniaoRelatorioNomeVend',
		async: false,
		dataType: "json",
		success: function(data){
			//console.log(data);
				
			$.each(data, function(key, val){						
					$('#relatorio_nome').append("<th id="+val.nome+" >"+val.nome+"</th>");						
			});
				
		}
	});
}



// Construido os tds do TBody
function constructBody(data, item){
	
	$('#corpo').append("<tr> <td>"+FormatarData(data)+"</td> "+constructTds(item)+" </tr>");
	//console.log(item);
	
	$.each(item, function(key, val){
		//console.log("chave: "+key);
		//console.log("valor: "+val);
	});
}

function constructTds(item){
	let td_val;
	$('#relatorio_nome th').each(function(){
		let val = $(this).attr('id');
		let cont = 0;

		if(val !== undefined){
			td_val += '<td>';
			 //console.log('val_id: '+val);
			$.each(item, function(key, valor){
				//console.log("chave: "+key);
				//console.log("valor: "+val);
				cont++;
				if(key == val){
					 td_val += valor;

				}else{
					 
				}
			});

			td_val += '</td>';
		}
		 
	});

	return td_val;
} 

function CalcuQuantEventos(data){
	let td_val = "<td><h3>Total</h3></td>";
	$('#relatorio_nome th').each(function(){
		let val = $(this).attr('id');

		if(val !== undefined){
			td_val += '<td>';
			$.each(data, function(i, item){
				if(val == item.nome){
					td_val += "<h3>"+item.qtd_reuni+"</h3>";
				}else{

				}
			});

			td_val += "</td>";
		}
	});

	$('#table_footer').append(td_val);

}

//================================================Formatar Data ============================================

function FormatarData(data){
	let novaData = new Date(data);
	let dia = novaData.getDate();
	let mes = novaData.getMonth()+1;
	let ano = novaData.getFullYear();

	let novoFormato = dia+"/"+mes+"/"+ano;	
	return novoFormato;
}

// ======================================= Verificar autorizacao ==================================

function verificaPermissaoVisurelatorio(id){
	let id_data = new FormData();
    id_data.append('id', id);
    $.ajax({
        type: 'post',
        url: '../login/controller.php?login=verificaPermissaoRelatorioComericial',
        processData: false,
        contentType: false,
        data: id_data,
        dataType: 'json',
        success: function(data){
            if(data.status){
               
            }else{ window.location.href = "../painel_controle.html"; }
        }
    });
}

//=========================================== Limpar dados ==================================================

function LimparDadosTabela(){
	$('#table_footer').children().remove();
	$('#corpo').children().remove();
}