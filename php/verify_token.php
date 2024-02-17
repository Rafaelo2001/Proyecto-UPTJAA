<?php
    // Crea la conexión
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }

    require "./sweet.php";

    $alert = new SweetForInsert();
    echo ($alert->sweetHead("Verificación de Token"));

    session_start();

    $user_token = $_POST['token'];

    // Comprueba si el token existe y si no ha expirado
    if (isset($_SESSION['token']) && $_SESSION['token']['expiry'] > time()) {
        if ($_SESSION['token']['value'] === $user_token) {
            // Redirige al usuario a la página para cambiar su contraseña
            header('Location: ../nueva-contrasena.php');

            // Elimina el token de la variable de sesión
            unset($_SESSION['token']);

            exit();
        }
        else {
            echo($alert->sweetError("../gestion/gestion_usuarios.php","El token es incorrecto"));
        }
    } else {
        echo($alert->sweetError("../gestion/gestion_usuarios.php","El token es incorrecto"));
    }
