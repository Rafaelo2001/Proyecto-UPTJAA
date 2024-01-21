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

    // Ejecuta la consulta SQL para obtener el hash de la contraseña del usuario
    $resultado = $conex->query("SELECT password FROM usuario WHERE nombre = '$username'");

    if (mysqli_num_rows($resultado) > 0)
    {
        // Si hay una coincidencia, verifica la contraseña
        $row = mysqli_fetch_assoc($resultado);
        $password_hash = $row['password'];

        if (password_verify($password, $password_hash)) {
            // Si la contraseña es correcta, guarda el nombre del usuario y la ID en una variable y redirige a una página
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userID'] = $row['id_usuario'];
            header('Location: ../home.php');
        } else {
            // Si la contraseña es incorrecta, muestra un mensaje emergente de error
            echo '<script type="text/javascript">
            alert("Error: Nombre de usuario o contraseña incorrectos");
            window.location.href = "../"; 
            </script>';
        }
    }
    else
    {
        // Si no hay una coincidencia, muestra un mensaje emergente de error
        echo '<script type="text/javascript">
        alert("Error: Nombre de usuario o contraseña incorrectos");
        window.location.href = "../"; 
        </script>';
    }

    $conex->close();
?>