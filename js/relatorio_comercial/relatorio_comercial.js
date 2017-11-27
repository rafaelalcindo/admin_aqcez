$(document).ready(function(){

	$('#consultar').click(function(){

		let data_ini = $('#data_ini').val();
		let data_fim = $('#data_fim').val();

		getRelatorio(data_ini, data_fim);
		
	});

	getNomesComercial();


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
	
	$('#corpo').append("<tr> <td>"+data+"</td> "+constructTds(item)+" </tr>");
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