<?php
        // agregar Mencion de seccion
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
    </head>

    <body>
        
        <h1>Registro de Biopsia</h1>

        <form action="#" method="post">

            <label for="f_entrada">Fecha de Entrada:</label>
            <input type="date" name="f_entrada" id="f_entrada" required>

                <br><br>

            <label for="medicos-bdd">Médico:</label>
            <select id="medicos-bdd" name="medico-bdd" required>
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


    </body>
</html>