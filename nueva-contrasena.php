<?php
include "php/conexion.php";
$user = new CodeaDB();
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
</head>

<body class="login-register">
    <header>
        <nav>
            <a href="index.php" class="title">
                <img src="images/Logo con contorno.png" alt="Logo de Higea" width="90" height="90">
                <img src="images/Letras.png" alt="Higea" width="180px" height="45px">
            </a>

            <ul class="items">
                <button class="buttom"><a href="index.php" class="buttom-item"><i class="fi fi-sr-enter"></i>Iniciar Sesión</a></button>
                <button class="buttom"><a href="user_register.php" class="buttom-item"><i class="fi fi-sr-user-add"></i>Registrarse</a></button>
            </ul>
        </nav>
    </header>

    <div class="login-box-pass">
        <h1>NUEVA CONTRASEÑA</h1>
        <h4>Obligatorio (*).</h4>
        <form action="php/guardar-nueva-contra.php" method="post" class="form" id="form">

            <div class="grid">
                <!--group: password-->
                <div class="form-group" id="group_password">
                    <div class="form-group-input">
                        <label for="password">Contraseña (*)</label>
                        <input type="password" name="password" id="password" placeholder="Ingrese una contraseña"
                            autocomplete="off" required>
                        <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                    </div>
                    <p class="form-input-error">
                        Debe contener al menos: <br>
                        *Entre 8 y 16 caracteres. <br>
                        *Una letra mayúscula. <br>
                        *Una letra minúscula. <br>
                        *Un dígito. <br>
                        *Un caracter esp: @$!%*?&._-
                    </p>
                </div>

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
                        <input type="password" name="confirmation_pass" id="confirmation_pass"
                            placeholder="confirme la contraseña" autocomplete="off" required>
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
                </script>

            </div>


            <!--<div class="form-mess" id="form-mess">
				<p><i class="fi fi-rr-triangle-warning"></i> <b>Error:</b> ¡Revise los campos!</p>
			</div>-->

            <div class="button-container">
                <div class="form__group form__group-btn-submit">
                    <input class="button-submit" type="submit" name="registrar" id="registrar" value="Guardar">
                </div>
                <!--<p class="form-mess-good" id="form-mess-good">¡Formulario enviado exitosamente!</p>-->
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

    <script src="js/nueva-contra.js"></script>

</body>

</html>