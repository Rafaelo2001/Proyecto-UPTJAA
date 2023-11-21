<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Registro Biopsia</title>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>

    <body>
        
        <h1>Registro de Biopsia</h1>

        <form action="php/insert-biopsia.php" method="post" autocomplete="off">

        <label for="paciente">Paciente:</label>
                <select id="paciente" name="paciente" required>
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
                                    
                                    $cedula_formateada = number_format($cedula, 0, ',', '.');
                                    $cedula_a_mostrar = " - C.I.: $cedula_formateada";
                                    
                                    echo $nombre_completo, $cedula_a_mostrar;

                                endforeach; 
                            ?>
                        </option>

                    <?php endforeach; ?>
                </select>

                    <br><br>

            <label for="medico">Médico:</label>
            <select id="medico" name="medico" required>
                <option value="" selected disabled>-- Selecciona Medico--</option>

                <?php $listaMedicos = $user->buscar("medico","1"); ?>

                <?php foreach($listaMedicos as $medico): ?>
                        <option value="<?php echo $medico['ID_Medico'] ?>"> <?php echo $medico['Nombre_Medico'] ?></option>
                <?php endforeach; ?>
            </select>        

                <br><br>

            <label for="resumen">Resumen de Historia Clínica:</label>
            <input type="text" name="resumen" id="resumen" placeholder="Escriba el resumen" required>

                <br><br>

            <label for="diagnostico">Diagnóstico Clínico:</label>
            <input type="text" name="diagnostico" id="diagnostico" placeholder="Escriba el diagnóstico" required>

                <br><br>

            <label for="sitio_lesion">Sitio de la Lesión:</label>
            <input type="text" name="sitio_lesion" id="sitio_lesion" placeholder="Indique" required>

                <br><br>

            <!-- Observaciones no se encuentra en la BDD, asi que lo dejare comentado por ahora -->
            <!--
            <label for="obsevations">Observaciones:</label>
            <input type="text" name="obsevations" id="observations" placeholder="Indique la observacion">

                <br><br>
            -->

            <button type="submit">Registrar</button>
              
        </form>

        <script src="js/form-biopsia.js"></script>
    </body>
</html>