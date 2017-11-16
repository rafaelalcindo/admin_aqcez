$(document).ready(function(){

	$('#consultar').click(function(){
		let data_ini = $('#data_ini').val();
		let data_fim = $('#data_fim').val();


	});

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
		url: '',
		async: false,
		dataType: "json",
		success: function(data){
			$.each(data,function(i, item){
				
			});
		}
	});
}