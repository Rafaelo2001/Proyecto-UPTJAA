<?php

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Registro de Informe Biopsia"));

    // Conectando con la base de datos Higea
    $conex = $user->conexion;

    // Declarando las variables a utilizar, conectandolas con los datos recibidos de registro-informe
    /* 
        Orden de llenado
            
            Tabla 'informe'
                ID_Informe 	- Esto es auto
                2. Fecha *	
                3. Descripcion_M_Remitido *
                4. Diagnostico	*	
                5. Observacion	*
                0. CIP	*
                1. ID_Medic*

            Tabla 'inf_biopsia'
                7. ID_Inf_Biopsia	- Buscar cual fue el ID del informe
                8. Desc_Macro	*
                9. Desc_Micro	*
                10. ID_Examen   *
    */

        // informe OK
            $CIP             =  $_POST['paciente_id'];
            $id_medico       =  $_POST['medico_id'];
            $fecha           =  date("Y-m-d");
            $des_m_remitido  =  $_POST['info_b'];
            $diagnostico     =  $_POST['diag_b'];
            $obs             =  $_POST['obs_b'];

        // inf_biopsia
            $des_macro = $_POST['des_macro_b'];
            $des_micro = $_POST['des_micro_b'];
            $id_examen = $_POST['examen_id_b'];

    
    // ENVIANDO DATOS

        try {
            // Enviando 'informe'
            $sql_informe = "INSERT INTO informe (Descripcion_M_Remitido, Diagnostico, Observacion, CIP, ID_Medico, Fecha) VALUES ('$des_m_remitido', '$diagnostico', '$obs', '$CIP', '$id_medico', '$fecha')";

            $ejecutando_sql_informe = mysqli_query($conex,$sql_informe);
            if (!$ejecutando_sql_informe) {
                throw new Exception("Error al insertar en la tabla Informe" . mysqli_error($conex));
            }

                // Busqueda del ID del Informe recien creado en $id_informe
                $id_informe = $user->buscarONE('informe','ID_Informe','ID_Informe');

            // Enviando 'inf_biopsia'
            $sql_inf_b = "INSERT INTO inf_biopsia (ID_Informe, Desc_Macro, Desc_Micro, ID_Examen) VALUES ('$id_informe', '$des_macro', '$des_micro', '$id_examen')";

            $ejecutando_sql_inf_b = mysqli_query($conex,$sql_inf_b);
            if (!$ejecutando_sql_inf_b) {
                throw new Exception("Error al insertar en la tabla inf_biopsia" . mysqli_error($conex));
            }        
        }
        catch (Exception $e){
            die($alert->sweetError("../registro-informes.php","Error al guardar datos",$e->getMessage()));
        }


        // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
        // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
        die ($alert->sweetOK("../registro-informes.php", "Se ha guardado el informe de biopsia correctamente"));

?>
