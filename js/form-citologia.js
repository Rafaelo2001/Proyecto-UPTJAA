// Funcion para activar 'otros' en Frotis

    let checkOtro = $("#otro_check");

    checkOtro.change(function(){
                
        if (checkOtro.prop("checked") == true){
            $("#otro").prop("disabled", false);
        }
        else {
            $("#otro").prop("disabled", true);
        }
    });

// Funcion Select2
$(document).ready(
    function() {
      $('#paciente').select2(
        {
          placeholder: "Busque paciente por nombre o cédula de identidad",
          allowClear: true,
          width: "auto"
        }
      );
    }
  );

$(document).ready(
    function() {
        $('#medico').select2(
            {
                tags: false,
                placeholder: "Seleccione Medico",
                allowClear: true,
                width: "auto"
            }
        );
    }
);