$(document).ready(function(){

	//	verificaLogin();

	$('#div_dep').hide();

	

	$('#select_tipo').on('change', function(){
		if(this.value ==  'dep'){
			$('#div_dep').show('slow');			
		}else{
			$('#div_dep').hide('slow');			
		}

	});

	$('#btn_enviar').click(function(){
		let titulo    	   = $('#titulo').val();
		let descricao 	   = $('#descricao').val();
		let tipo      	   = $('#select_tipo').val();
		let dep 	  	   = $('#select_dep').val();
		let texto 	  	   = tinymce.get('mytextarea').getContent();
		let nome_user 	   = $('#nome_user').val();
		let sobrenome_user = $('#sobrenome_user').val();
		let email_user	   = $('#email_user').val();

		let data = new FormData();
		data.append('titulo', titulo);
		data.append('descricao', descricao);
		data.append('tipo', tipo);
		data.append('dep', dep);
		data.append('texto', texto);
		data.append('nome', nome_user);
		data.append('sobrenome', sobrenome_user);
		data.append('email', email_user);
		//data.append('id_user', id_user);

		if(tipo == 'dep'){
			if(validacaoNews(data)){
				if(validacaoCampos(data)){
					cadastrarNoticiaDep(data);
				}				
			}else{ alert('Por favor, complete todo o formulário.'); }
		}else{
			if(validacaoNews(data)){
				if(validacaoCampos(data)){
					cadastrarNoticiaGeral(data);
				}				
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

function validacaoCampos(newsForm){
	if(newsForm.get('titulo').length < 140 ){
		return true;
	}else{ alert('O campo Título só aceita 150 caracteres'); return false; }
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
				limparCampos();
				$('#modal_msg_cad').modal('show');
			}
		},
		complete: function(){
			$('#btn_enviar').removeAttr('disabled');
			//location.reload();
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
				limparCampos();
				$('#modal_msg_cad').modal('show');
			}
		},
		complete: function(){
			$('#btn_enviar').removeAttr('disabled');
			//location.reload();
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
                    $('#nome_user').val(data.nome);
                    $('#sobrenome_user').val(data.sobrenome);
                    $('#email_user').val(data.email);
                    
                    //alert(data.id);
                    //alert(data.nome);
                    //alert(data.sobrenome);
                    verificaPermissionCadNews(data.id);
                    
                    
                    removeNavOptions(data.nome, data.sobrenome);
                }else{
                    window.location.href = '../../../index.html';
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


// ================================== limpa campos ======================================

function limparCampos(){
	$('#titulo').val('');
	$('#descricao').val('');
	tinymce.get('mytextarea').setContent('');
}