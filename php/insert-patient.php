<?php

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Registro Paciente"));
    
    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Declarando las variables a utilizar, conectandolas con los datos recibidos de patient-register
    /* 
        Orden de llenado
            0. Registo Medico (si es necesario)

            1. direccion
            2. persona
            3. telefono / correo
            4. peciente
            5. medico
            6. medico-registra-paciente (fecha-obs)
    */

        // Medico OK
            $registro_medico_nuevo = isset($_POST['registro_medico_nuevo']);
            
            $id_medico = (isset($_POST['medico-bdd'])) ? $_POST['medico-bdd'] : null;

            $nombre_medico = $_POST['nombre-medico-registro'];
            $telefono_medico = $_POST['telefono-medico-registro'];
    
        // Direccion OK
            $parroquia = $_POST['parroquia'];
            $localizacion = $_POST['localizacion'];
            $sector = $_POST['sector'];
            $calle = $_POST['calle'];
            $nro_casa = $_POST['nro_casa'];

        // Persona
            $tipo_identidad = $_POST['tipo_identidad'];
            $ci_paciente = $_POST['cedula'];
            $documento_id = $tipo_identidad."-".$ci_paciente;
            $nombre1_paciente = $_POST['pn'];
            $nombre2_paciente = $_POST['sn'];
            $nombre3_paciente = $_POST['tn'];
            $apellido1_paciente = $_POST['pa'];
            $apellido2_paciente = $_POST['sa'];
            $date_birth = $_POST['f_nac'];
            $edad = '0';
            $sexo = $_POST['sexo'];

        // Telefono / Correo
            $telf_paciente = $_POST['tlfn'];
            $email_paciente = $_POST['correo'];

        // Medico-Remite-Paciente
            $f_registro = date("Y-m-d H:i:s");
            $obs = $_POST['obs'];
        
        
    
        
           
            /*
            Por ahora el rollback se descartara xq la unica forma que funcione es rediseñando el DER
            */

                try {

                    // Enviando MEDICO

                    if ($registro_medico_nuevo) {

                        $sql_Medico_Nuevo = "INSERT INTO medico (Nombre_Medico, Telefono_Medico) VALUES ('$nombre_medico', '$telefono_medico')";

                        $ejecutado_Medico_Nuevo = mysqli_query($conex,$sql_Medico_Nuevo);
                        if (!$ejecutado_Medico_Nuevo) {
                            throw new Exception("Error al insertar en la tabla Medico" . mysqli_error($conex));
                        }

                        // Registro del ID del Medico recien creado en $id_medico
                        $id_medico = $user->buscarONE('medico','ID_Medico','ID_Medico');

                    }

                    // Confirmar que cedula persona no este registrada
                        $buscar_ci_persona = $user->buscarExistencia("persona","CI='".$documento_id."'");                    

                    if(!$buscar_ci_persona){
                                
                        // Enviando DIRECCION
                        $sqlDireccion = "INSERT INTO Direccion (ID_Parroquia, Localizacion, Calle, Sector, Nro_Casa) VALUES ('$parroquia', '$localizacion', '$calle', '$sector', '$nro_casa')";
                        $ejecutadoDireccion = mysqli_query($conex,$sqlDireccion);
                        if (!$ejecutadoDireccion) {
                            throw new Exception("Error al insertar en la tabla Direccion" . mysqli_error($conex));
                        }
                                

                        // Enviando PERSONA
                        $resultadoDireccion = $user->buscarBY('direccion','ID_Direccion');

                        foreach ($resultadoDireccion as $filaIdDireccion) {
                            $idDireccion = $filaIdDireccion['ID_Direccion'];
                            $sqlPersona = "INSERT INTO persona (CI, PN, SN, TN, PA, SA, F_nac, Edad, Sexo, ID_Direccion) VALUES ('$documento_id', '$nombre1_paciente', '$nombre2_paciente', '$nombre3_paciente', '$apellido1_paciente', '$apellido2_paciente', '$date_birth', '$edad', '$sexo', '$idDireccion')";
                            $ejecutadoPersona = mysqli_query($conex,$sqlPersona);
                            if (!$ejecutadoPersona) {
                                throw new Exception("Error al insertar en la tabla Persona: " . mysqli_error($conex));
                            }
                        }
                

                        // Enviando TELEFONO
                        $sqlTelefono = "INSERT INTO telefono (Nro_Telf, CI) VALUES ('$telf_paciente', '$documento_id')";
                        $ejecutadoTelefono = mysqli_query($conex,$sqlTelefono);
                        if (!$ejecutadoTelefono) {
                            throw new Exception("Error al insertar en la tabla Telefono" . mysqli_error($conex));
                        }
                    
                
                        // Enviando CORREO
                        $sqlCorreo = "INSERT INTO correo (Correo, CI) VALUES ('$email_paciente', '$documento_id')";
                        $ejecutadoCorreo = mysqli_query($conex,$sqlCorreo);
                        if (!$ejecutadoCorreo) {
                            throw new Exception("Error al insertar en la tabla Correo" . mysqli_error($conex));
                        }
                    
                    }

                    // Confirmar que cedula paciente no este registrada
                        $buscar_ci_paciente = $user->buscarExistencia("paciente", "CIP='".$documento_id."'");

                    if(!$buscar_ci_paciente){
                        
                        // Enviando PACIENTE
                        $sql_Paciente = "INSERT INTO paciente (CIP) VALUES ('$documento_id')";
                        $ejecutado_Paciente = mysqli_query($conex,$sql_Paciente);
                        if (!$ejecutado_Paciente) {
                            throw new Exception("Error al insertar en la tabla Empleado" . mysqli_error($conex));
                        }


                        // Enviando MEDICO_REMITE_PACIENTE
                        $sql_Medico_Remite_Paciente = "INSERT INTO medico_remite_paciente (ID_Medico, CIP, F_Registro, Obs) VALUES ('$id_medico', '$documento_id', '$f_registro', '$obs')";
                        $ejecutado_Medico_Remite_Paciente = mysqli_query($conex,$sql_Medico_Remite_Paciente);
                        if (!$ejecutado_Medico_Remite_Paciente) {
                            throw new Exception("Error al insertar en la tabla Empleado" . mysqli_error($conex));
                        }
                    }
                    else{
                        die ($alert->sweetWar("../registro-paciente.php", "Paciente ya se encuentra registrado", "Dirijase a <b>Detalles→Paciente</b> si necesita modificar datos."));
                    }
                }
                catch (Exception $e){
                    die($alert->sweetError("../registro-paciente.php","Error al guardar datos",$e->getMessage()));
                }

                // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
                // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
                die ($alert->sweetOK("../registro-paciente.php", "Los datos del paciente se han insertado correctamente"));
                
?>
