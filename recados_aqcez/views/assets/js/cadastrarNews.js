$(document).ready(function(){

	//verificaLogin();

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
		beforeSend: function(){
			$('#btn_enviar').attr('disabled','disabled');
		},
		success: function(data){
			console.log(data.status);
			if(data.status){
				alert('deu certo');
			}
		},
		complete: function(){
			location.reload();
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
		beforeSend: function(){
			$('#btn_enviar').attr('disabled','disabled');
		},
		success: function(data){			
			if(data.status == 'true'){
				alert('deu certo');
			}
		},
		complete: function(){
			location.reload();
		}
	});
}

// =========================== ferifica Login =============================

 function verificaLogin(){
        $.ajax({
            type: "POST",
            url: "../../../login/controller.php?login=sessionUsuario",
            dataType: "json",
            success: function(data){

                if(data != null && data != false){
                    
                    //$('#dropdown_login').children().remove();

                    $('#id_user').val(data.id);
                    
                    //alert(data.id);
                    //alert(data.nome);
                    //alert(data.sobrenome);
                    verificaPermissionCadNews(data.id);
                    
                    
                    removeNavOptions(data.nome, data.sobrenome);
                }else{
                    window.location.href = 'index.html';
                }

            }
        }).fail(function(data){
            window.location.href = 'index.html';
        });
    }

    function verificaPermissionCadNews($id){
    
    let id_data = new FormData();
    id_data.append('id', $id);
    $.ajax({
        type: 'post',
        url: '../../../login/controller.php?login=veriPermissionNews',
        processData: false,
        contentType: false,
        data: id_data,
        dataType: 'json',
        success: function(data){
            if(data.status == 'true'){
                $('.dropMenuCad').show();
            }
        }
    });
}