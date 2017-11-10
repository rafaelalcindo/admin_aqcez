$(document).ready(function(){
	let pagina = 1;
	primeiraPagina(pagina);
});

function primeiraPagina(pg){

	console.log('numero pagina: '+pg);
	let pg_pass = new FormData();
	pg_pass.append('pg_noticia', pg);

	$.ajax({
		method: 'post',
		processData: false,
		contentType: false,
		data: pg_pass,
		async: false,
		url: '../../controllers/recadosController.php/pegarTodasNoticias',
		dataType: 'json',
		success: function(data){
			$.each(data, function(key, val){
					
					let noticia_geral = completarPainelNoticia(val);
					
					$('.listagem_noticia').append(noticia_geral);			
					
			});
		},
		complete: function(){
			$.ajax({
				method: 'get',
				url: '../../controllers/recadosController.php/numPaginasNoticiaGeral',
				dataType: 'text',
				success: function(data){
					if( data >= 0){						
						let resu = paginacaoPainelNoticia(data, pg);
						$('.listagem_paginacao').append(resu);
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


function paginacaoPainelNoticia(num_pagina, pg){

	let paginacao = "<nav aria-label='Page navigation'>";
	paginacao += "<ul class='pagination'>";
	
	paginacao += LacoListandoPagina(num_pagina, pg);
	
	paginacao += " </ul></nav>";
	return paginacao;
}


function LacoListandoPagina(num, pg){
	let pagination = '';	
	let numloop = parseInt(num);
	let newpg = pg - 1;
	let newpgPlus = parseInt(pg) + 1;
	// bloquea  as seta para esquerda
	if(pg == 1){
		pagination += "<li class='disabled'  > <a aria-label='Previous'> <span aria-hidden='tru'>&laquo;</span> </a> </li>";
	}else{
		pagination += "<li > <a style='cursor: pointer;' class='paginacao_noticia_geral' id="+newpg+" aria-label='Previous'> <span aria-hidden='tru'>&laquo;</span> </a> </li>";
	}
		
	for(let i = 1; i <= numloop; i++){
		
		if(i == pg){
			pagination += "<li class='active'><a class='paginacao_noticia_geral' id="+i+">"+i+" </a></li>";
		}else{
			pagination += "<li  ><a style='cursor: pointer;' class='paginacao_noticia_geral' id="+i+"> "+i+"</a></li>";
		}
		
	}

	if(pg == numloop){
		pagination += "<li class='disabled'><a  aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
	}else if(pg < numloop){
		pagination += "<li ><a style='cursor: pointer;' class='paginacao_noticia_geral' id="+newpgPlus+" aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>"
	}

	return pagination;
}

$(document).on('click', '.paginacao_noticia_geral', function(){
	let page = $(this).attr("id");
	$('.listagem_noticia').empty();
	$('.listagem_paginacao').empty(); 	
	primeiraPagina(page);
});