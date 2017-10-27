$(document).ready(function(){

	$('#div_dep').hide();

	

	$('#select_tipo').on('change', function(){
		if(this.value ==  'dep'){
			$('#div_dep').show('slow');			
		}else{
			$('#div_dep').hide('slow');			
		}

	});

	$('#btn_enviar').click(function(){
		let titulo    = $('#titulo').val();
		let descricao = $('#descricao').val();
		let tipo      = $('#select_tipo').val();
		let dep 	  = $('#select_dep').val();
		let texto 	  = tinymce.get('mytextarea').getContent();

		let data = new FormData();
		data.append('titulo', titulo);
		data.append('descricao', descricao);
		data.append('tipo', tipo);
		data.append('dep', dep);
		data.append('texto', texto);

		if(tipo == 'dep'){
			if(validacaoNews(data)){
				cadastrarNoticiaDep(data);
			}else{ alert('Por favor, complete todo o formulário.'); }
		}else{
			if(validacaoNews(data)){
				cadastrarNoticiaGeral(data);
			}else{ alert('Por favor, complete todo o formulário.') }
		}

	});


});


function validacaoNews(newsForm){
	
	if(newsForm.get('titulo').trim() != ''){
		if(newsForm.get('descricao').trim() != '' )	{
			if(newsForm.get('tipo').trim() != '' ){
				if(newsForm.get('texto').trim() != '' ){
					return true;
				}else{ return false; }
			}else{ return false; }
		}else{ return false; }
	}else{ return false; }

}

function cadastrarNoticiaGeral(newsForm){
	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: newsForm,
		url: '../../controllers/recadosController.php/cadGeral',
		dataType: 'json',
		success: function(data){
			console.log(data.status);
		}
	});
}

function cadastrarNoticiaDep(newsForm){
	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: newsForm,
		url: '../../controllers/recadosController.php/cadDep',
		dataType: 'json',
		success: function(data){
			console.log(data.status);
			if(data.status == 'true'){
				alert('deu certo');
			}
		}
	});
}