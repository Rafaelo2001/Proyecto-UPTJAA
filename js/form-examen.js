$(document).ready(
    function() {
        $('#paciente').select2(
            {
                placeholder: "Busque paciente por nombre o cédula de identidad",
                allowClear: false,
                width: "auto"
            }
        );
    },

    function() {
        $('#m_remitido_b').select2(
            {
                placeholder: "Busque material remitido de biopsia",
                allowClear: true,
                width: "auto"
            }
        );
    },

    function() {
        $('#m_remitido_c').select2(
            {
                placeholder: "Busque material remitido de citologia",
                allowClear: true,
                width: "auto"
            }
        );
    },
);

$("#paciente").change(function(){    	
    $.ajax({
        data:  "CI_Paciente="+$("#paciente").val(),
        url:   'php/ajax_examen.php',
        type:  'post',
        dataType: 'json',
        beforeSend: function () {  },
        success:  function (response) {
            var html_b = "";
            var html_c = "";
            $.each(response, function( index, value ) {
                console.log(value.m);
                if(value.tipo=="b")
                {   html_b+= '<option value="'+value.id+'">'+value.descripcion + value.fecha + "</option>"; }
                else if(value.tipo=="c")
                {   html_c+= '<option value="'+value.id+'">'+value.descripcion + value.fecha + "</option>"; }
                else{
                    html_b+= '<option value="">'+value.descripcion+ "</option>"; 
                    html_c+= '<option value="">'+value.descripcion+ "</option>"; 
                }
            });
            if(html_b == "") {
                html_b = '<option value="">Sin Material de Biopsia sin Examinar</option>';
            }
            if(html_c == "") {
                html_c = '<option value="">Sin Material citologico sin Examinar</option>';
            }
            $("#m_remitido_b").html(html_b);
            $("#m_remitido_c").html(html_c);
        },
        error:function(){
            alert("error" + $("#paciente").val())
        }
    });
});

$("[name='tipo_examen']").change(
    function() {
        let tipo_examen = $("input[name='tipo_examen']:checked").val();
        $("#texto").css("display","none");
        
        if(tipo_examen == "biopsia"){
            $("#citologia").css("display","none");
            $("#citologia *").prop("required", false);  
            $("#citologia *").prop("disabled", true);

            $("#biopsia").css("display","block");
            $("#biopsia *").prop("required", true);
            $("#biopsia *").prop("disabled", false);
        }
        else if (tipo_examen == "citologia"){
            $("#biopsia").css("display","none");
            $("#biopsia *").prop("required", false);
            $("#biopsia *").prop("disabled", true);
        
            $("#citologia").css("display","block");
            $("#citologia *").prop("required", true);
            $("#citologia *").prop("disabled", false);
        }
    }
);
