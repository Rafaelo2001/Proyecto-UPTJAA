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
        <link rel="stylesheet" href="css/styles_higea.css">
        <link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
        <link href="css/select2.min.css" rel="stylesheet"/>
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>

        <link href="css/sweetalert2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css?v=1.2">
    </head>

    <body class="login-register">
    <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="registro-paciente.php">
                        <i class="fi fi-sr-hospital-user"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-paciente.php">Pacientes</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-microscope"></i>
                                <span class="link_name">Muestras</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Muestras</a></li>
                        <li><a href="registro-citologia.php">Citología</a></li>
                        <li><a href="registro-biopsia.php">Biopsia</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-examen.php">
                        <i class="fi fi-sr-flask"></i>
                        <span class="link_name">Exámenes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-examen.php">Exámenes</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-box-open-full"></i>
                                <span class="link_name">Insumos</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Insumos</a></li>
                        <li><a href="registro-insumo.php">Registrar</a></li>
                        <li><a href="visualizar-insumo.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-file-medical-alt"></i>
                                <span class="link_name">Informes médicos</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Informes médicos</a></li>
                        <li><a href="registro-informes.php">Registrar</a></li>
                        <li><a href="visualizar-informe.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-pagos.php">
                        <i class="fi fi-sr-file-invoice-dollar"></i>
                        <span class="link_name">Facturación</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-pagos.php">Facturación</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-eye"></i>
                                <span class="link_name">Detalles</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Detalles</a></li>
                        <li><a href="#">Pacientes</a></li>
                        <li><a href="#">Muestras</a></li>
                        <li><a href="#">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-sr-info"></i>
                                <span class="link_name">Acerca de</span>
                        </a>
                        <i class="fi fi-sr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Acerca de</a></li>
                        <li><a href="#">Sobre HIGEA</a></li>
                        <li><a href="developers.php">Developers</a></li>
                        <li><a href="#">Ayuda</a></li>
                        </ul>
                </li>
                <li>
                        <a href="#">
                        <i class="fi fi-sr-users-alt"></i>
                        <span class="link_name">Gestión de usuarios</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Gestión de usuarios</a></li>
                        </ul>
                </li>
                <li>
                        <div class="profile-details">
                        <a href="php/exit.php">
                                <i class="fi fi-sr-exit"></i>
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
                        <i class="fi fi-sr-menu-burger bx-menu"></i>
                        <a href="mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
                </div>

                <section class="form-register">
                        <h1>REGISTRO DE BIOPSIA</h1>
                        <form action="php/insert-biopsia.php" method="post" class="form" id="form" autocomplete="off">

                        <label for="paciente">Paciente:</label>
                                <select id="paciente" name="paciente" style="min-width: 100px;" required>
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

                                        <label for="descripcion">Descripcion Material Remitido: <small><i>obligatorio</i></small></label>
                                        <br>
                                        <textarea type="text" name="descripcion" id="descripcion" cols="40" rows="3" placeholder="Escriba una descripcion del material"></textarea>


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
                                        <label for="diagnostico">Diagnóstico Clínico</label>
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
                                        <label for="sitio_lesion">Sitio de la Lesión</label>
                                        <input type="text" name="sitio_lesion" id="sitio_lesion" placeholder="Indique" required>
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                </div>
                                 
                                <!--
                                <div class="form-mess" id="form-mess">
                                <p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
                                </div>
                                -->

                                <div class="button-container">
                                <div class="form__group form__group-btn-submit">
                                        <input class="button-submit" type="submit" name="registrar" id="registrar" value="Registrar">
                                </div>
                                <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                                </div>
                        </form>
                </section>
        </main>

        <script src="js/sweetalert2.all.min.js?v=1.2"></script>

        <script src="js/form-biopsia.js"></script>
    </body>
</html>