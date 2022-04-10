


$(function(){
    listar(); 
    setInterval(function(){
        listar(); 
    },1000)
});

function listar(){
    __ajax()
    .done(function(info){
        //console.log(info);
        var talleres_cupos = JSON.parse(info);
        var html = "";
        //console.log(talleres_cupos);

        for(var i in talleres_cupos.data){
            html+=
 
                "<tr>"+
                    "<td>"+talleres_cupos.data[i].nombre_taller+"</td>"+
                    "<td>"+talleres_cupos.data[i].cupos+"</td>"+
                    "<td class='text-center'>"+"<a style='color:white' id='btn_inscribir' data-toggle='modal' class='btn "+talleres_cupos.data[i].boton+" ' data-target='#miModal"+talleres_cupos.data[i].id_t_c+"'>"+talleres_cupos.data[i].boton_mensaje+"</a> "+"</td>"
                +"</tr>"

        }

        $("#data_cupos").html(html);
    });
}

function __ajax(){
    var cursoID = $("#id_curso").val();
              
        if(cursoID){
            var ajax = $.ajax({
                url:"http://localhost/acle/js/fetch.php",
                method:"GET",
                data: 'curso_id='+cursoID                
            })
        }

        return ajax;
}