<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if (!isset($_SESSION['username'])) {
        header('Location: ../index.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
        header('Location: ./gestion_usuarios.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    require '../php/permisos.php';

    $rol = $_SESSION['Rol'];

    $paginaActual = basename($_SERVER['PHP_SELF']);

    if (!in_array($paginaActual, $permisos[$rol])) {
        header('Location: ../sin_permiso.php', true, 303);

        exit();
    }

    // Busca los datos del usuario
        $id = $_POST['id'];
        $dataUsuario = $user->conexion->query("SELECT `Nombre`,`Rol`,`CIE` FROM `usuario` WHERE `ID_Usuario` = $id;") or die($this->conexion->error);
        $data = $dataUsuario->fetch_all(MYSQLI_ASSOC);
        $datosUsuario = $data[0];

        $cedula = $datosUsuario['CIE'];
        $datosPersona   = $user->buscarSINGLE("persona", "CI='$cedula'");
        $datosTelefono  = $user->buscarONE("telefono", "CI='$cedula'", "Nro_Telf");
        $datosCorreo    = $user->buscarONE("correo",  "CI='$cedula'", "Correo");

    // Determina si el usuario es hombre o mujer
        $its_a_boy = "";
        $its_a_girl = "";

        if ($datosPersona["Sexo"] == "M") {
            $its_a_boy = "checked";
            $its_a_girl = "";
        } elseif ($datosPersona["Sexo"] == "F") {
            $its_a_boy = "";
            $its_a_girl = "checked";
        }

    // Determina si el usuario es Administrador o Analista
        $rol_admin = "";
        $rol_analis = "";

        if ($datosUsuario["Rol"] == "admin") {
            $rol_admin = "checked";
            $rol_analis = "";
        } elseif ($datosUsuario["Rol"] == "analista") {
            $rol_admin = "";
            $rol_analis = "checked";
        }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Edición de Usuario (<?php echo ($_POST["id"]); ?>)</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles_higea.css">
    <link rel="stylesheet" type="text/css" href="../css/styles_higea.css?v=1.2">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link href="../css/select2.min.css" rel="stylesheet" />
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/select2.min.js"></script>

    <link href="../css/sweetalert2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css?v=1.2">
    <script src='../js/sweetalert2.all.min.js'></script>
</head>

<style>
    .swal2-popup {
        background: rgb(248, 255, 254);
        background: linear-gradient(135deg, rgba(248, 255, 254, 1) 0%, rgba(171, 255, 255, 1) 100%);
    }

    .boton-cancelar {
        border: none !important;
        outline: none !important;
        padding: 1px 20px !important;
        height: 40px !important;
        margin-top: 10px !important;
        background: linear-gradient(135deg, rgb(166, 166, 166) 0%, rgb(128, 128, 128) 100%) !important;
        color: #ffffff !important;
        font-size: 18px !important;
        border-radius: 20px !important;
        cursor: pointer !important;
        transition: background .2s !important;
        box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
        font-weight: 600 !important;
    }

    .boton-cancelar:hover {
        background: #4d4d4d !important;
    }

    .boton-borrar {
        border: none !important;
        outline: none !important;
        padding: 1px 20px !important;
        height: 40px !important;
        margin-top: 10px !important;
        background: linear-gradient(135deg, rgb(255, 33, 0) 0%, rgb(204, 0, 0) 100%) !important;
        color: #ffffff !important;
        font-size: 18px !important;
        border-radius: 20px !important;
        cursor: pointer !important;
        transition: background .2s !important;
        box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2) !important;
        font-weight: 600 !important;
    }

    .boton-borrar:hover {
        background: #b20000 !important;
    }

    .swal2-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>

<body class="login-register">
    <div class="sidebar close">
        <a href="../home.php">
			<div class="logo-details">
				<img class="logo" src="../images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
				<img class="logo_name" src="../images/Letras.png" alt="HIGEA" width="135" height="40">
			</div>
		</a>
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
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-file-invoice-dollar"></i>
						<span class="link_name">Facturación</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Facturación</a></li>
					<li><a href="../registro-pagos.php">Nueva Factura</a></li>
					<li><a href="../detalles/detalles_pagos.php">Lista de Facturas</a></li>
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
                        <i class="fi fi-sr-eye"></i>
                        <span class="link_name">Detalles</span>
                    </a>
                    <i class="fi fi-sr-angle-small-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Detalles</a></li>
                    <li><a href="../detalles/detalles_paciente.php">Pacientes</a></li>
                    <li><a href="../detalles/detalles_muestras.php">Muestras</a></li>
                    <li><a href="../detalles/detalles_insumo.php">Insumos</a></li>
                </ul>
            </li>
            <li>
                <a href="gestion_usuarios.php">
                    <i class="fi fi-sr-users-alt"></i>
                    <span class="link_name">Gestión de usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="gestion_usuarios.php">Gestión de usuarios</a></li>
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
                    <li><a href="../info_lab.php">Sobre el Lab.</a></li>
                    <li><a href="../info_higea.php">Sobre HIGEA</a></li>
                    <li><a href="../developers.php">Developers</a></li>
                    <li><a href="../ayuda.php">Ayuda</a></li>
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

        <!-- Formulario para la edicion de datos del Usuario -->
        <section class="form-register">
            <h1>Edición de Usuario:
                <?php echo $datosPersona["CI"] ?>
            </h1>
            <h4>Obligatorio (*).</h4>

            <form action="./insert_edit_usuario.php" method="post" class="form" id="form" autocomplete="off">

                <h2>Datos del Empleado</h2>

                <div class="grid">
                    <!--group: name1-->
                    <div class="form-group" id="group_name_patient1">
                        <div class="form-group-input">
                            <label for="pn">Primer Nombre (*)</label>
                            <input id="pn" name="pn" class="pn" type="text" maxlength="45" placeholder="Ingrese su primer nombre" value="<?php echo ($datosPersona["PN"]) ?>" required>
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
                            <input id="sn" name="sn" class="sn" type="text" maxlength="45" placeholder="Ingrese su segundo nombre" value="<?php echo ($datosPersona["SN"]) ?>">
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
                            <input id="tn" name="tn" class="tn" type="text" maxlength="45" placeholder="Ingrese su tercer nombre" value="<?php echo ($datosPersona["TN"]) ?>">
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
                            <input id="pa" name="pa" class="pa" type="text" maxlength="45" placeholder="Ingrese su primer apellido" value="<?php echo ($datosPersona["PA"]) ?>" required>
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
                            <input id="sa" name="sa" class="sa" type="text" maxlength="45" placeholder="Ingrese su segundo apellido" value="<?php echo ($datosPersona["SA"]) ?>">
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
                            <input id="f_nac" name="f_nac" class="f_nac" type="date" placeholder="(dd/mm/aaaa)" value="<?php echo ($datosPersona["F_nac"]) ?>" min="1900-01-01" required>
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                    </div>

                    <!-- Validacion de Fechas -->
                    <script>
                        var minima = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 *
                            60 * 1000);
                        minima.setFullYear(minima.getFullYear() - 40);
                        var fechaMinima = minima.toISOString().split('T')[0];
                        document.getElementById("f_nac").min = fechaMinima;


                        var maxima = new Date();
                        maxima.setFullYear(maxima.getFullYear() - 18);
                        var fechaMaxima = maxima.toISOString().split('T')[0];
                        document.getElementById("f_nac").max = fechaMaxima;
                    </script>
                </div>

                <div>
                    <label>Sexo (*)</label>
                    <div class="radio" id="sexo">
                        <input type="radio" name="sexo" id="masculino" value="M" <?php echo ($its_a_boy) ?> required>
                        <label for="masculino">Masculino</label>

                        <input type="radio" name="sexo" id="femenino" value="F" <?php echo ($its_a_girl) ?> required>
                        <label for="femenino">Femenino</label>
                    </div>
                </div>

                <div class="grid">
                    <!--group: tel-->
                    <div class="form-group" id="group_telf_patient">
                        <div class="form-group-input">
                            <label for="nro_telf">Número telefónico (*)</label>
                            <input id="nro_telf" name="nro_telf" class="nro_telf" type="tel" maxlength="12" placeholder="Ingrese su nro. telefónico" value="<?php echo ($datosTelefono) ?>" required>
                        </div>
                        <span class="form-input-error">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                            <p>El número telefónico debe tener 11 dígitos</p>
                        </span>
                    </div>

                    <!--group: e-mail-->
                    <div class="form-group" id="group_email_patient">
                        <div class="form-group-input">
                            <label for="correo">Correo electrónico (*)</label>
                            <input id="correo" name="correo" class="correo" type="email" placeholder="Ingrese su de email" value="<?php echo ($datosCorreo) ?>" required>
                        </div>
                        <span class="form-input-error">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                            <p>Formato incorrecto de e-mail: jhon123@example.com</p>
                        </span>
                    </div>
                </div>


                <h2>Datos de Usuario</h2>

                <div class="grid">
                    <!--group: username-->
                    <div class="form-group" id="group_username">
                        <div class="form-group-input">
                            <label for="usuario">Nombre de usuario (*)</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Ingrese su nombre de usuario" value="<?php echo ($datosUsuario["Nombre"]) ?>" autocomplete="off" required>
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>

                    <div>
                        <label>Tipo de usuario (*)</label>
                        <div class="radio" id="tipe">
                            <input type="radio" name="rol" id="admin" value="admin" <?php echo ($rol_admin) ?> required>
                            <label for="admin">Admin</label>
                            <br>
                            <input type="radio" name="rol" id="analista" value="analista" <?php echo ($rol_analis) ?> required>
                            <label for="analista">Analista</label>
                        </div>
                    </div>
                </div>

                <div class="button-container">
                    <div class="form__group form__group-btn-submit">
                        <input type="hidden" name="ci" value="<?php echo $cedula; ?>">
                        <input class="button-submit" type="submit" name="registrar" id="enviar" value="Aplicar cambios" disabled>
                    </div>
                    <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                </div>
            </form>


            <h2>Otras Acciones</h2>


            <!-- Envio de datos para edicion de usuario -->
            <div class="acciones">
                <div class="button-container">
                    <div class="form__group form__group-btn-submit">
                        <form action="../preguntas-seguridad.php" method="post"><input type="hidden" name="id" value="<?php echo ($id); ?>" required><input type="submit" value="Cambiar Contraseña"></form>
                    </div>
                    <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                </div>
            </div>

            <!-- Eliminar usuario -->
            <div class="button-container">
                <div class="form__group form__group-btn-submit">
                    <button class="buttom" id="borrar" value="<?php echo ($id); ?>">Eliminar Usuario</button>
                </div>
                <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
            </div>
    </main>

    <script>
		// Comprueba si el boton de la barra de navegacion fue precionado y muestra por completo el menu lateral
		let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>

</body>
<script>
    // Habilita o desabilita el boton de envio de formulario segun haya algun cambio en los datos del usuario  o no
    $(":input").change(function() {
        $("#enviar").prop("disabled", false);
    })
    $(":input").keypress(function() {
        $("#enviar").prop("disabled", false);
    })

    // Alert para eliminar usuario
    $("#borrar").click(function() {
        Swal.fire({
                title: '¿Éstas seguro?',
                html: '<b>Se eliminará por completo el usuario registrado</b>',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: 'Eliminar Usuario',
                cancelButtonText: 'Cancelar',
                customClass: {
                    denyButton: 'boton-borrar',
                    cancelButton: 'boton-cancelar',
                }
            })
            .then(
                (click) => {
                    if (click.isDenied) {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = './delete_usuario.php';

                        var campo = document.createElement('input');
                        campo.type = 'hidden';
                        campo.name = 'id';
                        campo.value = "<?php echo ($id) ?>";
                        form.appendChild(campo);

                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            );
    })
</script>

</html>