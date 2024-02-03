<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id'] == ""){
        header('Location: ./detalles_insumo.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    $insumo = $user->buscarSINGLE("insumo","ID_Insumo='".$_POST['id']."'");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Edición de Insumo (<?php echo ($insumo['Material']); ?>)</title>
        <script src="../js/jquery-3.7.1.js"></script>
    </head>
    <body>
        <h1>Edición de Insumo: <?php $insumo['Material'] ?></h1>
        <main>
            <form action="./insert_edit_insumo.php" method="post">
                <label for="material">Material:</label>
                    <input id="material" name="material" type="text" value="<?php echo($insumo["Material"]) ?>" required>

                    <br>

                <label for="unidades">Unidades:</label>
                    <input id="unidades" name="unidades" type="text" value="<?php echo($insumo["Unidades"]) ?>" required>

                    <br>

                <label for="existencia">Existencia:</label>
                    <input id="existencia" name="existencia" type="number" min="0" value="<?php echo($insumo["Existencia"]) ?>">

                    <br>

                <label for="minimo">Cantidad Mínima:</label>
                    <input id="minimo" name="minimo" type="number" min="0" value="<?php echo($insumo["Cant_minima"]) ?>">

                    <br>

                <label for="con_biop">Consumo en Biopsia:</label>
                    <input id="con_biop" name="con_biop" type="number" min="0" value="<?php echo($insumo["Consumo_Biop"]) ?>">

                    <br>

                <label for="con_cito">Consumo en Citología:</label>
                    <input id="con_cito" name="con_cito" type="number" min="0" value="<?php echo($insumo["Consumo_Cito"]) ?>">

                    <br><br><br>
                
                    <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
                    <input type="submit" id="enviar" value="Aplicar Cambios" disabled>
                
                </form>
        </main>
            <hr/>
        <section>
        <h2>Lotes de <?php echo ($insumo['Material']); ?></h2>
                <table style="text-align: center;">
                        <thead>
                            <th>Código</th>
                            <th>Fecha de Elaboración</th>
                            <th>Fecha de Entrada</th>
                            <th>Fecha de Expiración</th>
                            <th>Proveedor</th>
                            <th></th>
                        </thead>
                        <?php 
                            $listaRegistroLotes = $user->buscar("insumo_tiene_lote", "`ID_Insumo` = ".$_POST['id']."");
                            foreach($listaRegistroLotes as $lote):
                        ?>
                        <?php          
                                $datosLote = $user->buscarSINGLE("lote","ID_Lote =".$lote['ID_Lote']."");
                                        $codigo      = $datosLote['Codigo_Lote'];
                                        $elaborado   = $datosLote['F_Elab'];
                                        $entrada     = $datosLote['F_Entrada'];
                                        $vencimiento = $datosLote['F_Exp'];
                                        $proveedor   = $datosLote['Proveedor'];
                                                   
                                        echo("<form action='./insert_edit_lote.php' method='post'>");
                                        echo ("<td><input name='codigo'      type='text' value='$codigo'</td>");
                                        echo ("<td><input name='elaborado'   type='date' value='$elaborado'</td>");
                                        echo ("<td><input name='entrada'     type='date' value='$entrada'</td>");
                                        echo ("<td><input name='vencimiento' type='date' value='$vencimiento'</td>");
                                        echo ("<td><input name='proveedor'   type='text' value='$proveedor'</td>");
                                        echo ("<td><input type='hidden' name='id' value='".$_POST['id']."'><input type='hidden' name='id_lote' value='".$datosLote['ID_Lote']."' required><input type='submit' value='Editar Lote'></form></td>")
                        ?>
                        </tr>
                        <?php   endforeach; ?>
                </table>
        </section>
    </body>
    <script>
        $(":input").change(function(){
            $("#enviar").prop("disabled", false);
        })
        $(":input").keypress(function(){
            $("#enviar").prop("disabled", false);
        })
    </script>
</html>