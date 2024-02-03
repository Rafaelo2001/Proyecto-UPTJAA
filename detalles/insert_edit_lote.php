<?php

    // if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id'] == "" || $_POST['id_lote'] == ""){
    //     header('Location: ./detalles_insumo.php', true, 303);
    //     exit;
    // }
    
    require "../php/conexion.php";
    $user = new CodeaDB();

    // Conectando con la base de datos Higea
    $conex = $user->conexion;    

    // // Declarando las variables a utilizar
    $id = $_POST['id'];
    $id_lote = $_POST['id_lote'];

    $lote = $user->buscarSINGLE("lote","ID_Lote='$id_lote'");
        $datosLoteActualizar = [];
        $sqlLoteActualizar = "";


        // Lote
            if($_POST['codigo'] != $lote['Codigo_Lote']) {
                $datosLoteActualizar[] .= "`Codigo_Lote` = '".$_POST['codigo']."'";
            }

            if($_POST['elaborado'] != $lote['F_Elab']) {
                $datosLoteActualizar[] .= "`F_Elab` = '".$_POST['elaborado']."'";
            }

            if($_POST['entrada'] != $lote['F_Entrada']) {
                $datosLoteActualizar[] .= "`F_Entrada` = '".$_POST['entrada']."'";
            }

            if($_POST['vencimiento'] != $lote['F_Exp']) {
                $datosLoteActualizar[] .= "`F_Exp` = '".$_POST['vencimiento']."'";
            }

            if($_POST['proveedor'] != $lote['Proveedor']) {
                $datosLoteActualizar[] .= "`Proveedor` = '".$_POST['proveedor']."'";
            }

            if($datosLoteActualizar){
                for($i = 0; $i < count($datosLoteActualizar); $i++){
                    if($i < count($datosLoteActualizar)-1){
                    $sqlLoteActualizar .= $datosLoteActualizar[$i].", ";
                    }
                    else{
                        $sqlLoteActualizar .= $datosLoteActualizar[$i];
                    }
                }
            
                // Actualizando Lote
                $ActSqlLote = "UPDATE `lote` SET $sqlLoteActualizar WHERE `lote`.`ID_Lote` = '$id_lote';";
                if (!(mysqli_query($conex,$ActSqlLote))) {
                    throw new Exception("Error al actualizar en la tabla Lote: " . mysqli_error($conex));
                }
             
                echo (
                    "<html><form></form></html>
                    
                    <script>
                        alert('Lote actualizado');
                        
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = './edit_insumo.php';
                        
                        var campo = document.createElement('input');
                        campo.type = 'hidden';
                        campo.name = 'id';
                        campo.value = '$id';
                        form.appendChild(campo);
                        
                        document.body.appendChild(form);
                        form.submit();
                    </script>"
                );
            }
            else{
                echo "<script>
                alert('no cambiaste nada pa');
                window.location.href = './detalles_insumo.php';
                </script>";
            }           
?>