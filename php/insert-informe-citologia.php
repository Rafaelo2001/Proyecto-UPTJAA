<?php

class BySearch
{
    // BUSCAR x BY
    // Utilizar esta funcion para extraer un valor de la BDD y utilizar en otras funciones
    // Esta funcion retorna el ultimo valor registrado en la tabla
    public function buscarBY($tabla, $columna)
    {
        $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
        if ($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }
}

// Conectando con la base de datos Higea
$conex = mysqli_connect("localhost", "root", "", "higea_db");

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
                1. ID_Medico *

            Tabla 'inf_citologia'
                7. ID_Inf_Citologia		- Buscar cual fue el ID del informe
                8. Calidad *		
                9. Categ_Gral	*
                10. Hallazgos *
                11. Conducta	
                10. ID_Examen   *
    */

// informe OK
$CIP             =  $_POST['paciente_id'];
$id_medico       =  $_POST['medico_id'];
$fecha           =  date("Y-m-d");
$des_m_remitido  =  $_POST['info_c'];
$diagnostico     =  $_POST['diag_c'];
$obs             =  $_POST['obs_c'];

// inf_citologia
$calidad    =  $_POST['calidad_c'];
$cat_gnral  =  $_POST['categ_c'];
$hallazgos  =  $_POST['hallazgos_c'];
$conducta   =  $_POST['conducta_c'];
$id_examen  =  $_POST['examen_id_c'];


// ENVIANDO DATOS

// Enviando 'informe'
$sql_informe = "INSERT INTO informe (Descripcion_M_Remitido, Diagnostico, Observacion, CIP, ID_Medico, Fecha) VALUES ('$des_m_remitido', '$diagnostico', '$obs', '$CIP', '$id_medico', '$fecha')";

$ejecutando_sql_informe = mysqli_query($conex, $sql_informe);
if (!$ejecutando_sql_informe) {
    throw new Exception("Error al insertar en la tabla Informe" . mysqli_error($conex));
}

// Busqueda del ID del Informe recien creado en $id_informe

$buscar_id_informe = new BySearch();
$buscar_id_informe->conexion = new mysqli("localhost", "root", "", "higea_db");
$resultado_id_informe = $buscar_id_informe->buscarBY('informe', 'ID_Informe');

foreach ($resultado_id_informe as $fila_id_informe) {
    $id_informe = $fila_id_informe['ID_Informe'];
}

// Enviando 'inf_citologia'
$sql_inf_c = "INSERT INTO inf_citologia (ID_Informe, Calidad, Categ_Gral, Hallazgos, Conducta, ID_Examen) VALUES ('$id_informe', '$calidad', '$cat_gnral', '$hallazgos', '$conducta', '$id_examen')";

$ejecutando_sql_inf_c = mysqli_query($conex, $sql_inf_c);
if (!$ejecutando_sql_inf_c) {
    throw new Exception("Error al insertar en la tabla inf_citologia" . mysqli_error($conex));
}

// Mostramos un mensaje de éxito utilizando una ventana emergente de alerta de JavaScript.
// Después de que el usuario haga clic en el botón "Aceptar", lo redirigimos a otra página.
echo "<script>
        alert('Los datos se han insertado correctamente.');
        window.location.href = '../registro-informes.php';
        </script>";
?>