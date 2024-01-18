$(document).ready(
    function() {
        $('#informes').select2(
            {
            tags: false,
            placeholder: "-- Seleccione el informe del paciente --",
            allowClear: false,
            width: 'auto'
            }
        );
    }
);

// Seleccion de id informe
let informe = $("#informes");

informe.change(function(){
    $.ajax({
        data:   "ID_Informe="+informe.val(),
        url:    "php/ajax_visualizar_informe.php",
        type:   "post",
        dataType:   "json",
        beforeSend: function(){},
        success:    function(response) {
            if(response[0]["error"]){
                alert("Error: "+response[0]["error_msj"]);
            }
            else{
                $.each(response, function( index, value ) {
                    $("#descripcion").val(value.des_macro);
                    $("#fecha").val(value.fecha);
                    $("#des_mr").val(value.des_mr);
                });
                
                
            }
        },
        error:      function(){
            alert("Error en AJAX");
        }
    });
});

// $("#paciente_id").change(function(){    	
//     $.ajax({
//         data:  "CI_Paciente="+$("#paciente_id").val(),
//         url:   'php/ajax_biopsia.php',
//         type:  'post',
//         dataType: 'json',
//         beforeSend: function () {  },
//         success:  function (response) {
//             var html = "";
//             $.each(response, function( index, value ) {
//                 html+= '<option value="'+value.id+'">'+value.diagnostico + value.fecha + "</option>";
//             });  
//             $("#examen_id_b").html(html);
//         },
//         error:function(){
//             alert("error" + $("#paciente_id").val())
//         }
//     });
// })