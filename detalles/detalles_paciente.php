<?php

        include "../php/conexion.php";
        $user = new CodeaDB();

?>
<!DOCTYPE html>
<html>

        <body>
                <h1>Listado de Pacientes</h1>
                <table style="text-align: center;">
                        <thead>
                                <th>CI</th>
                                <th>Nombre Completo</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Género</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th></th>
                        </thead>
                        <?php 
                                $listaPacientes = $user->buscar("paciente","1"); 
                                foreach($listaPacientes as $cedula_paciente):
                        
                                        $cedula = $cedula_paciente['CIP'];
                                        $ci_sql = "CI = '$cedula';";
                                        
                                        $pacientes = $user->buscar("persona", $ci_sql); 
                                        foreach($pacientes as $paciente):

                        ?>
                        <tr>
                        <?php
                                                
                                                $nombre_completo = $paciente['PN'] ." ". $paciente['SN'] ." ". $paciente['TN'] ." ". $paciente['PA'] ." ". $paciente['SA']; 
                                                
                                                        list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
                                                        $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
                                                        $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

                                                $cedula_a_mostrar = " - C.I.: $cedula_formateada";

                                                $genero = ($paciente['Sexo'] == "M") ? "Masculino" : "Femenino";

                                                $telefono = $user->buscar("telefono", $ci_sql);
                                                $tlfn = $telefono[0]['Nro_Telf'];

                                                $correo = $user->buscar("correo", $ci_sql);
                                                $email = $correo[0]['Correo'];

                                                $f_nac = $paciente['F_nac'];
                                                
                                                echo ("<td>".$cedula."</td>");
                                                echo ("<td>".$nombre_completo."</td>");
                                                echo ("<td><input type='date' readonly value='".$f_nac."' /></td>");
                                                echo ("<td>".$genero."</td>");
                                                echo ("<td>".$tlfn."</td>");
                                                echo ("<td>".$email."</td>");
                                                echo ("<td><form action='./edit_paciente.php' method='post'><input type='hidden' name='ci' value='$cedula' required><input type='submit' value='Editar Paciente'></form></td>")
                                                // , $cedula_a_mostrar.' ', $genero.' ', $tlfn.' ', $email, "<br>";

                        ?>
                        </tr>
                        <?php

                                        endforeach; 

                                endforeach; 
                        ?>
                </table>
        </body>
</html>