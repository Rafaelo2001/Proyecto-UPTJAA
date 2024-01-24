<?php

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

    // Declarando las variables a utilizar, conectandolas con los datos recibidos de user-register
    /* 
        Orden de llenado
            1. direccion
            2. persona
            3. telefono / correo
            4. empleado
            5. usuario
            6. recup_password
    */
    
        // Direccion
            $parroquia = $_POST['parroquia'];
            $location = $_POST['location'];
            $sector = $_POST['sector'];
            $street = $_POST['street'];
            $house = $_POST['house'];

        // Persona
            $tipo_identidad = $_POST['tipo_identidad'];
            $ci_empl = $_POST['ci_empl'];
            $documento_id = $tipo_identidad."-".$ci_empl;
            $name_empl1 = $_POST['name_empl1'];
            $name_empl2 = $_POST['name_empl2'];
            $name_empl3 = $_POST['name_empl3'];
            $surname_empl1 = $_POST['surname_empl1'];
            $surname_empl2 = $_POST['surname_empl2'];
            $date_birth = $_POST['date_birth'];
            $edad = '0';
            $sexo = $_POST['sexo'];

        // Telefono / Correo
            $telf_empl = $_POST['telf_empl'];
            $email_empl = $_POST['email_empl'];

        // Empleado
            $tipe = $_POST['tipe'];
        
        // Usuario
            $username = $_POST['username'];
            $password = $_POST['password'];
        
        // Recup_Password
            $quest1 = $_POST['quest1'];
            $quest2 = $_POST['quest2'];
            $quest3 = $_POST['quest3'];
            $respuesta1 = $_POST['respuesta1'];
            $respuesta2 = $_POST['respuesta2'];
            $respuesta3 = $_POST['respuesta3'];
        
           
            /*
            Por ahora el rollback se descartara xq la unica forma que funcione es rediseñando el DER
            */

                        
                // Enviando DIRECCION
                $sqlDireccion = "INSERT INTO Direccion (ID_Parroquia, Localizacion, Calle, Sector, Nro_Casa) VALUES ('$parroquia', '$location', '$street', '$sector', '$house')";
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
                    $sqlPersona = "INSERT INTO persona (CI, PN, SN, TN, PA, SA, F_nac, Edad, Sexo, ID_Direccion) VALUES ('$documento_id', '$name_empl1', '$name_empl2', '$name_empl3', '$surname_empl1', '$surname_empl2', '$date_birth', '$edad', '$sexo', '$idDireccion')";
                    
                    $ejecutadoPersona = mysqli_query($conex,$sqlPersona);
                    if (!$ejecutadoPersona) {
                        throw new Exception("Error al insertar en la tabla Persona: " . mysqli_error($conex));
                    }
                }
        
                // Enviando TELEFONO
                $sqlTelefono = "INSERT INTO telefono (Nro_Telf, CI) VALUES ('$telf_empl', '$documento_id')";
                $ejecutadoTelefono = mysqli_query($conex,$sqlTelefono);
                if (!$ejecutadoTelefono) {
                    throw new Exception("Error al insertar en la tabla Telefono" . mysqli_error($conex));
                }
            
        
                // Enviando CORREO
                $sqlCorreo = "INSERT INTO correo (Correo, CI) VALUES ('$email_empl', '$documento_id')";
                $ejecutadoCorreo = mysqli_query($conex,$sqlCorreo);
                if (!$ejecutadoCorreo) {
                    throw new Exception("Error al insertar en la tabla Correo" . mysqli_error($conex));
                }
            
            
                // Enviando EMPLEADO
                $sqlEmpleado = "INSERT INTO Empleado (CIE, Tipo) VALUES ('$documento_id', '$tipe')";
                $ejecutadoEmpleado = mysqli_query($conex,$sqlEmpleado);
                if (!$ejecutadoEmpleado) {
                    throw new Exception("Error al insertar en la tabla Empleado" . mysqli_error($conex));
                }
        
        
                // Enviando USUARIO
                $password_hashed = password_hash($password, PASSWORD_BCRYPT);
                $sqlUsuario = "INSERT INTO usuario (Nombre, Password, CIE) VALUES ('$username', '$password_hashed', '$documento_id')";
                $ejecutadoUsuario = mysqli_query($conex,$sqlUsuario);
                if (!$ejecutadoUsuario) {
                    throw new Exception("Error al insertar en la tabla Usuario" . mysqli_error($conex));
                }
        
        
                // Enviando RECUP_PASSWORD
                $buscarIdUsuario = new BySearch();
                $buscarIdUsuario->conexion = new mysqli("localhost","root","","higea_db");
                $resultadoUsuario = $buscarIdUsuario->buscarBY('usuario','ID_Usuario');
                foreach ($resultadoUsuario as $filaIdUsuario) {
                    $idUsuario = $filaIdUsuario['ID_Usuario'];
                    $sqlRecup = "INSERT INTO Recup_Password (P1, P2, P3, R1, R2, R3, ID_Usuario) VALUES ('$quest1', '$quest2', '$quest3', '$respuesta1', '$respuesta2', '$respuesta3', '$idUsuario')";
                    $ejecutadoRecup = mysqli_query($conex,$sqlRecup);
                    if (!$ejecutadoRecup) {
                        throw new Exception("Error al insertar en la tabla Recup_Password" . mysqli_error($conex));
                    }
                }
                

                // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
                // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
                echo "<script>
                alert('Los datos se han insertado correctamente.');
                window.location.href = '../index.php';
                </script>";


?>