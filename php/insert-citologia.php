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

            6.FUR
            7. Endocervix, Exocervix, Vagina, Otro
    */
    
        // TABLA: m_remitido
            $f_entrada   = date("Y-m-d H:i:s");
            $id_medico   = $_POST['medico'];
            $resumen     = $_POST['resumen'];
            $diagnostico = $_POST['diagnostico'];
            
        // TABLA: m_citologia
            $FUR        = $_POST['FUR'];
            $endocervix = ($_POST['endocervix'] == 'on')  ? 1 : 0;
            $exocervix  = ($_POST['exocervix']  == 'on')  ? 1 : 0;
            $vagina     = ($_POST['vagina']     == 'on')  ? 1 : 0;
            $otro       = (empty($_POST['otro'])) ? 0 : $_POST['otro'];
            $ID_Examen = 0;

        
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

            // Enviando M_CITOLOGIA
            $sql_m_citologia = "INSERT INTO m_citologia (ID_M_Citologia, FUR, Endocervix, Exocervix, Vagina, Otros, ID_Examen) VALUES ('$id_m_remitido', '$FUR', '$endocervix', '$exocervix', '$vagina', '$otro', '$ID_Examen')";
            $ejecutado_m_citologia = mysqli_query($conex,$sql_m_citologia);
            if (!$ejecutado_m_citologia) {
                throw new Exception("Error al insertar en la tabla 'm_citologia'" . mysqli_error($conex));
            }            

            // Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
            // Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
            echo "<script>
            alert('Los datos se han insertado correctamente.');
            window.location.href = '../home.php'; 
            </script>";      
?>