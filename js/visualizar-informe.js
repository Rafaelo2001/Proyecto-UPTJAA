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
                    if(value.tipo == "biopsia")
                    {
                        $("#seccion_biopsia").css("display","block");
                        $("#seccion_biopsia > *").prop("required", true);
                        $("#seccion_biopsia > *").prop("disabled", false);
                        $("#seccion_citologia").css("display","none");
                        $("#seccion_citologia > *").prop("required", false);
                        $("#seccion_citologia > *").prop("disabled", true);
                        $("form").prop("action","pdf/informe_biopsia.php")

                        $("#seccion_biopsia > #tipo").val(value.tipo);

                        $("#seccion_biopsia > #id_inf").val(value.id_inf);
                        $("#seccion_biopsia > #des_mr").val(value.des_mr);
                        $("#seccion_biopsia > #diag").val(value.diag);
                        $("#seccion_biopsia > #obs").val(value.obs);
                        $("#seccion_biopsia > #cip").val(value.cip);
                        $("#seccion_biopsia > #medico").val(value.medico);

                        $("#seccion_biopsia > #id_b").val(value.id_b);                       
                        $("#seccion_biopsia > #des_macro").val(value.des_macro);
                        $("#seccion_biopsia > #des_micro").val(value.des_micro);

                        $("#seccion_biopsia > #fecha").val(value.fecha);
                    }
                    else if(value.tipo == "citologia")
                    {
                        $("#seccion_citologia").css("display","block");
                        $("#seccion_citologia > *").prop("required", true);
                        $("#seccion_citologia > *").prop("disabled", false);
                        $("#seccion_biopsia").css("display","none");
                        $("#seccion_biopsia > *").prop("required", false);
                        $("#seccion_biopsia > *").prop("disabled", true);
                        $("form").prop("action","pdf/informe_citologia.php")

                        $("#seccion_citologia > #tipo").val(value.tipo);

                        $("#seccion_citologia > #id_inf").val(value.id_inf);
                        $("#seccion_citologia > #des_mr").val(value.des_mr);
                        $("#seccion_citologia > #diag").val(value.diag);
                        $("#seccion_citologia > #obs").val(value.obs);
                        $("#seccion_citologia > #cip").val(value.cip);
                        $("#seccion_citologia > #medico").val(value.medico);

                        $("#seccion_citologia > #id_c").val(value.id_c);
                        $("#seccion_citologia > #calidad").val(value.calidad);
                        $("#seccion_citologia > #ctg_gnrl").val(value.ctg_gnrl);
                        $("#seccion_citologia > #hallazgos").val(value.hallazgos);
                        $("#seccion_citologia > #conducta").val(value.conducta);

                        $("#seccion_citologia > #fecha").val(value.fecha);                        
                    }
                });
            }
        },
        error:      function(){
            alert("Error en AJAX");
        },
    });
});

// $("#medico_en_bdd").css("display","none");
//             $("#medicos-bdd").prop("required", false);

//             $("#medico_nuevo").css("display","block");
//             $("#nombre-medico-registro").prop("required", true);
//             $("#telefono-medico-registro").prop("required", true);
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