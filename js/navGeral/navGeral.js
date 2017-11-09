
        $(document).ready(function(){       
            
            verificaLogin();        
            $('#pn_caleda').click(function(){
                window.location.href = 'agenda.html';
            });

            $('#pn_notacao').click(function(){
                window.location.href = 'status.php';
            });

            $('#pn_Lista').click(function(){
                window.location.href = 'lista_solicitacao.html';
            });

        });

        function verificaLogin(){
                $.ajax({
                    type: "POST",
                    url: "../../../login/controller.php?login=sessionUsuario",
                    async: false,
                    dataType: "json",
                    success: function(data){

                        if(data != null && data != false){
                            
                            //$('#dropdown_login').children().remove();

                            $('#id_user').val(data.id);
                            $('#dep_user').val(data.dep);
                            $('#nome_user').val(data.nome);
                            $('#email_user').val(data.email);                            
                            
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

                
        function mudarNavBar(){
            var paginaName = window.location.pathname;
            var loginBarra = "<li><a href='#' ><span class='glyphicon glyphicon-user' aria-hidden='true'></span>    Minha Conta</a></li>";
            loginBarra += "<li><a href='login/controller.php?login=deslogar&pageName="+paginaName+"'><span class='glyphicon glyphicon-off' aria-hidden='true'></span>    Logout</a></li>";
            
            return loginBarra;
        }

        function removeNavOptions(nome, sobrenome){
            $('#nav_name_ident').children().remove();
            $('#nav_name_ident').append("Bem vindo "+nome+" "+sobrenome+" ");
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
            if(data.status != 'true'){
                window.location.href = '../../../painel_controle.html';
            }
        }
    });
}