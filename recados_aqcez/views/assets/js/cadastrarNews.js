$(document).ready(function(){

	//	verificaLogin();
	var countFiles = 0;

	$('#div_dep').hide();
	$('#erro_file_extension').hide();

	

	$('#select_tipo').on('change', function(){
		if(this.value ==  'dep'){
			$('#div_dep').show('slow');			
		}else{
			$('#div_dep').hide('slow');			
		}

	});

	$('#btn_add_file').click(()=>{
		countFiles++;
		let fileUpload     = "<br/><input type='file' onchange='carregarBarra("+countFiles+")' id='file_upload"+countFiles+"' name='file[]' multiple><br/>";
		let progressBar    = "<div class='progress'><div class='progress-bar progress-bar-striped active' id='progress"+countFiles+"' role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 0%'><span class='sr-only'>45% Complete</span></div></div>";
		let botao_cancelar = "<button type='button' class='btn btn-danger' onclick='cacelarBarra("+countFiles+")' ><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>Cancelar</button><br/><br/>";
		
		
		$('#div_add_file').prepend(botao_cancelar);
		$('#div_add_file').prepend(progressBar);		
		$('#div_add_file').prepend(fileUpload);
		if(countFiles > 1){
			let numid = countFiles -1;
			$("#file_upload"+numid).before("<div class='separador' ></div>");
		}
		
	});

	$("input[name='file[]']").on('change', function(){
		console.log('entrou');
		alert($(this).val());
	});


	$('#cad_noticias').on('submit',(e)=>{
		e.preventDefault();


		let titulo    	   = $('#titulo').val();
		let descricao 	   = $('#descricao').val();
		let tipo      	   = $('#select_tipo').val();
		let dep 	  	   = $('#select_dep').val();
		let texto 	  	   = tinymce.get('mytextarea').getContent();
		let nome_user 	   = $('#nome_user').val();
		let sobrenome_user = $('#sobrenome_user').val();
		let email_user	   = $('#email_user').val();
		let file_upload    = $("input[name='file[]']").val();
		let file_upload02  = $("input[name='file[]']").prop('files');
		//let file_upload03  = $("#file_upload").prop('files')[0];


		//console.log(file_upload02);

		//console.log(file_upload02.length);		
		
		let data = new FormData();
		data.append('titulo', titulo);
		data.append('descricao', descricao);
		data.append('tipo', tipo);
		data.append('dep', dep);
		data.append('texto', texto);
		data.append('nome', nome_user);
		data.append('sobrenome', sobrenome_user);
		data.append('email', email_user);

		if(file_upload02 !== undefined){
			$.each(file_upload02, (i, file)=>{
				console.log(file);
				data.append('file01[]', file);
			});
		}		
		//data.append('file02', file_upload03);
		//data.append('id_user', id_user);

		
		if(file_upload !== undefined ){
			if(file_upload.trim() != ''){
				let validation = fileValidation(file_upload02);	
				if(validation){
					ExecutandoScript(data);
				}
			}			
		}else{
			ExecutandoScript(data);
		}

	});


	/*$('#btn_enviar').click(function(){


		let titulo    	   = $('#titulo').val();
		let descricao 	   = $('#descricao').val();
		let tipo      	   = $('#select_tipo').val();
		let dep 	  	   = $('#select_dep').val();
		let texto 	  	   = tinymce.get('mytextarea').getContent();
		let nome_user 	   = $('#nome_user').val();
		let sobrenome_user = $('#sobrenome_user').val();
		let email_user	   = $('#email_user').val();
		let file_upload    = $("input[name='file[]']").val();
		let file_upload02  = $("#file_upload").prop('files');	

		console.log(file_upload02);

		console.log(file_upload02.length);		
		
		let data = new FormData();
		data.append('titulo', titulo);
		data.append('descricao', descricao);
		data.append('tipo', tipo);
		data.append('dep', dep);
		data.append('texto', texto);
		data.append('nome', nome_user);
		data.append('sobrenome', sobrenome_user);
		data.append('email', email_user);
		data.append('file', file_upload02);
		//data.append('id_user', id_user);

		
		if(file_upload.trim() != ''){
			let validation = fileValidation(file_upload02);	
			if(validation){
				ExecutandoScript(data);
			}
		}else{
			ExecutandoScript(data);
		}

		

	});*/


});

function ExecutandoScript(data){
	if(data.get('tipo') == 'dep'){
		if(validacaoNews(data)){
			if(validacaoCampos(data)){
				cadastrarNoticiaDep(data);
			}				
		}else{ alert('Por favor, complete todo o formulário.'); }
	} else if(data.get('tipo') == 'gerente') {
		if(validacaoNews(data)) {
			if(validacaoCampos(data)) {
				cadastrarNodiciaGerente(data);
			}
		}else { alert('Por favor, complete todo o formulário'); }
	}else{
		if(validacaoNews(data)){
			if(validacaoCampos(data)){
				cadastrarNoticiaGeral(data);
			}				
		}else{ alert('Por favor, complete todo o formulário.') }
	}
}


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
			$.blockUI({ 
				message: '<h2>Um momento, estamos processando seus dados...</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
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
			$.unblockUI();
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
			$.blockUI({ 
				message: '<h2>Um momento, estamos processando seus dados...</h2>',
				css: { 
	            border: 'none', 
	            padding: '15px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .5, 
	            color: '#fff' 
	        } });
		},
		success: function(data){			
			if(data.status == 'true'){
				limparCampos();
				$('#modal_msg_cad').modal('show');
			}
		},
		complete: function(){
			$('#btn_enviar').removeAttr('disabled');
			$.unblockUI();
			//location.reload();
		}
	});
}

function cadastrarNodiciaGerente(newsForm) {
	$.ajax({
		type: 'post',
		processData: false,
		contentType: false,
		data: newsForm,
		url: '../../controllers/recadosController.php/cadRecadoGerentes',
		dataType: 'json',
		beforeSend: function() {
			$.blockUI({
				message: '<h2>Um momento, estamos processando seus dados...</h2>',
				css: {
					border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#000', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff' 
				}
			});
		},
		success: function(data) {
			if(data.status == 'true') {
				limparCampos();
				$('#modal_msg_cad').modal('show');
			}
		},
		complete: function() {
			$('#btn_enviar').removeAttr('disabled');
			$.unblockUI();
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
	$('#div_add_file').children().remove();
}


// ================================ validação de arquivo =================================

function fileValidation(file){
	let ext_permitida = ['gif','jpg','jpeg','png','pdf','rar','zip','doc','docx','pps','ppsx', 'ppt','xls','xml','xlsx'];
	for(var i = 0; i < file.length; i++){
		var extensao = file[i].name.split('.').pop().toLowerCase();
		if($.inArray(extensao, ext_permitida) == -1){
			$("input[name='file[]']").val('');
			$('#erro_file_extension').show();
			return false;
		}else{
			return true;
		}
	}
}





// ================================= barra de progresso ======================================

function carregarBarra(num){
	let val = 0;
	console.log('Entrou barra');
	let intervalo = setInterval(()=>{
		val = val +1;
		
		$("#progress"+num).css("width", val+"%");
		if(val == 100){
			clearInterval(intervalo);
		}

	}, 50);
}


// =============================== Cancelar Barra e arquivo =================================

function cacelarBarra(num){
	let val = 0;
	console.log('entrou Cancelar');
	$("#file_upload"+num).val('');
	$("#progress"+num).css("width","0%");
}