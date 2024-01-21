<?php

    session_start(); // Inicia la sesión

    // REGISTRO DE PAGO & FACTURA

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


    /* 
    <!-- Pago -> Factura -->
        Orden de llenado
            1. Pago
            2. Factura   
            3. usuario-emite-factura         
    */
    
        // TABLA: pago
            $referencia   = $_POST["referencia"];
            $tipo_pago = $_POST["tipo_pago"];
            $obs   = $_POST["obs"];
            
        // TABLA: factura
            $monto = $_POST["monto"];
            $fecha_pago = $_POST["fecha"];
            $descripcion = $_POST["desc"];
            $cip = $_POST["paciente"];

            date_default_timezone_set('America/Caracas'); // Establece la zona horaria a la de Caracas, Venezuela.

        /*// TABLA: usuario-emite-factura
            if(isset($_SESSION['userID'])) { // Verifica si la variable de sesión 'userID' existe
                $idUsuario = $_SESSION['userID']; // Guarda el valor de la variable de sesión en $idUsuario
                echo "El ID del usuario es: " . $idUsuario;
            } else {
                echo "No se encontró el ID del usuario.";
            }
            $fecha_emision = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actual en el formato*/

        
        // ENVIANDO DATOS

            // Enviando Pago
            $sql_pago = "INSERT INTO pago (Referencia, Tipo_Pago, Obs) VALUES ('$referencia', '$tipo_pago', '$obs')";
            $ejecutado_pago = mysqli_query($conex,$sql_pago);
            if (!$ejecutado_pago) {
                throw new Exception("Error al insertar en la tabla 'pago'" . mysqli_error($conex));
            }

                // Buscando ID_Pago
                $buscar_id_pago = new BySearch();
                $buscar_id_pago->conexion = new mysqli("localhost","root","","higea_db");
                $resultado_id_pago = $buscar_id_pago->buscarBY('pago','ID_Pago');
                $id_pago = $resultado_id_pago[0]['ID_Pago'];
                

            // Enviando Factura
            $sql_factura = "INSERT INTO factura (Nro_Control, Monto, F_Pago, Descripcion, CIP) VALUES ('$id_pago', '$monto', '$fecha_pago', '$descripcion', '$cip')";
            $ejecutado_factura = mysqli_query($conex, $sql_factura);
            if (!$ejecutado_factura) {
                throw new Exception("Error al insertar en la tabla 'factura'" . mysqli_error($conex));
            }  
            /*
                // Buscando ID_Factura
                $buscar_id_factura = new BySearch();
                $buscar_id_factura->conexion = new mysqli("localhost","root","","higea_db");
                $resultado_id_factura = $buscar_id_factura->buscarBY('factura','ID_Factura');
                $id_factura = $resultado_id_factura[0]['ID_Factura'];

            // Enviando Usuario-Emite-Factura
            $sql_usuario_emite_factura = "INSERT INTO usuario_emite_factura (ID_Usuario, ID_Factura, F_Emision) VALUES ('$idUsuario', '$id_factura', '$fecha_emision')";
            $ejecutado_usuario_emite_factura = mysqli_query($conex, $sql_usuario_emite_factura);
            if (!$ejecutado_usuario_emite_factura) {
                throw new Exception("Error al insertar en la tabla 'usuario_emite_factura'" . mysqli_error($conex));
            } */

            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-pagos.php'; 
            </script>";      
?>
