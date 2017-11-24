$(document).ready(function(){

	$('#salvar_duplicada').click(function(){
		let expRegData = /^(((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|10|12)[\.\-\/](19[7-9]\d|2[0-2][0-9]\d))|((0?[1-9]|[12]\d|30)[\.\-\/] (0?[469]|11)[\.\-\/](19[7-9]\d|2[0-2][0-9]\d))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/](19[7-9]\d|2[0-2][0-9]\d))|(29[\.\-\/]0?2[\.\-\/]((19[7-9]\d|2[0-2][0-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))$/;
		let valorData  = $('#dataDuplicar').val();
		let id_cale   = $('#duplicarIdCale').val();

		//console.log('data: '+valorData);
		//console.log('id_cale: '+id_cale);


		if(valorData.match(expRegData) || valorData.trim() !=''){

			let FormDupli  = new FormData();
			FormDupli.append("id_cale", id_cale);
			FormDupli.append("data", valorData);

			$.ajax({
				type: 'post',
				processData: false,
				contentType: false,
				data: FormDupli,
				url: 'sys_agenda/controller.php?agenda=duplicarEvento',
				dataType: 'json',
				success: function(data){
					if(data.status){
						console.log('Deu certo');
						location.reload();
					}else{
						console.log('Deu algum erro');
					}
				}
			});

		}else{
			alert("Formato da data está errada");
		} 


	});

});