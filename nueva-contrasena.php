<?php
    include "php/conexion.php";
    $user = new CodeaDB();

    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }

    // Incluye el archivo de permisos
    require 'php/permisos.php';

    // Obtiene el rol del usuario de la variable de sesión
    $rol = $_SESSION['Rol'];

    // Obtiene el nombre de la página actual
    $paginaActual = basename($_SERVER['PHP_SELF']);

    // Verifica si el usuario tiene permiso para acceder a la página actual
    if (!in_array($paginaActual, $permisos[$rol])) {
        header('Location: ./sin_permiso.php', true, 303);

        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
		.password-wrapper {
            position: relative;
            display: inline-block; /* Asegúrate de que el contenedor sea en línea para que no ocupe todo el ancho */
        }

        .toggle-password {
            position: absolute;
            right: 10px; /* Ajusta este valor para mover el botón a la derecha */
            top: 7px; /* Centra el botón verticalmente */
            border: none;
            background: none;
            cursor: pointer;
        }

        .toggle-password i {
            font-size: 22px;
            color: #003971;
        }

		/* Para Google Chrome */
		input[type="password"]::-webkit-inner-spin-button,
		input[type="password"]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		input[type="password"]::-webkit-input-password-eye {
			display: none;
		}

		/* Para Mozilla Firefox */
		input[type="password"]::-ms-reveal,
		input[type="password"]::-ms-clear {
			display: none;
		}

        .login-box-pass input[type="password"],
        .login-box-pass input[type="text"]:not([type="password"]) {
            border: none;
            border-bottom: 3px solid rgba(254, 101, 0, 1);
            background-color: #F2F2F2;
            outline: none;
            height: 40px;
            color: #0D0D0D;
            font-size: 16px;
            border-radius: 10px;
            box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2);
        }

        .toggle-password:hover {
            background: none;
        }
	</style>
</head>

<body class="login-register">
    <header>
        <nav>
            <a class="title">
                <img src="images/Logo con contorno.png" alt="Logo de Higea" width="90" height="90">
                <img src="images/Letras.png" alt="Higea" width="180px" height="45px">
            </a>

            <ul class="items">
				<button class="buttom"><a href="gestion/gestion_usuarios.php" class="buttom-item"><i class="fi fi-sr-users-alt"></i>Gestión de usuarios</a></button>
			</ul>
        </nav>
    </header>

    <!-- Formulario para el cambio de contraseña -->
    <div class="login-box-pass" style="height: 400px;">
        <h1>NUEVA CONTRASEÑA</h1>
        <h4>Obligatorio (*).</h4>
        <form action="php/guardar-nueva-contra.php" method="post" class="form" id="form" style="height: 280px;">

            <div class="grid">
                <!--group: password-->
                <div class="form-group" id="group_password">
                    <div class="form-group-input">
                        <label for="password">Contraseña (*)</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" placeholder="Ingrese contraseña" autocomplete="off" required>
                            <button type="button" class="toggle-password" aria-label="Toggle Password Visibility">
                                <i class="fi fi-sr-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                    </div>
                    <p class="form-input-error" style="position: absolute;">
                        Debe contener al menos: <br>
                        *Entre 8 y 16 caracteres. <br>
                        *Una letra mayúscula. <br>
                        *Una letra minúscula. <br>
                        *Un dígito. <br>
                        *Un caracter esp: @$!%*?&._-
                    </p>
                </div>

                <!-- Validacion de contraseña -->
                <script>
                document.getElementById('form').addEventListener('submit', function(event) {
                    var password = document.getElementById('password').value;
                    var regex =
                        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&._-])[A-Za-z\d@$!%*?&._-]{8,16}$/; // al menos una M, una m, un digito, un caracter @$!%*?&._- y una longitud de 8 a 16 caracteres.

                    if (!regex.test(password)) {
                        event.preventDefault();
                        alert('La contraseña no cumple con los requisitos.');
                    }
                });
                </script>

                <!--group: confirmation_pass-->
                <div class="form-group" id="group_confirmation_pass">
                    <div class="form-group-input">
                        <label for="confirmation_pass">Confirme la contraseña (*)</label>
                        <div class="password-wrapper">
                            <input type="password" name="confirmation_pass" id="confirmation_pass" placeholder="confirme contraseña" autocomplete="off" required>
                            <button type="button" class="toggle-password" aria-label="Toggle Password Visibility">
                                <i class="fi fi-sr-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                    </div>
                    <p class="form-input-error">Las contraseñas no coinciden</p>
                </div>

                <script>
                // Obtén los elementos del formulario
                var passwordInput = document.getElementById('password');
                var confirmPasswordInput = document.getElementById('confirmation_pass');

                // Añade un controlador de eventos al formulario
                document.getElementById('form').addEventListener('submit', function(event) {
                    // Obtén las contraseñas
                    var password = passwordInput.value;
                    var confirmPassword = confirmPasswordInput.value;

                    // Verifica si las contraseñas son iguales
                    if (password !== confirmPassword) {
                        // Si las contraseñas no son iguales, muestra un mensaje de error y evita que el formulario se envíe
                        alert('Las contraseñas no coinciden.');
                        event.preventDefault();
                    }
                });

                // Añade un controlador de eventos a los botones de mostrar/ocultar contraseña
                document.querySelectorAll(".toggle-password").forEach(function(togglePassword) {
                    togglePassword.addEventListener("click", function() {
                        var passwordInput = this.previousElementSibling;
                        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                        passwordInput.setAttribute("type", type);
                        
                        // Obtiene el icono
                        var eyeIcon = this.querySelector("i");
                        
                        // Cambia el icono del ojo
                        if (eyeIcon.classList.contains("fi-sr-eye")) {
                            eyeIcon.classList.remove("fi-sr-eye");
                            eyeIcon.classList.add("fi-sr-eye-crossed");
                        } else {
                            eyeIcon.classList.remove("fi-sr-eye-crossed");
                            eyeIcon.classList.add("fi-sr-eye");
                        }
                    });
                });
                </script>

            </div>


            <div class="button-container" style="align-self: flex-end; height: 250px;">
                <div class="form__group form__group-btn-submit">
                    <input class="button-submit" type="submit" name="registrar" id="registrar" value="Guardar">
                </div>
            </div>
        </form>
    </div>

    <footer>
        <div class="div-footer">
            <img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
            <img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
            <span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos reservados.</span>
        </div>
    </footer>

    <!-- Codigo JS necesario para el funcionamiento del formulario -->
    <script src="js/nueva-contra.js"></script>

</body>

</html>