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