<?php
    include "../php/conexion.php";
    $user = new CodeaDB();
?>
<!DOCTYPE html>
<html>

    <body>
        <h1>Listado de Ususarios</h1>

        <table style="text-align: center;">
            <thead>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Rol</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php 
                    $listaUsuarios = $user->buscar("usuario","`ID_Usuario` <> 1;"); 

                    foreach($listaUsuarios as $usuario):

                        echo("<tr>");

                        $cedula = $usuario['CIE'];
                        $ci_sql = "CI = '$cedula';";

                        $datosUsuario = $user->buscarSINGLE("persona", $ci_sql);
                                            
                            $sn = (empty($datosUsuario['SN'])) ? "" : $datosUsuario['SN']." ";
                            $tn = (empty($datosUsuario['TN'])) ? "" : $datosUsuario['TN']." ";
                            $sa = (empty($datosUsuario['SA'])) ? "" : " ".$datosUsuario['SA'];
                        $nombre_completo = $datosUsuario['PN'] ." ". $sn . $tn . $datosUsuario['PA'] . $sa; 
                    
                            list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
                            $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
                        $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

                        $id = $usuario['ID_Usuario'];
                        $nombre_usuario = $usuario['Nombre'];
                        $rol = ucfirst($usuario['Rol']);

                        echo ("<td>$id</td>");
                        echo ("<td>$nombre_usuario</td>");
                        echo ("<td>$nombre_completo</td>");
                        echo ("<td>$cedula_formateada</td>");
                        echo ("<td>$rol</td>");
                        echo ("<td><form action='./edit_usuario.php' method='post'><button name='id' value='$id'>Editar</button></form></td>");

                        echo("</tr>");      
                    endforeach; 
                ?>
                
            </tbody>
        </table>
    </body>
</html>