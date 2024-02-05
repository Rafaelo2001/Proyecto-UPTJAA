<?php

    // REGISTRO DE INFORME DE BIOPSIA

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Registro Biopsia"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Cambiando la zona horaria
    date_default_timezone_set('America/Caracas');


    // Declarando las variables a utilizar, conectandolas con los datos recibidos de registro-informes (biopsia)
    /* 
        Orden de llenado
            1. F_entrada
            2. ID-medico
            3. Diagnostico
            4. Resumen            

            5. ID_M_Citologia (Pasar valor del ID de la tabla m_remitido???)

            6. Sitio Lesion
    */
    
        // TABLA: m_remitido
            $f_entrada   = date("Y-m-d H:i:s");
            $ci_paciente = $_POST['paciente'];
            $id_medico   = $_POST['medico'];
            $descripcion = $_POST['descripcion'];
            $resumen     = $_POST['resumen'];
            $diagnostico = $_POST['diagnostico'];
            
        // TABLA: m_biopsia
            $sitio_lesion = $_POST['sitio_lesion'];

        
        // ENVIANDO DATOS

            try {
                // Enviando M_REMITIDO
                $sql_m_remitido = "INSERT INTO m_remitido (ID_Medico, CI_Paciente, Descripcion_material, Diagnostico, Resumen, F_Entrada) VALUES ('$id_medico', '$ci_paciente', '$descripcion','$diagnostico', '$resumen', '$f_entrada')";
                $ejecutado_m_remitido = mysqli_query($conex,$sql_m_remitido);
                if (!$ejecutado_m_remitido) {
                    throw new Exception("Error al insertar en la tabla 'm_remitido'" . mysqli_error($conex));
                }

                    // Buscando ID_M_BIOPSIA
                    $id_m_remitido = $user->buscarONE('m_remitido','ID_M_Remitido','ID_M_Remitido');


                // Enviando M_BIOPSIA
                $sql_m_biopsia = "INSERT INTO m_biopsia (ID_M_Remitido, Sitio_lesion) VALUES ('$id_m_remitido', '$sitio_lesion')";
                $ejecutado_m_biopsia = mysqli_query($conex, $sql_m_biopsia);
                if (!$ejecutado_m_biopsia) {
                    throw new Exception("Error al insertar en la tabla 'm_biopsia'" . mysqli_error($conex));
                }       
            }
            catch (Exception $e){
                die($alert->sweetError("../registro-biopsia.php","Error al guardar datos",$e->getMessage()));
            }


            // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
            // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
            die ($alert->sweetOK("../registro-biopsia.php", "Los datos de la muestra se han insertado correctamente"));
            
?>
