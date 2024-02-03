<?php

        include "../php/conexion.php";
        $user = new CodeaDB();

?>
<!DOCTYPE html>
<html>

        <body>
                <h1>Listado de Muestras</h1>
                <table style="text-align: center;">
                        <thead>
                                <th>N° Muestra</th>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Fecha Entrada</th>
                                <th>Examinado</th>
                                <th></th>
                        </thead>
                        <?php 
                                $busquedaBiopsia = $user->buscar("m_biopsia","1");
                                $busquedaCitologia = $user->buscar("m_citologia","1");

                                $listaMuestras = array_merge($busquedaBiopsia, $busquedaCitologia);
                                array_multisort(array_column($listaMuestras, 'ID_M_Remitido'), SORT_ASC, $listaMuestras);
                                
                                foreach($listaMuestras as $m):
                                    
                                    $material = $user->buscarSINGLE("m_remitido", "ID_M_Remitido = ".$m['ID_M_Remitido']);

                        ?>
                        <tr>
                        <?php

                                    $paciente = $user->buscarSINGLE('persona','CI = "'.$material['CI_Paciente'].'"');
                                    
                                            list($tipo_identidad, $ci_numerica) = explode('-', $paciente['CI']);
                                            $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
                                            $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

                                    $datos_paciente = $paciente['PN'] ." ". $paciente['PA'] ." (". $cedula_formateada .")"; 

                                    
                                    echo ("<td>".$m['ID_M_Remitido']."</td>");
                                    
                                    if(isset($m["ID_M_Biopsia"])){
                                        echo ("<td>B-".$m["ID_M_Biopsia"]."</td>");
                                    }
                                    elseif(isset($m["ID_M_Citologia"])){
                                        echo ("<td>C-".$m["ID_M_Citologia"]."</td>");
                                    }
                                    
                                    echo ("<td>".$datos_paciente."</td>");

                                    $tipo_m;
                                        if(isset($m["ID_M_Biopsia"])){
                                            $tipo_m = "Biopsia";
                                        }
                                        elseif(isset($m["ID_M_Citologia"])){
                                            $tipo_m = "Citología";
                                        }
                                    echo ("<td>$tipo_m</td>");

                                    if(strlen($material['Descripcion_material']) > 30){
                                        $Des_corta = substr($material['Descripcion_material'],0,30);
                                        $descripcion = $Des_corta."...";	
                                        echo ("<td>".$descripcion."</td>");
                                    }
                                    else{
                                        echo ("<td>".$material['Descripcion_material']."</td>");
                                    }

                                        $fecha = date("Y-m-d",strtotime($material['F_Entrada']));
                                    echo ("<td><input type='date' readonly value='".$fecha."' /></td>");            

                                    if($material['Examinado']){
                                        echo ("<td>Si</td>");
                                    }
                                    else{
                                        echo ("<td>No</td>");
                                    }

                                    echo ("<td><form action='./edit_muestras.php' method='post'><input type='hidden' name='id_m' value='".$m['ID_M_Remitido']."' required><input type='hidden' name='tipo_m' value='".$tipo_m."' required><input type='submit' value='Editar'></form></td>")


                                                // $genero = ($paciente['Sexo'] == "M") ? "Masculino" : "Femenino";

                                                // $telefono = $user->buscar("telefono", $ci_sql);
                                                // $tlfn = $telefono[0]['Nro_Telf'];

                                                // $correo = $user->buscar("correo", $ci_sql);
                                                // $email = $correo[0]['Correo'];

                                                // $f_nac = $paciente['F_nac'];
                                                
                                                // echo ("<td>".$cedula."</td>");
                                                // echo ("<td>".$nombre_completo."</td>");
                                                // echo ("<td><input type='date' readonly value='".$f_nac."' /></td>");
                                                // echo ("<td>".$genero."</td>");
                                                // echo ("<td>".$tlfn."</td>");
                                                // echo ("<td>".$email."</td>");
                                                // echo ("<td><form action='./edit_paciente.php' method='post'><input type='hidden' name='ci' value='$cedula' required><input type='submit' value='Editar Paciente'></form></td>")
                                                // // , $cedula_a_mostrar.' ', $genero.' ', $tlfn.' ', $email, "<br>";

                        ?>
                        </tr>
                        <?php

                                         endforeach; 

                                
                        ?>
                </table>
        </body>
</html>