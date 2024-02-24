<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id'] == ""){
        header('Location: ./detalles_insumo.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Edición de Insumo"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Declarando las variables a utilizar
    $insumo = $user->buscarSINGLE("insumo", "ID_Insumo='" . $_POST['id'] . "'");
    $datosInsumoActualizar = [];
    $sqlInsumoActualizar = "";


    // Comprueba si los datos han sido modificado con respecto a su contraparte en la BDD
    // Si hay cambios, los guarda en una variable, sino los ignora

        // Insumo
            if ($_POST['material'] != $insumo['Material']) {
                $datosInsumoActualizar[] .= "`Material` = '" . $_POST['material'] . "'";
            }

            if ($_POST['unidades'] != $insumo['Unidades']) {
                $datosInsumoActualizar[] .= "`Unidades` = '" . $_POST['unidades'] . "'";
            }

            if ($_POST['existencia'] != $insumo['Existencia']) {
                $datosInsumoActualizar[] .= "`Existencia` = '" . $_POST['existencia'] . "'";
            }

            if ($_POST['minimo'] != $insumo['Cant_minima']) {
                $datosInsumoActualizar[] .= "`Cant_minima` = '" . $_POST['minimo'] . "'";
            }

            if ($_POST['con_biop'] != $insumo['Consumo_Biop']) {
                $datosInsumoActualizar[] .= "`Consumo_Biop` = '" . $_POST['con_biop'] . "'";
            }

            if ($_POST['con_cito'] != $insumo['Consumo_Cito']) {
                $datosInsumoActualizar[] .= "`Consumo_Cito` = '" . $_POST['con_cito'] . "'";
            }


    // Si hay cambios en el array, ejecuta el codigo de insercion
        if($datosInsumoActualizar){
            try {
                for($i = 0; $i < count($datosInsumoActualizar); $i++){
                    if($i < count($datosInsumoActualizar)-1){
                    $sqlInsumoActualizar .= $datosInsumoActualizar[$i].", ";
                    }
                    else{
                        $sqlInsumoActualizar .= $datosInsumoActualizar[$i];
                    }
                }
            
                // Actualizando Insumo
                $ActSqlInsumo = "UPDATE `insumo` SET $sqlInsumoActualizar WHERE `insumo`.`ID_Insumo` = '".$_POST['id']."';";
                if (!(mysqli_query($conex,$ActSqlInsumo))) {
                    throw new Exception("Error al actualizar en la tabla Insumo: " . mysqli_error($conex));
                }
            }
            catch (Exception $e){
                die($alert->sweetError("./detalles_insumo.php","Error al guardar datos",$e->getMessage()));
            }

            die ($alert->sweetOK("./detalles_insumo.php", "Los datos se han actualizado correctamente"));

        }
        else{
            die ($alert->sweetWar("./detalles_insumo.php", "No se han introducidos datos para actualizar"));
        }     
