<?php

    class BySearch
    {
        // BUSCAR x BY
        // Utilizar esta funcion para extraer un valor de la BDD y utilizar en otras funciones
        // Esta funcion retorna el ultimo valor registrado en la tabla
        public function buscarBY($tabla, $columna)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }
    }
    
    // Conectando con la base de datos Higea
    $conex = mysqli_connect("localhost","root","","higea_db");

    // Cambiando la zona horaria
    date_default_timezone_set('America/Caracas');


    // Declarando las variables a utilizar, conectandolas con los datos recibidos de registro-citologia
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
            $id_medico   = $_POST['medico'];
            $resumen     = $_POST['resumen'];
            $diagnostico = $_POST['diagnostico'];
            
        // TABLA: m_citologia
            $sitio_lesion = $_POST['sitio_lesion'];
            $ID_Examen    = 0;

        
        // ENVIANDO DATOS

            // Enviando M_REMITIDO
            $sql_m_remitido = "INSERT INTO m_remitido (ID_Medico, Diagnostico, Resumen, F_Entrada) VALUES ('$id_medico', '$diagnostico', '$resumen', '$f_entrada')";
            $ejecutado_m_remitido = mysqli_query($conex,$sql_m_remitido);
            if (!$ejecutado_m_remitido) {
                throw new Exception("Error al insertar en la tabla 'm_remitido'" . mysqli_error($conex));
            }

                // Buscando ID_M_Citologia
                $buscar_id_m_remitido = new BySearch();
                $buscar_id_m_remitido->conexion = new mysqli("localhost","root","","higea_db");
                $resultado_id_m_remitido = $buscar_id_m_remitido->buscarBY('m_remitido','ID_M_Remitido');

                foreach ($resultado_id_m_remitido as $fila_id) {
                    $id_m_remitido = $fila_id['ID_M_Remitido'];
                }

            // Enviando M_BIOPSIA
            $sql_m_biopsia = "INSERT INTO m_biopsia (ID_M_Biopsia, Sitio_lesion, ID_Examen) VALUES ('$id_m_remitido', '$sitio_lesion', '$ID_Examen')";
            $ejecutado_m_biopsia = mysqli_query($conex, $sql_m_biopsia);
            if (!$ejecutado_m_biopsia) {
                throw new Exception("Error al insertar en la tabla 'm_biopsia'" . mysqli_error($conex));
            }            

            // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
            // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../registro-biopsia.php'; 
            </script>";      
?>