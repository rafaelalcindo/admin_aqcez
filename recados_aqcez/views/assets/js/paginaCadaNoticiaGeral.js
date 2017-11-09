$(document).ready(function(){

	let searchParams = new URLSearchParams(window.location.search);
	//alert(searchParams.get("geral"));
	let id_noticia = searchParams.get("geral");
	iniciarPaginaNews(id_noticia);
	
});

function iniciarPaginaNews(id){
	let id_form = new FormData();
	id_form.append('id',id);
	
	$.ajax({
		method: 'post',
		processData: false,
		contentType: false,
		data: id_form,
		url: '../../controllers/recadosController.php/pegarNoticiaCada',
		dataType: 'json',
		success: function(data){
			if(data.status == 'true'){
				$('#titulo').append(data.titulo);
				$('#descricao').append(data.descricao);
				$('#texto').append(data.texto);
				$('#data').append(data.data);
				$('#hora').append(data.hora);
			}else{
				alert('deu errado.');
			}
		}
	});
}