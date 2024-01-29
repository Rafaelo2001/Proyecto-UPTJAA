<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['ci'] == ""){
        header('Location: ./detalles_paciente.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    $datosPaciente = $user->buscarBY("persona","CI='".$_POST['ci']."'");
    $datosTelefono = $user->buscarONE("telefono","CI='".$_POST['ci']."'","Nro_Telf");
    $datosCorreo = $user->buscarONE("correo","CI='".$_POST['ci']."'","Correo");

    $its_a_boy = "";
    $its_a_girl = "";

    if ($datosPaciente[0]["Sexo"] == "M"){
        $its_a_boy = "checked";
        $its_a_girl = "";
    }
    elseif($datosPaciente[0]["Sexo"] == "F"){
        $its_a_boy = "";
        $its_a_girl = "checked";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Edición de Paciente (<?php echo ($_POST["ci"]); ?>)</title>
        <script src="../js/jquery-3.7.1.js"></script>
    </head>
    <body>
        <h1>Edición de Paciente: <?php echo($datosPaciente[0]["PN"]." ".$datosPaciente[0]["PN"])." ".$datosPaciente[0]["CI"] ?></h1>
        <main>
            <form action="./insert_edit_paciente.php" method="post">
                <label for="pn">Primer Nombre:</label>
                    <input id="pn" name="pn" type="text" value="<?php echo($datosPaciente[0]["PN"]) ?>" required>

                    <br>

                <label for="sn">Segundo Nombre:</label>
                    <input id="sn" name="sn" type="text" value="<?php echo($datosPaciente[0]["SN"]) ?>">

                    <br>

                <label for="tn">Tercer Nombre:</label>
                    <input id="tn" name="tn" type="text" value="<?php echo($datosPaciente[0]["TN"]) ?>">

                    <br>

                <label for="pa">Primer Apellido:</label>
                    <input id="pa" name="pa" type="text" value="<?php echo($datosPaciente[0]["PA"]) ?>" required>

                    <br>

                <label for="sa">Segundo Apellido:</label>
                    <input id="sa" name="sa" type="text" value="<?php echo($datosPaciente[0]["SA"]) ?>">

                    <br><br>
                
                <label for="f_nac">Fecha de Nacimiento:</label>
                    <input id="f_nac" name="f_nac" type="date" value="<?php echo($datosPaciente[0]["F_nac"]) ?>">

                    <br><br>

                <label>Sexo:</label>
                    <br>
                    <label for="sexoM">Masculino:</label>
                    <input id="sexoM" name="sexo" type="radio" value="M" <?php echo($its_a_boy) ?>>
                        <br>
                    <label for="sexoF">Femenino:</label>
                    <input id="sexoF" name="sexo" type="radio" value="F" <?php echo($its_a_girl) ?>>

                    <br><br>

                <label for="telf">Telefono:</label>
                    <input id="telf" name="nro_telf" type="tel" value="<?php echo($datosTelefono) ?>">

                    <br><br>

                <label for="correo">Correo:</label>
                    <input id="correo" name="correo" type="email" value="<?php echo($datosCorreo) ?>">

                    <br><br><br>
                
                    <input type="hidden" name="ci" value="<?php echo $_POST['ci']; ?>">
                    <input type="submit" id="enviar" value="Aplicar Cambios" disabled>
                
                </form>
        </main>
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