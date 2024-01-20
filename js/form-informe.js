// Funcion Select2 - Convierte a un Select normal a un Select con busqueda integrada y todo

$(document).ready(
  function() {
    $('#paciente_id').select2(
      {
        tags: false,
        placeholder: "Busque paciente por nombre o cédula de identidad",
        allowClear: false,
      }
    );
  }
);

$(document).ready(
  function() {
    $('#medico').select2(
      {
        tags: false,
        placeholder: "Busque medico por nombre",
        allowClear: true
      }
    );
  }
);

// Funcion para el registro de Medico

let seleccion_informe = $("input[name='tipo_informe']");

seleccion_informe.change(function(){

    let informe = $("input[name='tipo_informe']:checked").val();

    if (informe == "citologia") {
        $("#informe_biopsia").css("display","none");
        $("#informe_biopsia *").prop("required", false);
       
        $("form").attr("action", "php/insert-informe-citologia.php");        
        $("#informe_citologia").css("display","block");
        $("#informe_citologia *").prop("required", true);
    }
    else if (informe == "biopsia") {
        $("#informe_citologia").css("display","none");
        $("#informe_citologia *").prop("required", false);  

        $("form").prop("action", "php/insert-informe-biopsia.php");
        $("#informe_biopsia").css("display","block");
        $("#informe_biopsia *").prop("required", true);
    }
});