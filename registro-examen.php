<?php
    // session_start();
    // header('Cache-Control: no-cache, no-store, must-revalidate');
    // header('Pragma: no-cache');
    // header('Expires: 0');

    // if(!isset($_SESSION['username'])) {
    //     header('Location: index.php');
    //     exit;
    // }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Examenes</title>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>
    <body>
        <h1>REGISTRO DE EXAMENES</h1>

        <form action="php/insert-examen.php" method="post"> 

            <label for="paciente">Paciente:</label>
            <select id="paciente" name="paciente" style="min-width: 200px;" required>
                <option></option>

                <?php $listaPacientes = $user->buscar("paciente","1"); ?>

                <?php foreach($listaPacientes as $cedula_paciente): ?>

                        <option value="<?php echo $cedula_paciente['CIP'] ?>">
                        <?php
                                $cedula = $cedula_paciente['CIP'];
                                $ci_sql = "CI = '$cedula';";
                                
                                $pacientes = $user->buscar("persona", $ci_sql); 
                                foreach($pacientes as $paciente): 
                                    
                                    $nombre_completo = $paciente['PN'] ." ". $paciente['SN'] ." ". $paciente['TN'] ." ". $paciente['PA'] ." ". $paciente['SA']; 
                                    
                                    list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
                                    $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
                                    $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

                                    $cedula_a_mostrar = " - C.I.: $cedula_formateada";
                                    
                                    echo $nombre_completo, $cedula_a_mostrar;

                                endforeach; 
                        ?>
                        </option>

                <?php endforeach; ?>
            </select>

                <br><br>

            <label for="fecha">Fecha del Examen:</label>
            <input type="date" placeholder="dd/mm/aaaa" name="fecha" required id="fecha">
                
                <br><br>
        
            <label>Tipo de Examen:</label>
                <input type="radio" name="tipo_examen" id="tipo1" value="biopsia" required><label for="tipo1">Biopsia</label>
                <input type="radio" name="tipo_examen" id="tipo2" value="citologia"><label for="tipo2">Citología</label>
            
                <br><br>

            <p id="texto">Seleccione Paciente y Tipo de Examen</p>
            <section id="biopsia" style="display: none;">
                <label for="m_remitido_b">Material a Examinar:</label>
                <select name="m_remitido" id="m_remitido_b" disabled>
                    <option value="">Seleccione Paciente</option>
                </select>
            </section>

            <section id="citologia" style="display: none;">
                <label for="m_remitido_c">Material a Examinar:</label>
                <select name="m_remitido" id="m_remitido_c" disabled>
                    <option value="">Seleccione Paciente</option>
                </select>
            </section>

                <br>
            
            <label for="obs">Observaciones: </label>
            <input type="text" id="obs" name="obs">

                <br><br>

            <input type="submit" value="Registrar Examen">
        </form>

    </body>
    <script src="js/form-examen.js"></script>
</html>