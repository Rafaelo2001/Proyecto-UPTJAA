<?php

    require "../php/sweet.php";
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Cambio de Contraseña"));

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['password'])) {
        die($alert->sweetError("../index.php","Error de Acceso"));
    }

    // Crea la conexión
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }


    session_start();

        $id_usuario = 1;
        $password = $_POST['password'];

        // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
        $password = $conex->real_escape_string($password);

        // Cifra la contraseña
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Ejecuta la consulta SQL para actualizar la contraseña del usuario
        $resultado = $conex->query("UPDATE usuario SET password = '$password_hashed' WHERE id_usuario = '$id_usuario'");

        if ($resultado === TRUE) {
            unset($id_usuario);

            $conex->close();
            die($alert->sweetOK("../index.php","¡Contraseña Maestra actualizada con éxito!"));

        } else {

            $conex->close();
            die($alert->sweetError("../index.php","Error actualizando contraseña maestra","$conex->error"));
        }
