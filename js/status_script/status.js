var etapa = 2;

$(document).ready(function(){

    var count1 = 0;
    var count2 = 0;
    

    $('#ad_orcamento').click(function(){

        count1++;
        var data = fragmentHTML_container(count1);
        $('#panel_orc').append(data); 
       // $('#modalAddEvento').modal('hide');
    });
        
});

        

function addPassos(num){

    //alert('funcionou!');
    etapa++;

     setTimeout(function(){
        var data = fragmentHTML_panel(etapa);       
        $("#etapa_td"+num).before(data);
        //alert($('#modalAddPassos').modal('hide'));
     }, 2000);
        
}

function removerFLuxo(num){
    $("#container_fluxo"+num).remove();
}


function fragmentHTML_panel(num){

    var script = "<td style='padding: 30px;'>";
        script += " <span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span>";
        script += "</td><td>";
        script += "<div class='panel panel-success'>";
        script += "<div class='panel-heading'> Orçamento com pessoal de engenharia</div>";
        script += "<div class='panel-body'>";
        script += "<label>Nome: </label>";
        script += "<p>Ciclano da Silva.</p>";
        script += "<label>Adicionar info</label>";
        script += "<button class='btn btn-default' data-toggle='modal' data-target='#modalAddInfo'>Adicionar suas informações</button>";        
        script += "</div></div></td>";

    return script;
}

function fragmentHTML_container(num){
    
    var fragment = "<div class='col-md-12 linha_prin' style='overflow-x: auto;' id='container_fluxo"+num+"' >";
        fragment += "<button class='btn btn-danger' id='remove_flux' onclick='removerFLuxo("+num+")' >X</button>"
        fragment += "<table style='margin-top: 60px;' ><tr><td>";
        fragment += "<div class='panel panel-success'>";
        fragment += "<div class='panel-heading'>Etapa 1 - pedido de Orçamento</div>";
        fragment += "<div class='panel-body'>";
        fragment += "<label>Nome do Cliente:</label><p>Fulano Silva Santos</p>";
        fragment += "<label>1º Contato: </label><p>Deotrano Afonso</p>";
        fragment += "<button class='btn btn-default' data-toggle='modal' data-target='#modalContatoInfo'> Informações </button>";
        fragment += "</div></div></td> ";

        fragment += "<td style='padding: 30px;' id='etapa_td"+num+"'>";
        //fragment += "<button class='btn btn-success' id='add_etapa' onclick='addPassos("+num+")' ></button>";
        fragment += "<button class='btn btn-success' id='add_etapa' data-toggle='modal' data-target='#modalAddPassos' onclick='addPassos("+num+")' ></button>";       
        fragment += "</td></tr></table></div>";

        return fragment;

}