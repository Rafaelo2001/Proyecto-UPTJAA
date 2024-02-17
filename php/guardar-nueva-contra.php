<?php

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['password'])) {
        header('Location: ../gestion/gestion_usuarios.php', true, 303);
        exit;
    }

    // Crea la conexión
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }

    require "./sweet.php";
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Cambio de Contraseña"));

    session_start();

    // Utiliza el ID de usuario de la sesión
    $id_usuario = $_SESSION['id_user'];
    // Guarda los datos recibidos por el método POST en una variable
    $password = $_POST['password'];

    // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
    $password = $conex->real_escape_string($password);

    // Cifra la contraseña
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Ejecuta la consulta SQL para actualizar la contraseña del usuario
    $resultado = $conex->query("UPDATE usuario SET password = '$password_hashed' WHERE id_usuario = '$id_usuario'");

    if ($resultado === TRUE) {
        unset($id_usuario);

        echo ($alert->sweetOK("../gestion/gestion_usuarios.php","¡Contraseña actualizada con éxito!"));

        exit();
    } else {
        echo($alert->sweetError("../gestion/gestion_usuarios.php","Error actualizando contraseña","$conex->error"));
    }

    $conex->close();
