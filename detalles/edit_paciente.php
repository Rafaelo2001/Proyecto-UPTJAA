<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: ../index.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['ci'] == ""){
        header('Location: ./detalles_paciente.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    $datosPaciente = $user->buscarBY("persona","CI='".$_POST['ci']."'");
    $datosTelefono = $user->buscarONE("telefono","CI='".$_POST['ci']."'","Nro_Telf");
    $datosCorreo = $user->buscarONE("correo","CI='".$_POST['ci']."'","Correo");

    $its_a_boy = "";
    $its_a_girl = "";

    if ($datosPaciente[0]["Sexo"] == "M"){
        $its_a_boy = "checked";
        $its_a_girl = "";
    }
    elseif($datosPaciente[0]["Sexo"] == "F"){
        $its_a_boy = "";
        $its_a_girl = "checked";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Edición de Paciente (<?php echo ($_POST["ci"]); ?>)</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/styles_higea.css">
        <link rel="stylesheet" type="text/css" href="../css/styles_higea.css?v=1.2">
        <link rel="icon" type="image/png" href="../images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
        <link href="../css/select2.min.css" rel="stylesheet"/>
        <script src="../js/jquery-3.7.1.js"></script>
        <script src="../js/select2.min.js"></script>

        <link href="../css/sweetalert2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css?v=1.2">
    </head>

    <body class="login-register">
    <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="../images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="../images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="../registro-paciente.php">
                        <i class="fi fi-sr-hospital-user"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="../registro-paciente.php">Pacientes</a></li>
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
                        <li><a href="../registro-citologia.php">Citología</a></li>
                        <li><a href="../registro-biopsia.php">Biopsia</a></li>
                        </ul>
                </li>
                <li>
                        <a href="../registro-examen.php">
                        <i class="fi fi-sr-flask"></i>
                        <span class="link_name">Exámenes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="../registro-examen.php">Exámenes</a></li>
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
                        <li><a href="../registro-insumo.php">Registrar</a></li>
                        <li><a href="../visualizar-insumo.php">Visualizar</a></li>
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
                        <li><a href="../registro-informes.php">Registrar</a></li>
                        <li><a href="../visualizar-informe.php">Visualizar</a></li>
                        </ul>
                </li>
                <li>
                        <a href="../registro-pagos.php">
                        <i class="fi fi-sr-file-invoice-dollar"></i>
                        <span class="link_name">Facturación</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="../registro-pagos.php">Facturación</a></li>
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
                        <li><a href="detalles_pacientes.php">Pacientes</a></li>
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
                        <li><a href="../info_lab.html">Sobre el Lab.</a></li>
                        <li><a href="../info_higea.html">Sobre HIGEA</a></li>
                        <li><a href="../developers.php">Developers</a></li>
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
                        <a href="../php/exit.php">
                                <i class="fi fi-sr-exit"></i>
                                <span class="link_name">Salir</span>
                        </a>
                        <ul class="sub-menu blank">
                                <li><a class="link_name" href="../php/exit.php">Salir</a></li>
                        </ul>
                        </div>
                </li>
                </ul>
        </div>

        <main class="home-section">

            <div class="home-content">
                <i class="fi fi-sr-menu-burger bx-menu"></i>
                <a href="../mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
            </div>

            <section class="form-register">
                <h1>Edición de Paciente: <?php echo $datosPaciente[0]["CI"] ?></h1>
                <h4>Obligatorio (*).</h4>

                <form action="./insert_edit_paciente.php" method="post" class="form" id="form" autocomplete="off">

                    <div class="grid">
                        <!--group: name1-->
                        <div class="form-group" id="group_name_patient1">
                            <div class="form-group-input">
                                <label for="pn">Primer Nombre (*)</label>
                                <input id="pn" name="pn" class="pn" type="text" maxlength="45" placeholder="Ingrese su primer nombre" value="<?php echo($datosPaciente[0]["PN"]) ?>" required>
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
                                <input id="sn" name="sn" class="sn" type="text" maxlength="45" placeholder="Ingrese su segundo nombre" value="<?php echo($datosPaciente[0]["SN"]) ?>">
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
                                <input id="tn" name="tn" class="tn" type="text" maxlength="45" placeholder="Ingrese su tercer nombre" value="<?php echo($datosPaciente[0]["TN"]) ?>">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: surname1-->
                        <div class="form-group" id="group_surname_patient1">
                            <div class="form-group-input">
                                <label for="pa">Primer Apellido (*)</label>
                                <input id="pa" name="pa" class="pa" type="text" maxlength="45" placeholder="Ingrese su primer apellido" value="<?php echo($datosPaciente[0]["PA"]) ?>" required>
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
                                <input id="sa" name="sa" class="sa" type="text" maxlength="45" placeholder="Ingrese su segundo apellido" value="<?php echo($datosPaciente[0]["SA"]) ?>">
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Rellene este campo correctamente</p>
                            </span>
                        </div>

                        <!--group: datebirth-->
                        <div class="form-group" id="group_date_birth">
                            <div class="form-group-input">
                                <label for="f_nac">Fecha de Nacimiento (*)</label>
                                <input id="f_nac" name="f_nac" class="f_nac" type="date" placeholder="(dd/mm/aaaa)" value="<?php echo($datosPaciente[0]["F_nac"]) ?>" min="1900-01-01" required>
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                            </div>
                            <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                        </div>

                        <script>
                                var hoy = new Date(new Date().getTime() + new Date().getTimezoneOffset()*60*1000 - 4*60*60*1000);
                                var fechaMaxima = hoy.toISOString().split('T')[0];
                                document.getElementById("f_nac").max = fechaMaxima;
                        </script>
                    </div>

                    <div>
                        <label>Sexo (*)</label>
                        <div class="radio" id="sexo">
                            <input type="radio" name="sexo" id="masculino" value="M" <?php echo($its_a_boy) ?> required>
                            <label for="masculino">Masculino</label>
                                
                            <input type="radio" name="sexo" id="femenino" value="F" <?php echo($its_a_girl) ?> required>
                            <label for="femenino">Femenino</label>
                        </div>
                    </div>


                    <div class="grid">
                        <!--group: tel-->
                        <div class="form-group" id="group_telf_patient">
                            <div class="form-group-input">
                                <label for="nro_telf">Número telefónico (*)</label>
                                <input id="nro_telf" name="nro_telf" class="nro_telf" type="tel" maxlength="12" placeholder="Ingrese su nro. telefónico" value="<?php echo($datosTelefono) ?>" required>
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>El número telefónico debe tener 11 dígitos</p>
                            </span>
                        </div>

                        <!--group: e-mail-->
                        <div class="form-group" id="group_email_patient">
                            <div class="form-group-input">
                                <label for="email">Correo electrónico (*)</label>
                                <input id="email" name="correo" class="correo" type="email" placeholder="Ingrese su de email" value="<?php echo($datosCorreo) ?>" required>
                            </div>
                            <span class="form-input-error">
                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                <p>Formato incorrecto de e-mail: jhon123@example.com</p>
                            </span>
                        </div>
                    </div>

                    <div class="button-container">
                        <div class="form__group form__group-btn-submit">
                            <input type="hidden" name="ci" value="<?php echo $_POST['ci']; ?>">
                            <input class="button-submit" type="submit" name="registrar" id="enviar" value="Aplicar cambios" disabled>
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
    </body>
    <script>
        $(":input").change(function(){
            $("#enviar").prop("disabled", false);
        })
        $(":input").keypress(function(){
            $("#enviar").prop("disabled", false);
        })
    </script>
</html>