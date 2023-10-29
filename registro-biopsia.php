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

            <label for="entry_date">Fecha de Entrada:</label>
            <input type="date" class="entry_date" name="entry_date" id="entry_date" placeholder="(dd/mm/aaaa)">

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

            <label for="resume">Resumen de Historia Clínica:</label>
            <input type="text" name="resume" id="resume" placeholder="Escriba el resumen">

                <br><br>

            <label for="diagnosis">Diagnóstico Clínico:</label>
            <input type="text" name="diagnosis" id="diagnosis" placeholder="Escriba el diagnóstico">

                <br><br>

            <label for="lession_site">Sitio de la Lesión:</label>
            <input type="text" name="lession_site" id="lession_site" placeholder="Indique">

                <br><br>

            <label for="obsevations">Observaciones:</label>
            <input type="text" name="obsevations" id="observations" placeholder="Indique la observacion">

                <br><br>

            <button type="submit">Registrar</button>
              
        </form>


    </body>
</html>