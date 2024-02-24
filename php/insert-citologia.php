<?php

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Registro Citología"));

    $conex = $user->conexion;

    // Cambiando la zona horaria
    date_default_timezone_set('America/Caracas');


    // Declarando las variables a utilizar, conectandolas con los datos recibidos de registro-citologia
    /* 
        Orden de llenado
            1. F_entrada
            2. ID-medico
            3. Diagnostico
            4. Resumen            

            5. ID_M_Citologia

            6.FUR
            7. Endocervix, Exocervix, Vagina, Otro
    */
        
            // TABLA: m_remitido
                $f_entrada   = date("Y-m-d H:i:s");
                $ci_paciente = $_POST['paciente'];
                $id_medico   = $_POST['medico'];
                $descripcion = $_POST['descripcion'];
                $resumen     = $_POST['resumen'];
                $diagnostico = $_POST['diagnostico'];
                
            // TABLA: m_citologia
                $FUR        = $_POST['FUR'];
                $endocervix = (isset($_POST['endocervix']))  ? 1 : 0;
                $exocervix  = (isset($_POST['exocervix']))  ? 1 : 0;
                $vagina     = (isset($_POST['vagina']))  ? 1 : 0;
                $otro       = (empty($_POST['otro']))  ? 0 : $_POST['otro'];


    // ENVIANDO DATOS

        try {
            // Enviando M_REMITIDO
            $sql_m_remitido = "INSERT INTO m_remitido (ID_Medico, CI_Paciente, Descripcion_material, Diagnostico, Resumen, F_Entrada) VALUES ('$id_medico', '$ci_paciente', '$descripcion', '$diagnostico', '$resumen', '$f_entrada')";
            $ejecutado_m_remitido = mysqli_query($conex,$sql_m_remitido);
            if (!$ejecutado_m_remitido) {
                throw new Exception("Error al insertar en la tabla 'm_remitido'" . mysqli_error($conex));
            }

                // Buscando ID_M_Citologia
                $id_m_remitido = $user->buscarONE('m_remitido','ID_M_Remitido','ID_M_Remitido');
                

            // Enviando M_CITOLOGIA
            $sql_m_citologia = "INSERT INTO m_citologia (ID_M_Remitido, FUR, Endocervix, Exocervix, Vagina, Otros) VALUES ('$id_m_remitido', '$FUR', '$endocervix', '$exocervix', '$vagina', '$otro')";
            $ejecutado_m_citologia = mysqli_query($conex,$sql_m_citologia);
            if (!$ejecutado_m_citologia) {
                throw new Exception("Error al insertar en la tabla 'm_citologia'" . mysqli_error($conex));
            }            
        }
        catch (Exception $e){
            die($alert->sweetError("../registro-citologia.php","Error al guardar datos",$e->getMessage()));
        }

        // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
        // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
        die ($alert->sweetOK("../registro-citologia.php", "Los datos de la muestra se han insertado correctamente"));
