// Funcion para el registro de Medico

let seleccion_informe = $("input[name='tipo_informe']");

seleccion_informe.change(function(){

    let informe = $("input[name='tipo_informe']:checked").val();

    if (informe == "citologia") {
        $("#informe_biopsia").css("display","none");
        //$("#medicos-bdd").prop("required", false);

        $("#informe_citologia").css("display","block");
        //$("#nombre-medico-registro").prop("required", true);
        //$("#telefono-medico-registro").prop("required", true);
    }
    else if (informe == "biopsia") {
        $("#informe_citologia").css("display","none");
        //$("#nombre-medico-registro").prop("required", false);
        //$("#telefono-medico-registro").prop("required", false);

        $("#informe_biopsia").css("display","block");
        //$("#medicos-bdd").prop("required", true);
    }
});