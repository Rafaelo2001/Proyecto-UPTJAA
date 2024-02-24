<?php
    // Crea la conexión con la BDD
    $conex = mysqli_connect("localhost", "root", "", "higea_db");

    // Comprueba que se haya llegado a esta pagina por un metodo POST y que las variables 'username' u 'login' no esten vacias
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['username']) || empty($_POST['password'])){
        header('Location: ../index.php', true, 303);
        exit;
    }

    // Verifica la conexión
    if ($conex->connect_error) {
        die("Conexión fallida: " . $conex->connect_error);
    }

    session_start();

    // Solicita el archivo sweet.php para alertas estilizadas
    require "sweet.php";
    $alert = new SweetForInsert();

    echo ($alert->sweetHead('Inicio Sección'));
    

    // Guarda los datos recibidos por el método POST en dos variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escapa los caracteres especiales en las variables para evitar inyecciones SQL
    $username = $conex->real_escape_string($username);
    $password = $conex->real_escape_string($password);

    // Ejecuta la consulta SQL para obtener el hash de la contraseña del usuario
    $resultado = $conex->query("SELECT password FROM usuario WHERE nombre = '$username'");

    if (mysqli_num_rows($resultado) > 0) {
        // Si hay una coincidencia, verifica la contraseña
        $row = mysqli_fetch_assoc($resultado);
        $password_hash = $row['password'];

        if (password_verify($password, $password_hash)) {
            // Si la contraseña es correcta, guarda el nombre del usuario y la ID en una variable y redirige a una página
            $_SESSION['username'] = $_POST['username'];

            // Consulta a la base de datos para obtener el rol del usuario
            $sql = "SELECT Rol FROM usuario WHERE Nombre = ?";
            $stmt = $conex->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_object();

            // Almacena el rol del usuario en una variable de sesión
            $_SESSION['Rol'] = $user->Rol;

            header('Location: ../home.php');
        } else {
            echo($alert->sweetError("../","Error de Conexión","Nombre  de usuario o contraseña incorrectos"));
        }
    } else {
        echo($alert->sweetError("../","Error de Conexión","Nombre  de usuario o contraseña incorrectos"));
    }

    // Cierra la conexion
    $conex->close();
