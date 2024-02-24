<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['ci'] == ""){
        header('Location: ./gestion_usuarios.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Edición de Usuario"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Declarando las variables a utilizar
        $datosPersona = $user->buscarSINGLE("persona", "CI='" . $_POST['ci'] . "'");
        $datosPersonaActualizar = [];
        $sqlPersonaActualizar = "";

        $datosCorreo = $user->buscarONE("correo", "CI='" . $_POST['ci'] . "'", "Correo");
        $sqlCorreoActualizar = "";

        $datosTelefono = $user->buscarONE("telefono", "CI='" . $_POST['ci'] . "'", "Nro_Telf");
        $sqlTelefonoActualizar = "";

        $datosUsuario = $user->buscarONE("usuario", "CIE='" . $_POST['ci'] . "'", "Nombre");
        $sqlUsuarioActualizar = "";

        $datosRol = $user->buscarONE("usuario", "CIE='" . $_POST['ci'] . "'", "Rol");
        $sqlRolActualizar = "";


    // Comprueba si los datos han sido modificado con respecto a su contraparte en la BDD
    // Si hay cambios, los guarda en una variable, sino los ignora

        // Persona
            if ($_POST['pn'] != $datosPersona['PN']) {
                $datosPersonaActualizar[] .= "`PN` = '" . $_POST['pn'] . "'";
            }

            if ($_POST['sn'] != $datosPersona['SN']) {
                $datosPersonaActualizar[] .= "`SN` = '" . $_POST['sn'] . "'";
            }

            if ($_POST['tn'] != $datosPersona['TN']) {
                $datosPersonaActualizar[] .= "`TN` = '" . $_POST['tn'] . "'";
            }

            if ($_POST['pa'] != $datosPersona['PA']) {
                $datosPersonaActualizar[] .= "`PA` = '" . $_POST['pa'] . "'";
            }

            if ($_POST['sa'] != $datosPersona['SA']) {
                $datosPersonaActualizar[] .= "`SA` = '" . $_POST['sa'] . "'";
            }

            if ($_POST['f_nac'] != $datosPersona['F_nac']) {
                $datosPersonaActualizar[] .= "`F_nac` = '" . $_POST['f_nac'] . "'";
            }

            if ($_POST['sexo'] != $datosPersona['Sexo']) {
                $datosPersonaActualizar[] .= "`Sexo` = '" . $_POST['sexo'] . "'";
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

        // Usuario
            if ($_POST['usuario'] != $datosUsuario) {
                $sqlUsuarioActualizar = "`Nombre` = '" . $_POST['usuario'] . "'";
            }

        // Rol
            if ($_POST['rol'] != $datosRol) {
                $sqlRolActualizar = "`Rol` = '" . $_POST['rol'] . "'";
            }

        // Si hay cambios en alguno de los array, ejecuta el siguiente codigo 
            if ($datosPersonaActualizar || $sqlCorreoActualizar || $sqlTelefonoActualizar || $sqlUsuarioActualizar || $sqlRolActualizar) {

                try {
                    if($datosPersonaActualizar){
                        for($i = 0; $i < count($datosPersonaActualizar); $i++){
                            if($i < count($datosPersonaActualizar)-1){
                            $sqlPersonaActualizar .= $datosPersonaActualizar[$i].", ";
                            }
                            else{
                                $sqlPersonaActualizar .= $datosPersonaActualizar[$i];
                            }
                        }
                    
                        // Actualizando PERSONA
                        $ActSqlPersona = "UPDATE `persona` SET $sqlPersonaActualizar WHERE `persona`.`CI` = '".$_POST['ci']."';";
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

                    if($sqlUsuarioActualizar){
                        // Actualizando USUARIO
                        $ActSqlUser = "UPDATE `usuario` SET $sqlUsuarioActualizar WHERE `usuario`.`CIE` = '".$_POST['ci']."';";
                        $ejecutadoActUser = mysqli_query($conex,$ActSqlUser);
                        if (!$ejecutadoActUser) {
                            throw new Exception("Error al actualizar en la tabla Usuario.Nombre: " . mysqli_error($conex));
                        }
                    }

                    if($sqlRolActualizar){
                        // Actualizando ROL de USUARIO
                        $ActSqlRol = "UPDATE `usuario` SET $sqlRolActualizar WHERE `usuario`.`CIE` = '".$_POST['ci']."';";
                        $ejecutadoActRol = mysqli_query($conex,$ActSqlRol);
                        if (!$ejecutadoActRol) {
                            throw new Exception("Error al actualizar en la tabla Usuario.Rol: " . mysqli_error($conex));
                        }
                    }
                }
                catch (Exception $e){
                    die($alert->sweetError("./gestion_usuarios.php","Error al guardar datos",$e->getMessage()));
                }

                die ($alert->sweetOK("./gestion_usuarios.php", "Los datos se han actualizado correctamente"));
        
            }
            else{
                die ($alert->sweetWar("./gestion_usuarios.php", "No se han introducidos datos para actualizar"));
            }
