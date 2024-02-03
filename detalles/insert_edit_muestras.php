<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id_m'] == ""){
        header('Location: ./detalles_muestras.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

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
            if($_POST['des_m'] != $datosMuestra['Descripcion_material']) {
                $datosMuestraActualizar[] .= "`Descripcion_material` = '".$_POST['des_m']."'";
            }

            if($_POST['diag'] != $datosMuestra['Diagnostico']) {
                $datosMuestraActualizar[] .= "`Diagnostico` = '".$_POST['diag']."'";
            }

            if($_POST['resumen'] != $datosMuestra['Resumen']) {
                $datosMuestraActualizar[] .= "`Resumen` = '".$_POST['resumen']."'";
            }

            if($_POST['examinado'] != $datosMuestra['Examinado']) {
                $datosMuestraActualizar[] .= "`Examinado` = '".$_POST['examinado']."'";
            }

            if($_POST['f_ent'] != $datosMuestra['F_Entrada']) {
                $datosMuestraActualizar[] .= "`F_Entrada` = '".$_POST['f_ent']."'";
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

                    if(isset($_POST['endocervix']) xor $datosCitologia['Endocervix']) {
                        $datosCitologiaActualizar[] .= "`Endocervix` = '".$_POST['endocervix']."'";
                    }

                    if(isset($_POST['exocervix']) xor $datosCitologia['Exocervix']) {
                        $datosCitologiaActualizar[] .= "`Exocervix` = '".$_POST['exocervix']."'";
                    }

                    if(isset($_POST['vagina']) xor $datosCitologia['Vagina']) {
                        $datosCitologiaActualizar[] .= "`Vagina` = '".$_POST['vagina']."'";
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
       

            if($datosMuestraActualizar || $sqlBiopsiaActualizar || $datosCitologiaActualizar){

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

                if($sqlBiopsiaActualizar){
                    // Actualizando M_BIOPSIA
                    $ActSqlBiopsia = "UPDATE `m_biopsia` SET $sqlBiopsiaActualizar WHERE `m_biopsia`.`ID_M_Remitido` = '".$_POST['id_m']."';";
                    $ejecutadoActBiopsia = mysqli_query($conex,$ActSqlBiopsia);
                    if (!$ejecutadoActBiopsia) {
                        throw new Exception("Error al actualizar en la tabla M_Biopsia: " . mysqli_error($conex));
                    }
                }

                if($datosCitologiaActualizar){
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

                echo "<script>
                alert('Los datos se han insertado correctamente.');
                window.location.href = './detalles_muestras.php';
                </script>";
            }
            else{
                echo "<script>
                alert('no cambiaste nada pa');
                window.location.href = './detalles_muestras.php';
                </script>";
            }

            // UPDATE `persona` SET `PN` = 'MarlirioA', `SN` = 'AAAA', `PA` = 'Márquez', `Edad` = '50' WHERE `persona`.`CI` = 'V-5315064' AND `persona`.`ID_Direccion` = 2
            
                // Enviando PERSONA
                
                // $resultadoDireccion = $user->buscarBY('direccion','ID_Direccion');
                // foreach ($resultadoDireccion as $filaIdDireccion) {
                //     $idDireccion = $filaIdDireccion['ID_Direccion'];
                //     $sqlPersona = "INSERT INTO persona (CI, PN, SN, TN, PA, SA, F_nac, Edad, Sexo, ID_Direccion) VALUES ('$documento_id', '$nombre1_paciente', '$nombre2_paciente', '$nombre3_paciente', '$apellido1_paciente', '$apellido2_paciente', '$date_birth', '$edad', '$sexo', '$idDireccion')";
                //     $ejecutadoPersona = mysqli_query($conex,$sqlPersona);
                //     if (!$ejecutadoPersona) {
                //         throw new Exception("Error al insertar en la tabla Persona: " . mysqli_error($conex));
                //     }
                // }
                
                // // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
                // // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
                // echo "<script>
                // alert('Los datos se han insertado correctamente.');
                // window.location.href = './detalles_paciente.php';
                // </script>";

           
?>