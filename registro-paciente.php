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
        <title>Registro Paciente</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="js/jquery-3.7.1.js"></script>
    </head>

    <body style="text-align: center;">
        
        <h1>Registro Paciente</h1>

        <form action="php/insert-patient.php" method="post" autocomplete="off">

            <label for="ci">Cédula:</label>
            <input id="ci" name="cedula" type="text" maxlength="11" required>
                        
                    <br><br>

            <label for="pn">Primer Nombre:</label>
            <input id="pn" name="pn" type="text" maxlength="45" required>
                
                    <br><br>

            <label for="sn">Segundo Nombre:</label>
            <input id="sn" name="sn" type="text" maxlength="45">
                
                    <br><br>

            <label for="tn">Tercer Nombre:</label>
            <input id="tn" name="tn" type="text" maxlength="45">
                
                    <br><br>

            <label for="pa">Primer Apellido:</label>
            <input id="pa" name="pa" type="text" maxlength="45" required>
                
                    <br><br>

            <label for="sa">Segundo Apellido:</label>
            <input id="sa" name="sa" type="text" maxlength="45">
                
                    <br><br>

            Sexo:
                        <br>
            <input id="masculino" name="sexo" type="radio" value="M" required>
            <label for="masculino">Masculino</label>
                <br>
            <input id="femenino" name="sexo" type="radio" value="F" required>
            <label for="femenino">Femenino</label>

                    <br><br>

            <label for="f_nac">Fecha de Nacimiento:</label>
            <input id="f_nac" name="f_nac" type="date" required>

                    <br><br>
                        <hr>
                    <br><br>

            <label for="tlfn">Número Telefónico:</label>
            <input id="tlfn" name="tlfn" type="tel" maxlength="12" required>

                    <br><br>

            <label for="email">Correo Electrónico:</label>
            <input id="email" name="correo" type="email">

                    <br><br>

            <label for="estados">Estados:</label>
            <select id="estados" name="estado" required>

                    <option value="" selected disabled>-- Seleccione Estado--</option>

                    <?php $listaEstados = $user->buscar("estado","1"); ?>

                    <?php foreach($listaEstados as $estado): ?>
                    <option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['nombre'] ?></option>
                    <?php endforeach; ?>

            </select>

                    <br><br>

            <label>Ciudades:</label>
            <select id="ciudades" name="ciudad" required>
                    <option value="" selected disabled>-- Seleccione Ciudad--</option>
            </select>

                    <br><br>

            <label>Municipio:</label>
            <select id="municipios" name="municipio" required>
                    <option value="" selected disabled>-- Seleccione Municipio--</option>
            </select>

                    <br><br>

            <label>Parroquias:</label>
            <select id="parroquias" name="parroquia" required>
                    <option value="" selected disabled>-- Seleccione Parroquia--</option>
            </select>

                    <br><br>

            <label for="localizacion">Localización:</label>
            <input id="localizacion" name="localizacion" maxlength="250">

                    <br><br>

            <label for="sector">Sector:</label>
            <input id="sector" name="sector" maxlength="60">

                    <br><br>

            <label for="calle">Calle:</label>
            <input id="calle" name="calle" maxlength="60">

                    <br><br>

            <label for="nro_casa">Nro. Casa:</label>
            <input id="nro_casa" name="nro_casa" maxlength="45">

                    <br><br>
                        <hr>
                    <br><br>

            <div id="medico_en_bdd">
                    <label for="medicos-bdd">Médico:</label>
                    <select id="medicos-bdd" name="medico-bdd" required>

                    <option value="" selected disabled>-- Selecciona Medico--</option>

                    <?php $listaMedicos = $user->buscar("medico","1"); ?>

                    <?php foreach($listaMedicos as $medico): ?>
                            <option value="<?php echo $medico['ID_Medico'] ?>"> <?php echo $medico['Nombre_Medico'] ?></option>
                    <?php endforeach; ?>

                    </select>
            </div>

            <div id="medico_nuevo" style="display: none;">
                    <label>Médico:</label>
                            <br>
                    <label for="nombre-medico-registro">Nombre Médico:</label>
                    <input id="nombre-medico-registro" name="nombre-medico-registro" type="text">
                            <br>
                    <label for="telefono-medico-registro">Telefono Médico:</label>
                    <input id="telefono-medico-registro" name="telefono-medico-registro" type="tel">

            </div>
                    <br>
            <input id="registro_medico" name="registro_medico_nuevo" type="checkbox">
            <label for="registro_medico">¿Médico no registrado?</label>
                    

                    <br><br>
                    <hr>
                    <br><br>

            <label for="obs">Observaciones:</label>
                    <br>
            <input id="obs" name="obs" type="text" maxlength="200">

                    <br><br>
                    <hr>
                    <br><br>

            <button type="submit">Registrar paciente</button>

        </form>
        
        
        <script src="js/form-paciente.js"></script>
    </body>
</html>