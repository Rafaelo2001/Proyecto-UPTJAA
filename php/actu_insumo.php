<?php

    session_start(); // Inicia la sesión

    // REGISTRO DE EXAMEN

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Actualización de Insumo"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Cambiando la zona horaria
    date_default_timezone_set('America/Caracas');


        // TABLA: insumo
            $id_insumo      = $_POST["id_insumo"];
            $tipo           = $_POST["tipo_act"];
            $cant_a_agregar = ($_POST["cant"] > 0) ? $_POST["cant"] : 0;
    
        
        // ENVIANDO DATOS

            try {
                if($tipo == "directo"){

                    // Buscando datos
                    $cant_actual = $user->buscarONE('insumo','ID_Insumo='.$id_insumo,'Existencia');
                    $cant_final  = $cant_actual+$cant_a_agregar;

                    // Actualizando m_remitido
                    $sql_act_insumo = "UPDATE insumo SET Existencia = '$cant_final' WHERE insumo.ID_Insumo = '$id_insumo'";
                    $ejecutado_act_insumo = mysqli_query($conex, $sql_act_insumo);
                    if (!$ejecutado_act_insumo) {
                        throw new Exception("Error al actualizar material en la tabla 'insumo'" . mysqli_error($conex));
                    }  
                }
                elseif($tipo == "lote"){
                    $cog_lote   = $_POST["id_lote"];
                    $f_elab     = $_POST["f_elab"];
                    $f_entrada  = date('Y-m-d');
                    $f_exp      = $_POST["f_exp"];
                    $proveedor  = $_POST["proveedor"];

                        $cant_actual = $user->buscarONE('insumo','ID_Insumo='.$id_insumo,'Existencia');
                        $cant_final  = $cant_actual+$cant_a_agregar;

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
                        $id_lote = $user->buscarONE('lote','ID_Lote','ID_Lote');
                        $fecha_actual_detallada = date('Y-m-d H:i:s');

                    // Llenando Insumo_tiene_lote
                    $sql_itl = "INSERT INTO insumo_tiene_lote (ID_Insumo, ID_Lote, F_Registro_Lote) VALUES ('$id_insumo', '$id_lote', '$fecha_actual_detallada')";
                    $ejecutado_itl = mysqli_query($conex, $sql_itl);
                    if (!$ejecutado_itl) {
                        throw new Exception("Error al actualizar material en la tabla 'insumo_tiene_lote'" . mysqli_error($conex));
                    }
                }
            }
            catch (Exception $e){
                die($alert->sweetError("../visualizar-insumo.php","Error al guardar datos",$e->getMessage()));
            }


            die ($alert->sweetOK("../visualizar-insumo.php", "Se ha actualizado el insumo correctamente"));

?>
