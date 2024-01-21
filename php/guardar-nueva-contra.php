<?php
    // Crea la conexión
    $conex = mysqli_connect("localhost","root","","higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
      die("Conexión fallida: " . $conex->connect_error);
    }

    session_start();

    // Utiliza el ID de usuario de la sesión
    $id_usuario = $_SESSION['id_usuario'];
    // Guarda los datos recibidos por el método POST en una variable
    $password = $_POST['password'];

    // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
    $password = $conex->real_escape_string($password);

    // Cifra la contraseña
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Ejecuta la consulta SQL para actualizar la contraseña del usuario
    $resultado = $conex->query("UPDATE usuario SET password = '$password_hashed' WHERE id_usuario = '$id_usuario'");   

    if ($resultado === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("¡Contraseña actualizada con éxito!");';
        echo 'window.location.href = "../index.php";';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error actualizando contraseña.' . $conex->error . '");';
        echo '</script>';
    }

    $conex->close();
?>
