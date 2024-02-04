<?php

    require "../php/conexion.php";
    $user = new CodeaDB();
    echo("<html><link href='../css/sweetalert2.min.css' rel='stylesheet'/><link rel='stylesheet' type='text/css' href='../css/sweetalert2.min.css?v=1.1'><head><script src='../js/sweetalert2.all.min.js?v=1.2'></script></head><body style='background: rgb(248,255,254);background: linear-gradient(132deg, rgb(248, 255, 254) 0%, rgba(171,255,255,1) 100%);'</body>");

    class BySearch
    {
        // BUSCAR x BY
        // Utilizar esta funcion para extraer un valor de la BDD y utilizar en otras funciones
        // Esta funcion retorna el ultimo valor registrado en la tabla
        public function buscarBY($tabla, $columna)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
    }
    
    // Conectando con la base de datos Higea
    $conex = mysqli_connect("localhost","root","","higea_db");

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

                // Enviando MEDICO

                if ($registro_medico_nuevo) {

                    $sql_Medico_Nuevo = "INSERT INTO medico (Nombre_Medico, Telefono_Medico) VALUES ('$nombre_medico', '$telefono_medico')";

                    $ejecutado_Medico_Nuevo = mysqli_query($conex,$sql_Medico_Nuevo);
                    if (!$ejecutado_Medico_Nuevo) {
                        throw new Exception("Error al insertar en la tabla Medico" . mysqli_error($conex));
                    }

                    // Registro del ID del Medico recien creado en $id_medico

                    $buscar_id_medico = new BySearch();
                    $buscar_id_medico->conexion = new mysqli("localhost","root","","higea_db");
                    $resultado_id_medico = $buscar_id_medico->buscarBY('medico','ID_Medico');

                    foreach ($resultado_id_medico as $fila_id_medico) {
                        $id_medico = $fila_id_medico['ID_Medico'];
                    }

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
                    $buscarIdDirecion = new BySearch();
                    $buscarIdDirecion->conexion = new mysqli("localhost","root","","higea_db");
                    $resultadoDireccion = $buscarIdDirecion->buscarBY('direccion','ID_Direccion');
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
                    echo "<script>Swal.fire('Paciente ya se encuentra registrado.');</script>";
                }
    
                // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
                // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
                echo "</html><script>Swal.fire('Los datos del paciente se han insertado correctamente.');</script>";
// window.location.href = '../registro-paciente.php';
?>