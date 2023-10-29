<?php
        // agregar Mencion de seccion
    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Registro Citología</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        
        <h1>Registro de Citología</h1>

        <form action="#" method="post" class="form" id="form">

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

            <label for="fur_date">Fecha de la Última Regla (FUR):</label>
            <input type="date" name="fur_date" id="fur_date" placeholder="(dd/mm/aaaa)">

                <br><br>


            Frotis:            
                
                <input type="checkbox" name="frotis" id="endocervix" value="endocervix">
                <label for="endocervix">Endocervix</label>
                        
                <input type="checkbox" name="frotis" id="exocervix" value="exocervix">
                <label for="exocervix">Exocervix</label>
                     
                <input type="checkbox" name="frotis" id="vagina" value="vagina">
                <label for="vagina">Vagina</label>
                
                <!--
                    Aqui se puede hacer, 
                    o bien mandar la casilla de otros activada junto con el valor en el input text,
                    o que al seleccionar "otro" se habilite el input text
                -->
            
                <input type="checkbox" name="frotis" id="other" value="other">
                <label for="other">Otro:</label>
                <input type="text" name="other" id="other_input" placeholder="Especifique">


                <br><br>

            <label for="diagnosis">Observaciones:</label>
            <input type="text" name="obsevations" id="observations" placeholder="Indique la observacion">

                <br><br>

            <button type="submit">Registrar</button>

        </form>

    </body>
</html>