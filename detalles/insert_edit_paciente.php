<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['ci'] == ""){
        header('Location: ./detalles_paciente.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    $user = new CodeaDB();

    // Conectando con la base de datos Higea
    $conex = $user->conexion;    

    // Declarando las variables a utilizar
    $datosPaciente = $user->buscarBY("persona","CI='".$_POST['ci']."'");
        $datosPacienteActualizar = [];
        $sqlPacienteActualizar = "";

    $datosCorreo = $user->buscarONE("correo","CI='".$_POST['ci']."'","Correo");
        $sqlCorreoActualizar = "";

    $datosTelefono = $user->buscarONE("telefono","CI='".$_POST['ci']."'","Nro_Telf");
        $sqlTelefonoActualizar = "";

        // Persona
            if($_POST['pn'] != $datosPaciente[0]['PN']) {
                $datosPacienteActualizar[] .= "`PN` = '".$_POST['pn']."'";
            }

            if($_POST['sn'] != $datosPaciente[0]['SN']) {
                $datosPacienteActualizar[] .= "`SN` = '".$_POST['sn']."'";
            }

            if($_POST['tn'] != $datosPaciente[0]['TN']) {
                $datosPacienteActualizar[] .= "`TN` = '".$_POST['tn']."'";
            }

            if($_POST['pa'] != $datosPaciente[0]['PA']) {
                $datosPacienteActualizar[] .= "`PA` = '".$_POST['pa']."'";
            }

            if($_POST['sa'] != $datosPaciente[0]['SA']) {
                $datosPacienteActualizar[] .= "`SA` = '".$_POST['sa']."'";
            }

            if($_POST['f_nac'] != $datosPaciente[0]['F_nac']) {
                $datosPacienteActualizar[] .= "`F_nac` = '".$_POST['f_nac']."'";
            }

            if($_POST['sexo'] != $datosPaciente[0]['Sexo']) {
                $datosPacienteActualizar[] .= "`Sexo` = '".$_POST['sexo']."'";
            }

        // Correo
            if($_POST['correo'] != $datosCorreo) {
                $sqlCorreoActualizar = "`Correo` = '".$_POST['correo']."'";
            }

        // Telefono
            if($_POST['nro_telf'] != $datosTelefono) {
                $sqlTelefonoActualizar = "`Nro_Telf` = '".$_POST['nro_telf']."'";
            }

            if($datosPacienteActualizar || $sqlCorreoActualizar || $sqlTelefonoActualizar){

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

                echo "<script>
                alert('Los datos se han insertado correctamente.');
                window.location.href = './detalles_paciente.php';
                </script>";
            }
            else{
                echo "<script>alert('no cambiaste nada pa')</script>";
            }

            // UPDATE `persona` SET `PN` = 'MarlirioA', `SN` = 'AAAA', `PA` = 'Márquez', `Edad` = '50' WHERE `persona`.`CI` = 'V-5315064' AND `persona`.`ID_Direccion` = 2
            
                // Enviando PERSONA
                
                // $resultadoDireccion = $user->buscarBY('direccion','ID_Direccion');
                // foreach ($resultadoDireccion as $filaIdDireccion) {
                //     $idDireccion = $filaIdDireccion['ID_Direccion'];
                //     $sqlPersona = "INSERT INTO persona (CI, PN, SN, TN, PA, SA, F_nac, Edad, Sexo, ID_Direccion) VALUES ('$documento_id', '$nombre1_paciente', '$nombre2_paciente', '$nombre3_paciente', '$apellido1_paciente', '$apellido2_paciente', '$date_birth', '$edad', '$sexo', '$idDireccion')";
                //     $ejecutadoPersona = mysqli_query($conex,$sqlPersona);
                //     if (!$ejecutadoPersona) {
                //         throw new Exception("Error al insertar en la tabla Persona: " . mysqli_error($conex));
                //     }
                // }
                
                // // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
                // // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
                // echo "<script>
                // alert('Los datos se han insertado correctamente.');
                // window.location.href = './detalles_paciente.php';
                // </script>";

           
?>