function fecharFluxo(id_step){

	//alert("Fechar Fluxo id : "+id_step);
	var data_pass_id = new FormData();
	data_pass_id.append('step_orc_id',id_step);

	$.ajax({
		type: "POST",
		processData: false,
		contentType: false,
		data: data_pass_id,
		url: "sys_fluxo/controller.php/fluxo/fecharFluxo",
		dataType: 'text',
		success: function(data){
			//alert(data);
			if(data == 'true'){
				location.reload();
			}
		}
	});


}