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

        <script src="js/jquery-3.7.1.js"></script>
    </head>

    <body>
        
        <h1>Registro de Citología</h1>

        <form action="#" method="post" class="form" id="form">

            <label for="f_entrada">Fecha de Entrada:</label>
            <input type="date" name="f_entrada" id="f_entrada">

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
            <input type="text" name="resumen" id="resumen" placeholder="Escriba el resumen">

                <br><br>
            
            <label for="diagnostico">Diagnóstico Clínico:</label>
            <input type="text" name="diagnostico" id="diagnostico" placeholder="Escriba el diagnóstico">

                <br><br>

            <label for="FUR">Fecha de la Última Regla (FUR):</label>
            <input type="date" name="FUR" id="FUR">

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
            
                <input type="checkbox" name="frotis" id="otro" value="otro">
                <label for="otro">Otro:</label>
                <input type="text" name="otro" id="otro_input" placeholder="Especifique" disabled>


                <br><br>

            <label for="diagnosis">Observaciones:</label>
            <input type="text" name="obsevations" id="observations" placeholder="Indique la observacion">

                <br><br>

            <button type="submit">Registrar</button>

        </form>

        <script src="js/form-citologia.js"></script>
    </body>
</html>