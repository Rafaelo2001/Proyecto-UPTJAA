<?php

        include "../php/conexion.php";
        $user = new CodeaDB();

?>
<!DOCTYPE html>
<html>

        <body>
                <h1>Listado de Insumos</h1>
                <table style="text-align: center;">
                        <thead>
                                <th>Material</th>
                                <th>Unidades</th>
                                <th>Existencia</th>
                                <th>Cant. Mínima</th>
                                <th>Consumo en Biopsia</th>
                                <th>Consumo en Citología</th>
                                <th></th>
                        </thead>
                        <?php 
                                $listaInsumos = $user->buscar("insumo","1"); 
                                foreach($listaInsumos as $insumo):
                        ?>
                        <tr>
                        <?php                   
                                        $material = $insumo['Material'];
                                        $unidades = $insumo['Unidades']; 
                                
                                        $existencia = number_format(  $insumo['Existencia'], 0, ',', '.');
                                        $minimo     = number_format( $insumo['Cant_minima'], 0, ',', '.');
                                        $con_biop   = number_format($insumo['Consumo_Biop'], 0, ',', '.');
                                        $con_cito   = number_format($insumo['Consumo_Cito'], 0, ',', '.');
                                        
                                        echo ("<td>".$material."</td>");
                                        echo ("<td>".$unidades."</td>");
                                        echo ("<td style='text-align: right;'>".$existencia."</td>");
                                        echo ("<td style='text-align: right;'>".$minimo."</td>");
                                        echo ("<td style='text-align: right;'>".$con_biop."</td>");
                                        echo ("<td style='text-align: right;'>".$con_cito."</td>");
                                        echo ("<td><form action='./edit_insumo.php' method='post'><input type='hidden' name='id' value='".$insumo['ID_Insumo']."' required><input type='submit' value='Editar Insumo'></form></td>")
                        ?>
                        </tr>
                        <?php   endforeach; ?>
                </table>
        </body>
</html>