<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['ci'] == ""){
        header('Location: ./detalles_paciente.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Edición de Paciente"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Declarando las variables a utilizar
        $datosPaciente = $user->buscarBY("persona", "CI='" . $_POST['ci'] . "'");
        $datosPacienteActualizar = [];
        $sqlPacienteActualizar = "";

        $datosCorreo = $user->buscarONE("correo", "CI='" . $_POST['ci'] . "'", "Correo");
        $sqlCorreoActualizar = "";

        $datosTelefono = $user->buscarONE("telefono", "CI='" . $_POST['ci'] . "'", "Nro_Telf");
        $sqlTelefonoActualizar = "";

    // Comprueba si los datos han sido modificado con respecto a su contraparte en la BDD
    // Si hay cambios, los guarda en una variable, sino los ignora

        // Persona
        if ($_POST['pn'] != $datosPaciente[0]['PN']) {
            $datosPacienteActualizar[] .= "`PN` = '" . $_POST['pn'] . "'";
        }

        if ($_POST['sn'] != $datosPaciente[0]['SN']) {
            $datosPacienteActualizar[] .= "`SN` = '" . $_POST['sn'] . "'";
        }

        if ($_POST['tn'] != $datosPaciente[0]['TN']) {
            $datosPacienteActualizar[] .= "`TN` = '" . $_POST['tn'] . "'";
        }

        if ($_POST['pa'] != $datosPaciente[0]['PA']) {
            $datosPacienteActualizar[] .= "`PA` = '" . $_POST['pa'] . "'";
        }

        if ($_POST['sa'] != $datosPaciente[0]['SA']) {
            $datosPacienteActualizar[] .= "`SA` = '" . $_POST['sa'] . "'";
        }

        if ($_POST['f_nac'] != $datosPaciente[0]['F_nac']) {
            $datosPacienteActualizar[] .= "`F_nac` = '" . $_POST['f_nac'] . "'";
        }

        if ($_POST['sexo'] != $datosPaciente[0]['Sexo']) {
            $datosPacienteActualizar[] .= "`Sexo` = '" . $_POST['sexo'] . "'";
        }

        // Correo
            if ($_POST['correo'] != $datosCorreo) {
                $sqlCorreoActualizar = "`Correo` = '" . $_POST['correo'] . "'";
            }

        // Telefono
            if($_POST['nro_telf'] != $datosTelefono) {
                $sqlTelefonoActualizar = "`Nro_Telf` = '".$_POST['nro_telf']."'";
            }
            else {
                $sqlTelefonoActualizar = "`Nro_Telf` = '".$datosTelefono."'";
            }

    // Si hay cambios en alguno de los array, ejecuta el siguiente codigo
    if ($datosPacienteActualizar || $sqlCorreoActualizar || $sqlTelefonoActualizar) {

        try {
            if($datosPacienteActualizar){
                for($i = 0; $i < count($datosPacienteActualizar); $i++){
                    if($i < count($datosPacienteActualizar)-1){
                    $sqlPacienteActualizar .= $datosPacienteActualizar[$i].", ";
                    }
                    else{
                        $sqlPacienteActualizar .= $datosPacienteActualizar[$i];
                    }
                }
            
                // Actualizando PERSONA
                $ActSqlPersona = "UPDATE `persona` SET $sqlPacienteActualizar WHERE `persona`.`CI` = '".$_POST['ci']."';";
                $ejecutadoActPersona = mysqli_query($conex,$ActSqlPersona);
                if (!$ejecutadoActPersona) {
                    throw new Exception("Error al actualizar en la tabla Persona: " . mysqli_error($conex));
                }
            }

            if($sqlCorreoActualizar){
                // Actualizando CORREO
                $ActSqlCorreo = "UPDATE `correo` SET $sqlCorreoActualizar WHERE `correo`.`CI` = '".$_POST['ci']."';";
                $ejecutadoActCorreo = mysqli_query($conex,$ActSqlCorreo);
                if (!$ejecutadoActCorreo) {
                    throw new Exception("Error al actualizar en la tabla Correo: " . mysqli_error($conex));
                }
            }

            if($sqlTelefonoActualizar){
                // Actualizando TELEFONO
                $ActSqlTel = "UPDATE `telefono` SET $sqlTelefonoActualizar WHERE `telefono`.`CI` = '".$_POST['ci']."';";
                $ejecutadoActTel = mysqli_query($conex,$ActSqlTel);
                if (!$ejecutadoActTel) {
                    throw new Exception("Error al actualizar en la tabla Telefono: " . mysqli_error($conex));
                }
            }
        }
        catch (Exception $e){
            die($alert->sweetError("./detalles_paciente.php","Error al guardar datos",$e->getMessage()));
        }

        die ($alert->sweetOK("./detalles_paciente.php", "Los datos se han actualizado correctamente"));

    }
    else{
        die ($alert->sweetWar("./detalles_paciente.php", "No se han introducidos datos para actualizar"));
    }
