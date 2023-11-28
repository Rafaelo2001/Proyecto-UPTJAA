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
        <title>Registro de Biopsia</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="css/styles_nav.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>

    <body class="login-register">

        <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="home.php">
                        <i class="fi fi-rr-apps"></i>
                        <span class="link_name">Panel Principal</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="home.php">Panel Principal</a></li>
                        </ul>
                </li>
                <li>
                        <a href="patient_register.html">
                        <i class="fi fi-rr-procedures"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="patient_register.html">Pacientes</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-microscope"></i>
                                <span class="link_name">Muestras</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Muestras</a></li>
                        <li><a href="citology_register.html">Citología</a></li>
                        <li><a href="biopsia_register.html">Biopsia</a></li>
                        </ul>
                </li>
                <li>
                        <a href="supplies_register.html">
                        <i class="fi fi-rr-box-open-full"></i>
                        <span class="link_name">Insumos</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="supplies_register.html">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-file-circle-info"></i>
                                <span class="link_name">Detalles</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Detalles</a></li>
                        <li><a href="#">Pacientes</a></li>
                        <li><a href="display-samples.html">Muestras</a></li>
                        <li><a href="display-inventory.html">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="profile-details">
                        <a href="php/exit.php">
                                <i class="fi fi-rr-exit"></i>
                                <span class="link_name">Salir</span>
                        </a>
                        <ul class="sub-menu blank">
                                <li><a class="link_name" href="php/exit.php">Salir</a></li>
                        </ul>
                        </div>
                </li>
                </ul>
        </div>

        <main class="home-section">
                <div class="home-content">
                        <i class="fi fi-rr-menu-burger bx-menu"></i>
                </div>

                <section class="form-register">
                        <h1>REGISTRO DE BIOPSIA</h1>
                        <form action="php/insert-biopsia.php" method="post" class="form" id="form" autocomplete="off">

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


                                <div class="grid">
                                    <!--group: state-->
                                    <div class="form-group" id="group_state">
                                                <div id="medico_en_bdd">
                                                <label for="medico">Médico</label>
                                                    <select id="medico" name="medico" required>
                                                        <option value="" selected disabled>-- Selecciona Medico--</option>

                                                        <?php $listaMedicos = $user->buscar("medico","1"); ?>

                                                        <?php foreach($listaMedicos as $medico): ?>
                                                                <option value="<?php echo $medico['ID_Medico'] ?>"> <?php echo $medico['Nombre_Medico'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select> 

                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <br><br>

                                                <label for="descripcion">Descripcion Material Remitido: <small><i>obligatorio</i></small></label>
                                                <br>
                                                <textarea type="text" name="descripcion" id="descripcion" cols="40" rows="3" placeholder="Escriba una descripcion del material"></textarea>

                                        <!--group: name1-->
                                        <div class="form-group" id="group_name_patient1">
                                        <div class="form-group-input">
                                        <label for="resumen">Resumen de Historia Clínica</label>
                                        <input type="text" name="resumen" id="resumen" placeholder="Escriba el resumen" required>
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                        
                                        <!--group: name2-->
                                        <div class="form-group" id="group_name_patient2">
                                        <div class="form-group-input">
                                        <label for="diagnostico">Diagnóstico Clínico:</label>
                                        <input type="text" name="diagnostico" id="diagnostico" placeholder="Escriba el diagnóstico" required>
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                        
                                        <!--group: name3-->
                                        <div class="form-group" id="group_name_patient3">
                                        <div class="form-group-input">
                                        <label for="sitio_lesion">Sitio de la Lesión:</label>
                                        <input type="text" name="sitio_lesion" id="sitio_lesion" placeholder="Indique" required>
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                </div>
                                        
                                <div class="form-mess" id="form-mess">
                                <p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
                                </div>

                                <div class="button-container">
                                <div class="form__group form__group-btn-submit">
                                        <input class="button-submit" type="submit" name="registrar" id="registrar" value="Registrar">
                                </div>
                                <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                                </div>
                        </form>
                </section>
        </main>

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