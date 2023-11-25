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
        <title>Modulo de Registro de Informes</title>

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
                    <h1>INFORME BIOPSIA</h1>

                    <label for="examen_id_b">Examenes del Paciente:</label>
                    <select id="examen_id_b" name="examen_id_b" required>
                        <option value="" selected disabled>Seleccione paciente</option>
                    </select>


                        <br>


                    <label for="info_b"><h2>Informacion material remitido</h2></label>
                    <textarea id="info_b" name="info_b" cols="100" rows="7" style="resize: none;" required></textarea>


                        <br><br>
                    
                
                    <label for="des_macro_b"><h2>Descripción Macro</h2></label>
                    <textarea id="des_macro_b" name="des_macro_b" cols="80" rows="12" style="resize: none;" required></textarea>
                    
                    
                        <br><br>


                    <label for="des_micro_b"><h2>Descripción Micro</h2></label>
                    <textarea id="des_micro_b" name="des_micro_b" cols="80" rows="12" style="resize: none;" required></textarea>
                    
                    
                        <br><br>

                    
                    <label for="diag_b"><h2>Diagnostico</h2></label>
                    <textarea id="diag_b" name="diag_b" cols="65" rows="15" style="resize: none;" required></textarea>     
                        

                        <br><br>
                                
                    
                    <label for="obs_b"><h2>Obsevaciones/Comentarios</h2></label>
                    <textarea id="obs_b" name="obs_b" cols="65" rows="8" style="resize: none;" required></textarea>
                    
                        <br><br>

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
                                    html+= '<option value="'+value.id+'">'+value.diagnostico + value.fecha + "</option>";
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
                    <h1>INFORME CITOLOGÍA</h1>

                    <label for="examen_id_c">Examenes del Paciente:</label>
                    <select id="examen_id_c" name="examen_id_c" required>
                        <option value="" selected disabled>Seleccione paciente</option>
                    </select>

                    <label for="info_c"><h2>Informacion material remitido</h2></label>
                    <textarea id="info_c" name="info_c" cols="100" rows="7" style="resize: none;" required></textarea>


                        <br><br>


                    <label for="calidad_c"><h2>Calidad de muestras</h2></label>
                    <textarea id="calidad_c" name="calidad_c" cols="80" rows="12" style="resize: none;" required></textarea>


                        <br><br>


                    <label for="categ_c"><h2>Categoría General</h2></label>
                    <textarea id="categ_c" name="categ_c" cols="80" rows="12" style="resize: none;" required></textarea>
                    

                        <br><br>
                    

                    <label for="hallazgos_c"><h2>Hallazgos</h2></label>
                    <textarea id="hallazgos_c" name="hallazgos_c" cols="80" rows="12" style="resize: none;" required></textarea>
                    
                    
                        <br><br>


                    <label for="diag_c"><h2>Diagnostico</h2></label>
                    <textarea id="diag_c" name="diag_c" cols="65" rows="15" style="resize: none;" required></textarea>     
                        
                    
                        <br><br>

                        
                    <label for="conducta_c"><h2>Conducta</h2></label>
                    <textarea id="conducta_c" name="conducta_c" cols="65" rows="8" style="resize: none;" required></textarea>
                    

                        <br><br>


                    <label for="obs_c"><h2>Obsevaciones/Comentarios</h2></label>
                    <textarea name="obs_c" id="obs_c" cols="65" rows="8" style="resize: none;" required></textarea>

                        <br><br>

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
                                html+= '<option value="'+value.id+'">'+value.diagnostico + value.fecha + "</option>";
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