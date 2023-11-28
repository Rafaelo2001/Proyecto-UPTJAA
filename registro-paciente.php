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
        <link rel="stylesheet" href="css/styles_nav.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <script src="js/jquery-3.7.1.js"></script>
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
                        <h1>REGISTRO DE PACIENTE</h1>
                        <form action="php/insert-patient.php" method="post" class="form" id="form" autocomplete="off">

                                <h2>INFORMACIÓN PRINCIPAL:</h2>
                                <div class="grid">
                                        <!--group: ci-->
                                        <div class="form-group" id="group_ci_patient">
                                        <div class="form-group-input">
                                                <label for="ci">Cédula de identidad</label>
                                                <input id="ci" name="cedula" class="cedula" type="text" maxlength="11" required placeholder="Ingrese su cédula">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>La cédula debe contener entre 6-8 caracteres, solo puede contener números</p>
                                        </span>
                                        </div>
                
                                        <!--group: name1-->
                                        <div class="form-group" id="group_name_patient1">
                                        <div class="form-group-input">
                                                <label for="pn">Primer Nombre</label>
                                                <input id="pn" name="pn" class="pn" type="text" maxlength="45" required placeholder="Ingrese su primer nombre">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                        
                                        <!--group: name2-->
                                        <div class="form-group" id="group_name_patient2">
                                        <div class="form-group-input">
                                                <label for="sn">Segundo Nombre</label>
                                                <input id="sn" name="sn" class="sn" type="text" maxlength="45" placeholder="Ingrese su segundo nombre">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                        
                                        <!--group: name3-->
                                        <div class="form-group" id="group_name_patient3">
                                        <div class="form-group-input">
                                                <label for="tn">Tercer Nombre</label>
                                                <input id="tn" name="tn" class="tn" type="text" maxlength="45" placeholder="Ingrese su tercer nombre">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                
                                        <!--group: surname1-->
                                        <div class="form-group" id="group_surname_patient1">
                                        <div class="form-group-input">
                                                <label for="pa">Primer Apellido</label>
                                                <input id="pa" name="pa" class="pa" type="text" maxlength="45" required placeholder="Ingrese su primer apellido">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                                        
                                        <!--group: surname2-->
                                        <div class="form-group" id="group_surname_patient2">
                                        <div class="form-group-input">
                                                <label for="sa">Segundo Apellido</label>
                                                <input id="sa" name="sa" class="sa" type="text" maxlength="45" placeholder="Ingrese su segundo apellido">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Rellene este campo correctamente</p>
                                        </span>
                                        </div>
                
                                        <!--group: datebirth-->
                                        <div class="form-group" id="group_date_birth">
                                        <div class="form-group-input">
                                        <label for="f_nac">Fecha de Nacimiento</label>
                                        <input id="f_nac" name="f_nac" class="f_nac" type="date" required placeholder="(dd/mm/aaaa)">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                        </div>
                                        <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                                        </div>
                                        
                                        <div>
                                                <label>Sexo</label>
                                                <div class="radio" id="sexo">
                                                        <input type="radio" name="sexo" id="masculino" value="M">
                                                        <label for="masculino">Masculino</label>
                                                        <br>
                                                        <input type="radio" name="sexo" id="femenino" value="F">
                                                        <label for="femenino">Femenino</label>
                                                </div>
                                        </div>
                                </div>

                                <h2>INFORMACIÓN DE CONTACTO:</h2>
                                <div class="grid">
                                        <!--group: tel-->
                                        <div class="form-group" id="group_telf_patient">
                                        <div class="form-group-input">
                                                <label for="tlfn">Número telefónico</label>
                                                <input id="tlfn" name="tlfn" class="tlfn" type="tel" maxlength="12" required placeholder="Ingrese su nro. telefónico">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>El número telefónico debe tener 11 dígitos</p>
                                        </span>
                                        </div>
                
                                        <!--group: e-mail-->
                                        <div class="form-group" id="group_email_patient">
                                        <div class="form-group-input">
                                                <label for="email">Correo electrónico</label>
                                                <input id="email" name="correo" class="correo" type="email" placeholder="Ingrese su de email">
                                        </div>
                                        <span class="form-input-error">
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                <p>Formato incorrecto de e-mail: jhon123@example.com</p>
                                        </span>
                                        </div>
                                </div>

                                <h2>INFORMACIÓN DE DIRECCIÓN:</h2>
                                <div class="grid">
                                        <!--group: state-->
                                        <div class="form-group" id="group_state">
                                                <div class="form-group-input">
                                                        <label for="estados">Estado</label>
                                                        <select id="estados" name="estado" required>

                                                                <option value="" selected disabled>-- Seleccione Estado--</option>

                                                                <?php $listaEstados = $user->buscar("estado","1"); ?>

                                                                <?php foreach($listaEstados as $estado): ?>
                                                                <option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['nombre'] ?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: city-->
                                        <div class="form-group" id="group_city">
                                                <div class="form-group-input">
                                                        <label for="ciudad">Ciudad</label>
                                                        <select id="ciudades" name="ciudad" required>
                                                                <option value="" selected disabled>-- Seleccione Ciudad--</option>
                                                        </select>
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: municipality-->
                                        <div class="form-group" id="group_municipality">
                                                <div class="form-group-input">
                                                        <label for="municipio">Municipio</label>
                                                        <select id="municipios" name="municipio" required>
                                                                <option value="" selected disabled>-- Seleccione Municipio--</option>
                                                        </select>
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: parish-->
                                        <div class="form-group" id="group_parish">
                                                <div class="form-group-input">
                                                        <label for="parroquia">Parroquia</label>
                                                        <select id="parroquias" name="parroquia" required>
                                                                <option value="" selected disabled>-- Seleccione Parroquia--</option>
                                                        </select>
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: location-->
                                        <div class="form-group" id="group_location">
                                                <div class="form-group-input">
                                                        <label for="localizacion">Localización</label>
                                                        <input type="text" id="localizacion" name="localizacion" maxlength="250" placeholder="Ingrese su localización">
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: sector-->
                                        <div class="form-group" id="group_sector">
                                                <div class="form-group-input">
                                                        <label for="sector">Sector</label>
                                                        <input type="text" id="sector" name="sector" maxlength="60" placeholder="Ingrese su sector">
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: street-->
                                        <div class="form-group" id="group_street">
                                                <div class="form-group-input">
                                                        <label for="calle">Calle</label>
                                                        <input type="text" id="calle" name="calle" maxlength="60" placeholder="Ingrese su calle">
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>

                                        <!--group: house-->
                                        <div class="form-group" id="group_house">
                                                <div class="form-group-input">
                                                        <label for="nro_casa">Número de casa</label>
                                                        <input type="text" id="nro_casa" name="nro_casa" maxlength="45" placeholder="Ingrese su nro. de casa">
                                                </div>
                                                <span class="form-input-error">
                                                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                                        <p>Rellene este campo correctamente</p>
                                                </span>
                                        </div>
                                </div>

                                <h2>INFORMACIÓN DE MÉDICO:</h2>
                                <div class="grid">
                                        <!--group: state-->
                                        <div class="form-group" id="group_state">
                                                <div id="medico_en_bdd">
                                                        <label for="medicos-bdd">Médico</label>
                                                        <select id="medicos-bdd" name="medico-bdd" required>
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

                                        <div>
                                                <div class="checkbox" id="registro_medico_nuevo">
                                                        <input id="registro_medico" name="registro_medico_nuevo" type="checkbox">
                                                        <label for="registro_medico">¿Médico no registrado?</label>
                                                </div>
                                        </div>

                                        <div id="medico_nuevo" style="display: none;">

                                                <label for="nombre-medico-registro">Nombre Médico</label>
                                                <input id="nombre-medico-registro" name="nombre-medico-registro" type="text">
                                                        
                                                <label for="telefono-medico-registro">Teléfono Médico</label>
                                                <input id="telefono-medico-registro" name="telefono-medico-registro" type="tel">
                                        </div>

                                        <div id="observaciones">
                                                <label for="obs">Observaciones</label>
                                                <input id="obs" name="obs" type="text" maxlength="200">
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
        
        <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
          arrow[i].addEventListener("click", (e)=>{
         let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
         arrowParent.classList.toggle("showMenu");
          });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("close");
        });
        </script>

        <script src="js/form-paciente.js"></script>
    </body>
</html>