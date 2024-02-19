<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id_m'] == ""){
        header('Location: ./detalles_muestras.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Edición de Muestra"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;    
    
    // Declarando las variables a utilizar
    $datosMuestra = $user->buscarSINGLE("m_remitido","ID_M_Remitido=".$_POST['id_m']);
        $datosMuestraActualizar = [];
        $sqlMuestraActualizar = "";

    if($_POST['tipo_m'] == "Biopsia"){
        $datosBiopsia = $user->buscarSINGLE("m_biopsia","ID_M_Remitido=".$_POST['id_m']);
        $sqlBiopsiaActualizar = "";
    }
    elseif($_POST['tipo_m'] == "Citología"){
        $datosCitologia = $user->buscarSINGLE("m_citologia","ID_M_Remitido=".$_POST['id_m']);
        $datosCitologiaActualizar = [];
        $sqlCitologiaActualizar = "";
    }    

// m_remitido
if ($_POST['des_m'] != $datosMuestra['Descripcion_material']) {
    $datosMuestraActualizar[] .= "`Descripcion_material` = '" . $_POST['des_m'] . "'";
}

if ($_POST['diag'] != $datosMuestra['Diagnostico']) {
    $datosMuestraActualizar[] .= "`Diagnostico` = '" . $_POST['diag'] . "'";
}

if ($_POST['resumen'] != $datosMuestra['Resumen']) {
    $datosMuestraActualizar[] .= "`Resumen` = '" . $_POST['resumen'] . "'";
}

if ($_POST['examinado'] != $datosMuestra['Examinado']) {
    $datosMuestraActualizar[] .= "`Examinado` = '" . $_POST['examinado'] . "'";
}

if ($_POST['f_ent'] != $datosMuestra['F_Entrada']) {
    $datosMuestraActualizar[] .= "`F_Entrada` = '" . $_POST['f_ent'] . "'";
}


            if($_POST['tipo_m'] == "Biopsia"){

                // m_biopsia
                    if($_POST['sitio'] != $datosBiopsia['Sitio_lesion']) {
                        $sqlBiopsiaActualizar = "`Sitio_lesion` = '".$_POST['sitio']."'";
                    }

            }
            elseif($_POST['tipo_m'] == "Citología"){

                // m_citologia
                    if($_POST['FUR'] != $datosCitologia['FUR']) {
                        $datosCitologiaActualizar[] .= "`FUR` = '".$_POST['FUR']."'";
                    }

    if (isset($_POST['endocervix']) xor $datosCitologia['Endocervix']) {
        $datosCitologiaActualizar[] .= "`Endocervix` = '" . $_POST['endocervix'] . "'";
    }

    if (isset($_POST['exocervix']) xor $datosCitologia['Exocervix']) {
        $datosCitologiaActualizar[] .= "`Exocervix` = '" . $_POST['exocervix'] . "'";
    }

    if (isset($_POST['vagina']) xor $datosCitologia['Vagina']) {
        $datosCitologiaActualizar[] .= "`Vagina` = '" . $_POST['vagina'] . "'";
    }

                    if(isset($_POST['otro_check'])) {
                        if($_POST['otro'] != $datosCitologia['Otros']) {
                            $datosCitologiaActualizar[] .= "`Otros` = '".$_POST['otro']."'";
                        }
                    }
                    else{
                        $datosCitologiaActualizar[] .= "`Otros` = 0";
                    }

            }
       

            if($datosMuestraActualizar || !empty($sqlBiopsiaActualizar) || !empty($datosCitologiaActualizar)){

                try {
                    if($datosMuestraActualizar){
                        for($i = 0; $i < count($datosMuestraActualizar); $i++){
                            if($i < count($datosMuestraActualizar)-1){
                            $sqlMuestraActualizar .= $datosMuestraActualizar[$i].", ";
                            }
                            else{
                                $sqlMuestraActualizar .= $datosMuestraActualizar[$i];
                            }
                        }
                    
                        // Actualizando M_REMITIDO
                        $ActSqlMuestra = "UPDATE `m_remitido` SET $sqlMuestraActualizar WHERE `m_remitido`.`ID_M_Remitido` = '".$_POST['id_m']."';";
                        $ejecutadoActMuestra = mysqli_query($conex,$ActSqlMuestra);
                        if (!$ejecutadoActMuestra) {
                            throw new Exception("Error al actualizar en la tabla M_Remitido: " . mysqli_error($conex));
                        }
                    }

                    if(!empty($sqlBiopsiaActualizar)){
                        // Actualizando M_BIOPSIA
                        $ActSqlBiopsia = "UPDATE `m_biopsia` SET $sqlBiopsiaActualizar WHERE `m_biopsia`.`ID_M_Remitido` = '".$_POST['id_m']."';";
                        $ejecutadoActBiopsia = mysqli_query($conex,$ActSqlBiopsia);
                        if (!$ejecutadoActBiopsia) {
                            throw new Exception("Error al actualizar en la tabla M_Biopsia: " . mysqli_error($conex));
                        }
                    }

                    if(!empty($datosCitologiaActualizar)){
                        for($i = 0; $i < count($datosCitologiaActualizar); $i++){
                            if($i < count($datosCitologiaActualizar)-1){
                            $sqlCitologiaActualizar .= $datosCitologiaActualizar[$i].", ";
                            }
                            else{
                                $sqlCitologiaActualizar .= $datosCitologiaActualizar[$i];
                            }
                        }

                        // Actualizando M_CITOLOGIA
                        $ActSqlCitologia = "UPDATE `m_citologia` SET $sqlCitologiaActualizar WHERE `m_citologia`.`ID_M_Remitido` = '".$_POST['id_m']."';";
                        $ejecutadoActCitologia = mysqli_query($conex,$ActSqlCitologia);
                        if (!$ejecutadoActCitologia) {
                            throw new Exception("Error al actualizar en la tabla M_Citologia: " . mysqli_error($conex));
                        }
                    }
                }
                catch (Exception $e){
                    die($alert->sweetError("./detalles_muestras.php","Error al guardar datos",$e->getMessage()));
                }

                die ($alert->sweetOK("./detalles_muestras.php", "Los datos se han actualizado correctamente"));
                
            }
            else{
                die ($alert->sweetWar("./detalles_muestras.php", "No se han introducidos datos para actualizar"));
            }
