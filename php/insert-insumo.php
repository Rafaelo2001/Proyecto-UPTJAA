<?php

    session_start(); // Inicia la sesión

    // REGISTRO DE NUEVOS INSUMOS

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
    
        // TABLA: insumo
            $material    = $_POST["material"];
            $unidades    = $_POST["unidades"];
            $cant_minima = $_POST["cant_minima"];
            $existencia  = $_POST["existencia"];
            $duracion    = $_POST["duracion"];
            
        
        // ENVIANDO DATOS

            // Enviando Insumo
            $sql_insumo = "INSERT INTO insumo (Material, Unidades, Existencia, Cant_minima, Duracion) VALUES ('$material', '$unidades', '$existencia', '$cant_minima', '$duracion')";
            $ejecutado_insumo = mysqli_query($conex,$sql_insumo);
            if (!$ejecutado_insumo) {
                throw new Exception("Error al insertar en la tabla 'insumo'" . mysqli_error($conex));
            }

            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-insumo.php'; 
            </script>";      
?>
