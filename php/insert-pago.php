<?php

    // REGISTRO DE PAGO & FACTURA
    
    session_start(); // Inicia la sesión

    // Clase para Busqueda de datos en BDD
    class BySearch
    {
        // BUSCAR x BY
        // Utilizar esta funcion para extraer un valor de la BDD y utilizar en otras funciones
        // Esta funcion retorna el ultimo valor registrado en la tabla
        public function buscarBY($tabla, $columna)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
            if ($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
    }

    // Conectando con la base de datos Higea
    $conex = mysqli_connect("localhost", "root", "", "higea_db");


    /* 
    Pago -> Factura
    
        Orden de llenado
            1. Pago
            2. Factura   
            3. usuario-emite-factura         
    */

        // TABLA: pago
        $referencia   = $_POST["referencia"];
        $tipo_pago = $_POST["tipo_pago"];
        $fecha_pago = $_POST["fecha"];
        $obs   = $_POST["obs"];

        date_default_timezone_set('America/Caracas'); // Establece la zona horaria a la de Caracas, Venezuela.

        // TABLA: factura
        $monto = $_POST["monto"];
        $fecha_emision = date('Y-m-d H:i:s');
        $descripcion = $_POST["desc"];
        $cip = $_POST["paciente"];



        // ENVIANDO DATOS

            // Enviando Pago
            $sql_pago = "INSERT INTO pago (Referencia, Tipo_Pago, F_Pago, Obs) VALUES ('$referencia', '$tipo_pago', '$fecha_pago', '$obs')";
            $ejecutado_pago = mysqli_query($conex, $sql_pago);
            if (!$ejecutado_pago) {
                throw new Exception("Error al insertar en la tabla 'pago'" . mysqli_error($conex));
            }

            // Buscando ID_Pago
            $buscar_id_pago = new BySearch();
            $buscar_id_pago->conexion = new mysqli("localhost", "root", "", "higea_db");
            $resultado_id_pago = $buscar_id_pago->buscarBY('pago', 'ID_Pago');
            $id_pago = $resultado_id_pago[0]['ID_Pago'];


            // Enviando Factura
            $sql_factura = "INSERT INTO factura (Nro_Control, Monto, F_Emision, Descripcion, CIP) VALUES ('$id_pago', '$monto', '$fecha_emision', '$descripcion', '$cip')";
            $ejecutado_factura = mysqli_query($conex, $sql_factura);
            if (!$ejecutado_factura) {
                throw new Exception("Error al insertar en la tabla 'factura'" . mysqli_error($conex));
            }

        echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-pagos.php'; 
            </script>";
