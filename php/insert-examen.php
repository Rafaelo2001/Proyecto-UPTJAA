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
    }
    
    // Conectando con la base de datos Higea
    $conex = mysqli_connect("localhost","root","","higea_db");

    
        // TABLA: examen
            $id_m_remitido  = $_POST["m_remitido"];
            $tipo_examen    = $_POST["tipo_examen"];
            $fecha          = $_POST["fecha"];
            $obs            = $_POST["obs"];
            
        // Ejemplo UPDATE m_remitido
        // UPDATE `m_remitido` SET `Examinado` = '1' WHERE `m_remitido`.`ID_M_Remitido` = 6
        
        // ENVIANDO DATOS

            // Enviando Examen
            $sql_examen = "INSERT INTO examen (ID_M_remitido, Tipo, F_Examen, Obs) VALUES ('$id_m_remitido', '$tipo_examen', '$fecha', '$obs')";
            $ejecutado_examen = mysqli_query($conex,$sql_examen);
            if (!$ejecutado_examen) {
                throw new Exception("Error al insertar en la tabla 'examen'" . mysqli_error($conex));
            }

            // Actualizando m_remitido
            $sql_act_mremitido = "UPDATE m_remitido SET Examinado = 1 WHERE m_remitido.ID_M_Remitido = '$id_m_remitido'";
            $ejecutado_act_mremitido = mysqli_query($conex, $sql_act_mremitido);
            if (!$ejecutado_act_mremitido) {
                throw new Exception("Error al actualizar material en la tabla 'm_remitido'" . mysqli_error($conex));
            }

            // Consumo de Insumos
            // BIOPSIA
            //     6 envases de 400cc de alcohol 	    	(2400cc total)
            //     3 envases de 400cc de xilol   	    	(1200cc total)
            //     2 envases de 400cc de Parafina Liquida	( 800cc total)
            //         UPDATE `insumo` SET `Existencia`= `Existencia` - 2400 WHERE Material="Alcohol";
            //         UPDATE `insumo` SET `Existencia`= `Existencia` - 1200 WHERE Material="Xilol";
            //         UPDATE `insumo` SET `Existencia`= `Existencia` -  800 WHERE Material="Parafina Liquida";

            // CITOLOGIA
            //     6 envases de 200cc de alcohol (1200cc total)
            //     3 envases de 200cc de xilol   ( 600cc total)
            //         UPDATE `insumo` SET `Existencia`= `Existencia` - 1200 WHERE Material="Alcohol";
            //         UPDATE `insumo` SET `Existencia`= `Existencia` -  600 WHERE Material="Xilol";

            if($tipo_examen == "biopsia") {
                $sql_insumo_biopsia1 = 'UPDATE `insumo` SET `Existencia`= `Existencia` - 2400 WHERE Material="Alcohol";';
                if (!(mysqli_query($conex,$sql_insumo_biopsia1))){
                    throw new Exception("Error al descontar insumos (biopsia)" . mysqli_error($conex));
                }
                $sql_insumo_biopsia2 = 'UPDATE `insumo` SET `Existencia`= `Existencia` - 1200 WHERE Material="Xilol";';
                if (!(mysqli_query($conex,$sql_insumo_biopsia2))){
                    throw new Exception("Error al descontar insumos (biopsia)" . mysqli_error($conex));
                }
                $sql_insumo_biopsia3 = 'UPDATE `insumo` SET `Existencia`= `Existencia` -  800 WHERE Material="Parafina Liquida";';
                if (!(mysqli_query($conex,$sql_insumo_biopsia3))){
                    throw new Exception("Error al descontar insumos (biopsia)" . mysqli_error($conex));
                }
            }
            elseif($tipo_examen == "citologia") {
                $sql_insumo_citologia1 = 'UPDATE `insumo` SET `Existencia`= `Existencia` - 1200 WHERE Material="Alcohol";';
                if (!(mysqli_query($conex,$sql_insumo_citologia1))){
                    throw new Exception("Error al descontar insumos (citologia)" . mysqli_error($conex));
                }
                $sql_insumo_citologia2 = 'UPDATE `insumo` SET `Existencia`= `Existencia` -  600 WHERE Material="Xilol";';
                if (!(mysqli_query($conex,$sql_insumo_citologia2))){
                    throw new Exception("Error al descontar insumos (citologia)" . mysqli_error($conex));
                }
            }

            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-examen.php'; 
            </script>";      
?>
