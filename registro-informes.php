<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Modulo de generacion de Informes</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>
    <body style="text-align: center;">
        
            <h1>Registro de Informes</h1>
            
            <input class="tipo_informe" id="citologia" name="tipo_informe" value="citologia" type="radio"> 
                    <label for="citologia">Citologia</label>
                        
                    -----
                    
            <label for="biopsia">Biopsia</label>        
                <input class="tipo_informe" id="biopsia" name="tipo_informe" value="biopsia" type="radio">

                <br><br><br>

            <form action="" method="post" autocomplete="off">

                <label for="paciente_id">Paciente:</label>
                <select id="paciente_id" name="paciente_id" required>
                    <option></option>

                    <?php $listaPacientes = $user->buscar("paciente","1"); ?>

                    <?php foreach($listaPacientes as $cedula_paciente): ?>

                        <option value="<?php echo $cedula_paciente['CIP'] ?>">
                            <?php
                                $cedula = $cedula_paciente['CIP'];
                                $ci_sql = "CI = '$cedula';";
                                
                                $pacientes = $user->buscar("persona", $ci_sql); 
                                foreach($pacientes as $paciente): 
                                    
                                    $nombre_completo = $paciente['PN'] ." ". $paciente['SN'] ." ". $paciente['TN'] ." ". $paciente['PA'] ." ". $paciente['SA']; 
                                    
                                    $cedula_formateada = number_format($cedula, 0, ',', '.');
                                    $cedula_a_mostrar = " - C.I.: $cedula_formateada";
                                    
                                    echo $nombre_completo, $cedula_a_mostrar;

                                endforeach; 
                            ?>
                        </option>

                    <?php endforeach; ?>
                </select>

                    <br><br>

                <label for="medico">Medico:</label>
                <select id="medico" name="medico_id" style="width: 506px;" required>
                    <option></option>
                    <option>Miguel Blanco</option>

                    <?php $listaMedicos = $user->buscar("medico","1"); ?>
                    <?php foreach($listaMedicos as $medico): ?>

                        <option value=" <?php echo $medico['ID_Medico'] ?> "> <?php echo $medico['Nombre_Medico'] ?> </option>

                    <?php endforeach; ?>
                </select>
            


                    <br><br><br>           
                    <hr>



                

                <!--Recordar colocar en el php, determinar cual info enviar de acuerdo al Radio-->
                <!--AGREGAR UNA SELECCION DE EXAMENES DE ACUERDO AL ID DEL PACIENTE, esto puede ser ya dentro del area de biopsia/citologia-->
                
                <section id="informe_biopsia" style="display:none">
                    <h1>Informe Biopsia</h1>

                    <label for="examen_id_b">Examenes del Paciente:</label>
                    <select id="examen_id_b" name="examen_id_b" required>
                    </select>

                    <h2>Informacion material remitido</h2>
                    <textarea name="info_b" id="info_b" cols="100" rows="5"></textarea>

                    <br><br>

                    <h2>Descripción Micro</h2>
                    <textarea name="des_micro_b" id="des_micro_b" cols="30" rows="10"></textarea>
                    
                    
                        <br><br>
                    
                
                    <h2>Descripción Macro</h2>
                    <textarea name="des_macro_b" id="des_macro_b" cols="30" rows="10"></textarea>
                    
                    
                        <br><br>

                    
                    Diagnosticos <br><br>
                            <textarea name="diag_b" id="diag_b" cols="30" rows="10"></textarea>     
                                <br><br>
                                
                    Obsevaciones/Comentarios <br> <br>
                                <textarea name="obs_b" id="obs_b" cols="30" rows="10"></textarea>
                                <br>

                <script>
                    $("#paciente_id").change(function(){    	
                    $.ajax({
                        data:  "CI_Paciente="+$("#paciente_id").val(),
                        url:   'php/ajax_biopsia.php',
                        type:  'post',
                        dataType: 'json',
                        beforeSend: function () {  },
                        success:  function (response) {
                            var html = "";
                            $.each(response, function( index, value ) {
                                html+= '<option value="'+value.id+'">'+value.diagnostico+"</option>";
                            });  
                            $("#examen_id_b").html(html);
                        },
                        error:function(){
                            alert("error" + $("#paciente_id").val())
                        }
                    });
                })
                </script>
                </section>

                <section id="informe_citologia" style="display:none">
                    <h1> Informe Citologia</h1>

                    <label for="examen_id_c">Examenes del Paciente:</label>
                    <select id="examen_id_c" name="examen_id_c" required>
                        <option value="" selected disabled>Agregar php</option>
                    </select>

                    <h2>Informacion material remitido</h2>
                    <textarea name="info_c" id="info_c" cols="100" rows="5"></textarea>

                    <br><br>

                    <h2>Calidad de muestras</h2> <br> 
                        <textarea name="calidad_c" id="calidad_c" cols="30" rows="10"></textarea>

                    <h2>Categoría general</h2>
                        <textarea name="categ_c" id="categ_c" cols="30" rows="10"></textarea>
                    
                        <br> <br>
                    
                    Hallazgos
                        <button>+</button> 
                            <br> <br>
                            <!--
                        <form> <input type="text"> <br>
                            <input type="text"> <br>
                            <input type="text"> <br>
                            <input type="text"> <br>
                        </form>
-->


                        <br> <br>

                    Diagnosticos
                        <button>+</button>
                            <br> <br> 
                        <textarea name="diag_c" id="diag_c" cols="30" rows="10"></textarea>     
                            
                        
                        <br><br>

                        
                    Conducta
                        <br><br>
                    <textarea name="conducta_c" id="conducta_c" cols="30" rows="10"></textarea>
                    

                        <br><br>


                    Obsevaciones/Comentarios
                        <br><br>
                    <textarea name="obs_c" id="obs_c" cols="30" rows="10"></textarea>

                    <script>
                    $("#paciente_id").change(function(){    	
                    $.ajax({
                        data:  "CI_Paciente="+$("#paciente_id").val(),
                        url:   'php/ajax_citologia.php',
                        type:  'post',
                        dataType: 'json',
                        beforeSend: function () {  },
                        success:  function (response) {
                            var html = "";
                            $.each(response, function( index, value ) {
                                html+= '<option value="'+value.id+'">'+value.diagnostico+"</option>";
                            });  
                            $("#examen_id_c").html(html);
                        },
                        error:function(){
                            alert("error" + $("#paciente_id").val())
                        }
                    });
                })
                </script>
                </section>

                <button type="submit">Enviar</button>
            </form>
        <script src="js/form-informe.js"></script>
    </body>
</html>