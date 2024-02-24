<?php
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }

    require "../php/sweet.php";

    $alert = new SweetForInsert();
    echo ($alert->sweetHead("Verificación de Token Maestro"));

    session_start();

    $user_token = $_POST['token'];

    // Comprueba si el token existe y si no ha expirado
    if (isset($_SESSION['token']) && $_SESSION['token']['expiry'] > time()) {
        if ($_SESSION['token']['value'] === $user_token) {
            
            // Agrega una combinacion extra para mayor seguridad y evitar que ingresen el codigo de una pagina externa
            $_SESSION['token']['si_plus'] = $_SESSION['token']['value']."si";
            header('Location: ./nueva_contrasena_master.php');

            exit();
        }
        else {
            die($alert->sweetError("./pagina_verificacion.php","El token es incorrecto"));
        }
    } else {
        die($alert->sweetError("./pagina_verificacion.php","Error de verificación","Token expirado o error de comprobación"));
    }
