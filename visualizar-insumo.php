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
        <title>Visualización de Insumos</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles_nav.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>
    <body>
        <h1>Visualizador de Insumos</h1>
        <!-- Alcohol, xilol, formol, parafina,coloración, hematoxilina, Pap-mart, citofix, laminas, laminillas, hojillas de microtomo, eosina, hojas blancas. -->
        <form action="php/actu_insumo.php" method="post">
            <select id="insumo" name="id_insumo" required>
                <option disabled selected></option>
                <?php
                    $listaInsumo = $user->buscar("insumo","1");

                    foreach($listaInsumo as $insumo):
                ?>
                <option value="<?php echo($insumo["ID_Insumo"]); ?>">
                    <?php echo($insumo["Material"]); ?>
                </option>
                <?php
                    endforeach;
                ?>
            </select>

                    <br><br>

            <label for="existencia">Existencia actual:</label>
            <input type="text" id="existencia" readonly style="text-align: right;">
            <label for="existencia" id="unidades_existencia"></label>

                    <br><br>

            <label for="cant_minima">Cantidad minima:</label>
            <input type="text" id="cant_minima" readonly style="text-align: right;">
            <label for="cant_minima" id="unidades_cant_minima"></label>

                <br><br><br>

            <h2>Agregar Insumos:</h2>

            <input type="radio" name="tipo_act" id="directo" value="directo" required> <label for="directo">Directo</label>
            <input type="radio" name="tipo_act" id="lote" value="lote">       <label for="lote">Lote</label>

                    <br>

            <section id="sec_directo" style="display: none;">
                <h3>Directo:</h3>
                <label for="cant">Cantidad a añadir:</label>
                <input type="number" name="cant" min="0" disabled>
                <label for="cant" id="unidades_cant"></label>
            </section>

            <section id="sec_lote" style="display: none;">
                <h3>Por Lote:</h3>
                <label for="cant">Cantidad a añadir:</label>
                <input type="number" name="cant" min="0" disabled>
                <label for="cant" id="unidades_cant"></label>

                    <br><br>

                <label>ID Lote:</label>
                <input type="text" name="id_lote" disabled>

                    <br><br>

                <label>Fecha de Elaboracion:</label>
                <input type="date" name="f_elab" disabled>

                    <br><br>

                <label>Fecha de Expiracion:</label>
                <input type="date" name="f_exp" disabled>

                    <br><br>

                <label>Proveedor:</label>
                <input type="text" name="proveedor" disabled>
            </section>

                    <br>

            <input type="submit" value="Guardar">
        </form>
    </body>
    <script>
        $("[name='tipo_act']").change(
            function(){
                let tipo_ingreso = $("[name='tipo_act']:checked").val();

                if(tipo_ingreso == "directo"){
                    $("#sec_lote").css("display","none");
                    $("#sec_lote *").prop("required", false);  
                    $("#sec_lote *").prop("disabled", true);

                    $("#sec_directo").css("display","block");
                    $("#sec_directo *").prop("required", true);
                    $("#sec_directo *").prop("disabled", false);
                }
                else if(tipo_ingreso == "lote"){
                    $("#sec_directo").css("display","none");
                    $("#sec_directo *").prop("required", false);  
                    $("#sec_directo *").prop("disabled", true);

                    $("#sec_lote").css("display","block");
                    $("#sec_lote *").prop("required", true);
                    $("#sec_lote *").prop("disabled", false);
                }
        });

        let insumo = $("#insumo");

        insumo.change(function(){
            $.ajax({
                data:   "id_insumo="+insumo.val(),
                url:    "php/ajax_insumo.php",
                type:   "post",
                dataType:   "json",
                success: function(response) {
                    $("#existencia").val(response[0]["existencia"]);
                    $("#unidades_existencia").html(response[0]["unidades"]);

                    $("#cant_minima").val(response[0]["cant_minima"]);
                    $("#unidades_cant_minima").html(response[0]["unidades"]);

                    $("#unidades_cant").html(response[0]["unidades"]);
                },
                error: function(file, status) {
                    alert("Error en Ajax");
                    console.log(file);
                    console.log(status);
                }
            });
        });
    </script>
</html>