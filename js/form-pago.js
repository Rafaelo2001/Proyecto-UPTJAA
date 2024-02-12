$(document).ready(
    function() {
        $('#paciente').select2(
            {
                placeholder: "Busque paciente por nombre o cédula de identidad",
                allowClear: false,
                width: "auto"
            }
        );
    }
);