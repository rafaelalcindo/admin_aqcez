$(document).ready(function(){

	PegarNoticiasGeraisPrimeiraPagina();

});


function PegarNoticiasGeraisPrimeiraPagina(){
	$.ajax({
		type: 'get',
		url: '../../controllers/recadosController.php/recados/paginaprincipal',
		dataType: 'json',
		success: function(data){
			$.each(data, function(key, val){
				if(key == 'geral'){
					alert('entrou geral');
					let count = 0;
					$.each(val, function(key, val){
						count++;
						let notiGeral = ConstruirStringNoticiaGeral(val);
						$('#geralNews').append(notiGeral);
						if (count >= 5) {
							$('#geralNews').append('<button type="button" class="btn btn-primary btn-lg">Visualizar mais</button> ');
						}
					});
				}
				if(key == 'dep'){
					
					$.each(val, function(key,val){
						let notiDep = ConstruirStringNoticiaDep(val);
						$('#depNews').append(notiDep);
					});
				}
			});
		}
	});


}






//=============================== String Builder =============================

function ConstruirStringNoticiaGeral(obj){
	let noticiaGeral = '<div class="col-md-11">';
	noticiaGeral += '<div class="card" id="main_noticia" style="width: 100%;" >';
	noticiaGeral += '<div class="card-body">';
	noticiaGeral += "<h4 class='card-title'>"+obj.titulo+"</h4>";
	noticiaGeral += "<h6 class='card-subtitle mb-2 text-muted'>"+obj.descricao+"</h6>";
	//noticiaGeral += "<p class='card-text'>"+obj.noticias+"</p>";
	noticiaGeral += "<a href='cadaNoticia/noticiaGeral.php?geral="+obj.id+"' class='ard-link'>Ler mais</a>";
	noticiaGeral += "</div></div><br/>";

	return noticiaGeral;
}

function ConstruirStringNoticiaDep(obj){
	
	let noticiaDep = '<a href="#"  class="list-group-item list-group-item-action flex-column align-items-start">';
	noticiaDep += '<div class="d-flex w-100 justify-content-between">';
	noticiaDep += "<h5 class='mb-1'>"+obj.titulo+"</h5>";
	noticiaDep += "<small>"+obj.descricao+"</small>";
	noticiaDep += "</div>";
	//noticiaDep += "<p class='mb-1'>"+obj.texto+"</p>";
	noticiaDep += "</a>";
	

	return noticiaDep;
}