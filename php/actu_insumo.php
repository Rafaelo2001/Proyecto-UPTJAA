<?php

    session_start(); // Inicia la sesión

    // REGISTRO DE EXAMEN

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
        public function buscar($tabla, $condicion){
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
    }

    // Conectando con la base de datos Higea
    $conex = mysqli_connect("localhost","root","","higea_db");
    date_default_timezone_set('America/Caracas');


        // TABLA: insumo
            $id_insumo      = $_POST["id_insumo"];
            $tipo           = $_POST["tipo_act"];
            $cant_a_agregar = ($_POST["cant"] > 0) ? $_POST["cant"] : 0;
            
        // Ejemplo UPDATE m_remitido
        // UPDATE `m_remitido` SET `Examinado` = '1' WHERE `m_remitido`.`ID_M_Remitido` = 6
        
        // ENVIANDO DATOS

        if($tipo == "directo"){

            // Buscando datos
            $buscar_insumo = new BySearch();
            $buscar_insumo->conexion = new mysqli("localhost","root","","higea_db");
            $resultado_insumo = $buscar_insumo->buscar('insumo','ID_Insumo='.$id_insumo);

            $cant_actual = $resultado_insumo[0]["Existencia"];

            $cant_final = $cant_actual+$cant_a_agregar;

            // Actualizando m_remitido
            $sql_act_insumo = "UPDATE insumo SET Existencia = '$cant_final' WHERE insumo.ID_Insumo = '$id_insumo'";
            $ejecutado_act_insumo = mysqli_query($conex, $sql_act_insumo);
            if (!$ejecutado_act_insumo) {
                throw new Exception("Error al actualizar material en la tabla 'insumo'" . mysqli_error($conex));
            }  
        }
        elseif($tipo == "lote"){
            $cog_lote = $_POST["id_lote"];
            $f_elab = $_POST["f_elab"];
            $f_entrada = date('Y-m-d');
            $f_exp  = $_POST["f_exp"];
            $proveedor = $_POST["proveedor"];

                $buscar_insumo = new BySearch();
                $buscar_insumo->conexion = new mysqli("localhost","root","","higea_db");
                $resultado_insumo = $buscar_insumo->buscar('insumo','ID_Insumo='.$id_insumo);

                $cant_actual = $resultado_insumo[0]["Existencia"];

                $cant_final = $cant_actual+$cant_a_agregar;

            // Actualizando m_remitido
            $sql_act_insumo = "UPDATE insumo SET Existencia = '$cant_final' WHERE insumo.ID_Insumo = '$id_insumo'";
            $ejecutado_act_insumo = mysqli_query($conex, $sql_act_insumo);
            if (!$ejecutado_act_insumo) {
                throw new Exception("Error al actualizar material en la tabla 'insumo'" . mysqli_error($conex));
            }

            // Llenando Lote
            $sql_lote = "INSERT INTO lote (Codigo_Lote, F_Elab, F_Entrada, F_Exp, Proveedor) VALUES ('$cog_lote', '$f_elab', '$f_entrada', '$f_exp', '$proveedor')";
            $ejecutado_lote = mysqli_query($conex, $sql_lote);
            if (!$ejecutado_lote) {
                throw new Exception("Error al actualizar material en la tabla 'lote'" . mysqli_error($conex));
            }

            // Buscando id lote
                $buscar_lote = new BySearch();
                $buscar_lote->conexion = new mysqli("localhost","root","","higea_db");
                $resultado_lote = $buscar_lote->buscarBY('lote','ID_Lote');

                $id_lote = $resultado_lote[0]["ID_Lote"];

                $fecha_actual_detallada = date('Y-m-d H:i:s');

            // Llenando Insumo_tiene_lote
            $sql_itl = "INSERT INTO insumo_tiene_lote (ID_Insumo, ID_Lote, F_Registro_Lote) VALUES ('$id_insumo', '$id_lote', '$fecha_actual_detallada')";
            $ejecutado_itl = mysqli_query($conex, $sql_itl);
            if (!$ejecutado_itl) {
                throw new Exception("Error al actualizar material en la tabla 'insumo_tiene_lote'" . mysqli_error($conex));
            }
        }

            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../visualizar-insumo.php'; 
            </script>";     
?>