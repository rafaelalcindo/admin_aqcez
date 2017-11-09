$(document).ready(function(){
	let pagina = 1;
	primeiraPagina(pagina);
});

function primeiraPagina(pg){
	let pg_pass = new FormData();
	pg_pass.append('pg_noticia', pg);

	$.ajax({
		method: 'post',
		processData: false,
		contentType: false,
		data: pg_pass,
		url: '../../controllers/recadosController.php/pegarTodasNoticias',
		dataType: 'json',
		success: function(data){
			$.each(data, function(key, val){
				
					let noticia_geral = completarPainelNoticia(val);
					$('#painel_noticias').append(noticia_geral);			
					
			});
		},
		complete: function(){
			$.ajax({
				method: 'get',
				url: '../../controllers/recadosController.php/numPaginasNoticiaGeral',
				dataType: 'text',
				success: function(data){
					if( data >= 0){
						alert(data);
						
					}else{
						alert('paginação 0');
					}
				}
			});
		}
	});
}


function completarPainelNoticia(obj){
	let noticiaGeral = "<a href='noticiaGeral.php?geral="+obj.id+"' class='list-group-item'>";
	noticiaGeral += "<h4 class='list-group-item-heading'>"+obj.titulo+"</h4>";
	noticiaGeral += "<p class='list-group-item-text'>"+obj.descricao+"</p>";
	noticiaGeral += "</a>";
	return noticiaGeral;
}