// Funciones para la seccion de Estado, Ciudad, Municipio y Parroquia

    $("#estados").change(function(){    	
        $.ajax({
            data:  "id_estado="+$("#estados").val(),
            url:   'php/ajax_ciudades.php',
            type:  'post',
            dataType: 'json',
            beforeSend: function () {  },
            success:  function (response) {            
                var html = "";
                $.each(response, function( index, value ) {
                    html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                });  
                $("#ciudades").html(html);
            },
            error:function(){
                alert("error")
            }
        });
    })

    $("#estados").change(function(){    	
        $.ajax({
            data:  "id_estado="+$("#estados").val(),
            url:   'php/ajax_municipios.php',
            type:  'post',
            dataType: 'json',
            beforeSend: function () {  },
            success:  function (response) {            
                var html = "";
                $.each(response, function( index, value ) {
                    html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                });  
                $("#municipios").html(html);
            },
            error:function(){
                alert("error")
            }
        });
    })

    $("#municipios").change(function(){    	
        $.ajax({
            data:  "id_municipio="+$("#municipios").val(),
            url:   'php/ajax_parroquias.php',
            type:  'post',
            dataType: 'json',
            beforeSend: function () {  },
            success:  function (response) {            
                var html = "";
                $.each(response, function( index, value ) {
                    html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
                });  
                $("#parroquias").html(html);
            },
            error:function(){
                alert("error")
            }
        });
    })


// Funcion para el registro de Medico

    let checkMedic = $("#registro_medico");

    checkMedic.change(function(){
                
        if (checkMedic.prop("checked") == true){
            $("#medico_en_bdd").css("display","none");
            $("#medicos-bdd").prop("required", false);

            $("#medico_nuevo").css("display","block");
            $("#nombre-medico-registro").prop("required", true);
            $("#telefono-medico-registro").prop("required", true);
        }
        else {
            $("#medico_nuevo").css("display","none");
            $("#nombre-medico-registro").prop("required", false);
            $("#telefono-medico-registro").prop("required", false);

            $("#medico_en_bdd").css("display","block");
            $("#medicos-bdd").prop("required", true);
        }
    });