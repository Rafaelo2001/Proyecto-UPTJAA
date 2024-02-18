<?php
    include "../php/conexion.php";
    $user = new CodeaDB();
?>
<!DOCTYPE html>
<html>

    <body>
        <h1>Listado de Facturas</h1>

        <input type="text" id="filtro" onkeyup="filtrarTabla()" placeholder="Filtrar por Nombre, Cedula, Fecha, etc...">
		<br><br>

        <table style="text-align: center;" id="table">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Decripción</th>
                <th>Fecha de Emisión</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php 
                    $listaFacturas = $user->buscar("factura","1");

                    foreach($listaFacturas as $factura):

                        echo("<tr>");

                        if (strlen($factura['Descripcion']) > 30) {
                            $des_corta = substr($factura['Descripcion'], 0, 30);
                            $descripcion = $des_corta . "...";
                        } else {
                            $descripcion = $factura['Descripcion'];
                        }

                        $id = $factura['ID_Factura'];

                        $cedula = $factura['CIP'];

                        $datosPaciente = $user->buscarSINGLE("persona", "CI = '$cedula'");

                                $sn = (empty($datosPaciente['SN'])) ? "" : $datosPaciente['SN']." ";
                                $tn = (empty($datosPaciente['TN'])) ? "" : $datosPaciente['TN']." ";
                                $sa = (empty($datosPaciente['SA'])) ? "" : " ".$datosPaciente['SA'];
                            $nombre_completo = $datosPaciente['PN'] ." ". $sn . $tn . $datosPaciente['PA'] . $sa; 

                        $emision = date("d/m/y H:i:s A",strtotime($factura['F_Emision']));

                        echo ("<td>$id</td>");
                        echo ("<td>$nombre_completo</td>");
                        echo ("<td>$cedula</td>");
                        echo ("<td>$descripcion</td>");
                        echo ("<td>$emision</td>");
                        echo ("<td><form action='./imprimir_factura.php' method='post'><button name='id' value='$id'>Imprimir</button></form></td>");

                        echo("</tr>");

                    endforeach; 
                ?>
            </tbody>
        </table>

        <script>
            function filtrarTabla() {
            // Obtener el valor ingresado en el campo de entrada
            var filtro = document.getElementById("filtro").value.toUpperCase();

            // Obtener la tabla y las filas de la tabla
            var tabla = document.getElementById("table");
            var filas = tabla.getElementsByTagName("tr");

            // Recorrer las filas de la tabla y mostrar u ocultar según el filtro
            for (var i = 1; i < filas.length; i++) {
                var celdas = filas[i].getElementsByTagName("td");
                var mostrarFila = false;

                // Comparar el valor del filtro con cada celda de la fila
                for (var j = 0; j < celdas.length; j++) {
                    var contenidoCelda = celdas[j].textContent || celdas[j].innerText;
                    if (contenidoCelda.toUpperCase().indexOf(filtro) > -1) {
                        mostrarFila = true;
                        break;
                    }
                }

                // Mostrar u ocultar la fila según el resultado de la comparación
                if (mostrarFila) {
                    filas[i].style.display = "";
                } else {					
                    filas[i].style.display = "none";
                }
            }
        }
        </script>
    </body>
</html>