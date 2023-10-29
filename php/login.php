<?php
    // Crea la conexión
    $conex = mysqli_connect("localhost","root","","higea_db");

    // Verifica la conexión
    if ($conex->connect_error) {
      die("Conexión fallida: " . $conex->connect_error);
    }

    session_start();

    // Guarda los datos recibidos por el método POST en dos variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
    $username = $conex->real_escape_string($username);
    $password = $conex->real_escape_string($password);

    // Ejecuta la consulta SQL para verificar si los datos ingresados coinciden con alguno de los datos almacenados en la tabla usuario
    $resultado = $conex->query("SELECT nombre FROM usuario WHERE nombre = '$username' AND password = '$password'");

    if (mysqli_num_rows($resultado) > 0)
    {
        // Si hay una coincidencia, guarda el nombre del usuario en una variable y redirige a una página
        $_SESSION['username'] = $_POST['username'];
        header('Location: ../home.php');
    }
    else
    {
        // Si no hay una coincidencia, muestra un mensaje de error
        echo "Error: Nombre de usuario o contraseña incorrectos";
    }

    $conex->close();
?>