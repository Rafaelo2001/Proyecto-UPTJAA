<?php

    session_start(); // Inicia la sesión

    // REGISTRO DE EXAMEN

    require "../php/conexion.php";
    $user = new CodeaDB();

    // Conectando con la base de datos Higea
    $conex = $user->conexion;   

    
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

            // CITOLOGIA
            //     6 envases de 200cc de alcohol (1200cc total)
            //     3 envases de 200cc de xilol   ( 600cc total)

            if($tipo_examen == "biopsia") {
                
                $lista_Actualizar = $user->buscar('insumo','Consumo_Biop > 0');

                foreach($lista_Actualizar as $insumo){
                    $sql_insumo_biopsia = 'UPDATE `insumo` SET `Existencia`= `Existencia` - '.$insumo['Consumo_Biop'].' WHERE Material="'. $insumo['Material'] .'";';
                    if (!(mysqli_query($conex,$sql_insumo_biopsia))){
                        throw new Exception("Error al descontar insumos (biopsia)" . mysqli_error($conex));
                    }
                }

            }
            elseif($tipo_examen == "citologia") {
                
                $lista_Actualizar = $user->buscar('insumo','Consumo_Cito > 0');

                foreach($lista_Actualizar as $insumo){
                    $sql_insumo_citologia = 'UPDATE `insumo` SET `Existencia`= `Existencia` - '.$insumo['Consumo_Cito'].' WHERE Material="'. $insumo['Material'] .'";';
                    if (!(mysqli_query($conex,$sql_insumo_citologia))){
                        throw new Exception("Error al descontar insumos (citologia)" . mysqli_error($conex));
                    }
                }

            }

            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-examen.php'; 
            </script>";      
?>
