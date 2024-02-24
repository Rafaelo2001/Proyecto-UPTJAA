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
    <title>Verificacion de Token</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
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

    <div class="login-box-rcvr">
        <h1>VALIDACIÓN</h1>

        <!-- Formulario para ingresar token enviado por correo -->
        <form action="php/verify_token.php" method="post" class="form" id="form">

            <!--username-->
            <div class="form-group" id="group_username">
                <div class="form-group-input">
                    <label for="token">Token enviado a correo</label>
                    <input type="text" name="token" id="token" placeholder="Ingrese token" autocomplete="off" required>
                </div>
                <p class="form-input-error">Rellene este campo correctamente</p>
            </div>

            <div class="form-mess" id="form-mess">
                <p><i class="fi fi-rr-triangle-warning"></i> <b>Error:</b> ¡Revise los campos!</p>
            </div>

            <br>

            <div class="button-container">
                <div class="form__group form__group-btn-submit">
                    <input class="button-submit" type="submit" name="registrar" id="registrar" value="Siguiente">
                </div>
                <p class="form-mess-good" id="form-mess-good">¡Formulario enviado exitosamente!</p>
            </div>
        </form>

        <!-- Validacion del token -->
        <script>
            document.getElementById('form').addEventListener('submit', function(event) {
                let input = document.getElementById('token');
                let regex = /^.{8}$/;
                if (!regex.test(input.value)) {
                    alert('Por favor, ingresa exactamente 8 caracteres.');
                    event.preventDefault(); // Evita que se envíe el formulario
                }
            });
        </script>

    </div>

    <footer>
        <div class="div-footer">
            <img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
            <img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
            <span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos
                reservados.</span>
        </div>
    </footer>

</body>

</html>