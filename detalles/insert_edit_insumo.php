<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id'] == ""){
        header('Location: ./detalles_insumo.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    $user = new CodeaDB();

    // Conectando con la base de datos Higea
    $conex = $user->conexion;    

    // Declarando las variables a utilizar
    $insumo = $user->buscarSINGLE("insumo","ID_Insumo='".$_POST['id']."'");
        $datosInsumoActualizar = [];
        $sqlInsumoActualizar = "";


        // Insumo
            if($_POST['material'] != $insumo['Material']) {
                $datosInsumoActualizar[] .= "`Material` = '".$_POST['material']."'";
            }

            if($_POST['unidades'] != $insumo['Unidades']) {
                $datosInsumoActualizar[] .= "`Unidades` = '".$_POST['unidades']."'";
            }

            if($_POST['existencia'] != $insumo['Existencia']) {
                $datosInsumoActualizar[] .= "`Existencia` = '".$_POST['existencia']."'";
            }

            if($_POST['minimo'] != $insumo['Cant_minima']) {
                $datosInsumoActualizar[] .= "`Cant_minima` = '".$_POST['minimo']."'";
            }

            if($_POST['con_biop'] != $insumo['Consumo_Biop']) {
                $datosInsumoActualizar[] .= "`Consumo_Biop` = '".$_POST['con_biop']."'";
            }

            if($_POST['con_cito'] != $insumo['Consumo_Cito']) {
                $datosInsumoActualizar[] .= "`Consumo_Cito` = '".$_POST['con_cito']."'";
            }


            if($datosInsumoActualizar){
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
            
                echo "<script>
                alert('Los datos se han insertado correctamente.');
                window.location.href = './detalles_insumo.php';
                </script>";
            }
            else{
                echo "<script>
                alert('no cambiaste nada pa');
                window.location.href = './detalles_insumo.php';
                </script>";
            }           
?>