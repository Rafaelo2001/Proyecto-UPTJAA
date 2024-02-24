<?php

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id'] == "" || $_POST['id_lote'] == ""){
        header('Location: ./detalles_insumo.php', true, 303);
        exit;
    }
    
    require "../php/conexion.php";
    require "../php/sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Edición de Lote"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // // Declarando las variables a utilizar
    $id = $_POST['id'];
    $id_lote = $_POST['id_lote'];

    // Busca datos del lote en la BDD
        $lote = $user->buscarSINGLE("lote", "ID_Lote='$id_lote'");

    // Crea dos arrays para almacenar los nuevos datos
        $datosLoteActualizar = [];
        $sqlLoteActualizar = "";



    // Comprueba si los datos han sido modificado con respecto a su contraparte en la BDD
    // Si hay cambios, los guarda en una variable, sino los ignora

       // Lote
        if ($_POST['codigo'] != $lote['Codigo_Lote']) {
            $datosLoteActualizar[] .= "`Codigo_Lote` = '" . $_POST['codigo'] . "'";
        }

        if ($_POST['elaborado'] != $lote['F_Elab']) {
            $datosLoteActualizar[] .= "`F_Elab` = '" . $_POST['elaborado'] . "'";
        }

        if ($_POST['entrada'] != $lote['F_Entrada']) {
            $datosLoteActualizar[] .= "`F_Entrada` = '" . $_POST['entrada'] . "'";
        }

        if ($_POST['vencimiento'] != $lote['F_Exp']) {
            $datosLoteActualizar[] .= "`F_Exp` = '" . $_POST['vencimiento'] . "'";
        }

        if ($_POST['proveedor'] != $lote['Proveedor']) {
            $datosLoteActualizar[] .= "`Proveedor` = '" . $_POST['proveedor'] . "'";
        }

        // Si hay cambios en alguno de los array, ejecuta el siguiente codigo
        if($datosLoteActualizar){
            for($i = 0; $i < count($datosLoteActualizar); $i++){
                if($i < count($datosLoteActualizar)-1){
                $sqlLoteActualizar .= $datosLoteActualizar[$i].", ";
                }
                else{
                    $sqlLoteActualizar .= $datosLoteActualizar[$i];
                }
            }
        
            try {
                // Actualizando Lote
                $ActSqlLote = "UPDATE `lote` SET $sqlLoteActualizar WHERE `lote`.`ID_Lote` = '$id_lote';";
                if (!(mysqli_query($conex,$ActSqlLote))) {
                    throw new Exception("Error al actualizar en la tabla Lote: " . mysqli_error($conex));
                }
            }
            catch (Exception $e){
                // Si hay una exception, suelta un alert
                $html =  'html: "'.str_replace('"',"'",$e->getMessage()).'",';
                die (
                    "   <script>
                            Swal.fire({
                                title: 'Error al guardar datos',
                                $html
                                icon: 'error',
                                timer: 10000,
                                confirmButtonText: 'Regresar',
                                customClass: {
                                    confirmButton: 'boton-higea',
                                }
                            })
                            .then(
                                (click) => {
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
                                }
                            );
                        </script>
                    </html>"
                );
            }

            // Si se almacenaron los cambios correctamente, suelta un alert
            die (
                "   <script>
                        Swal.fire({
                            title: 'Lote actualizado',
                            icon: 'success',
                            timer: 10000,
                            confirmButtonText: 'Regresar',
                            customClass: {
                                confirmButton: 'boton-higea',
                            }
                        })
                        .then(
                            (click) => {
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
                            }
                        );
                    </script>
                </html>"
            );
        }
        else{
            // Si no se realizaron cambios, muestra un alert acorde
            die (
                "   <script>
                        Swal.fire({
                            title: 'No se han introducidos datos para actualizar',
                            icon: 'warning',
                            timer: 15000,
                            confirmButtonText: 'Regresar',
                            customClass: {
                                confirmButton: 'boton-higea',
                            }
                        })
                        .then(
                            (click) => {
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
                            }
                        );
                    </script>
                </html>"
            );
        }           
