// Funcion para activar 'otros' en Frotis

    let checkOtro = $("#otro");

    checkOtro.change(function(){
                
        if (checkOtro.prop("checked") == true){
            $("#otro_input").prop("disabled", false);
        }
        else {
            $("#otro_input").prop("disabled", true);
        }
    });