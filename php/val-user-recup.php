<?php
// Crea la conexión
$conex = mysqli_connect("localhost", "root", "", "higea_db");

// Verifica la conexión
if ($conex->connect_error) {
    die("Conexión fallida: " . $conex->connect_error);
}

session_start();

// Guarda los datos recibidos por el método POST en una variable
$username = $_POST['username'];

// Escapa los caracteres especiales en las variables para evitar inyecciones SQL
$username = $conex->real_escape_string($username);

// Ejecuta la consulta SQL para verificar si los datos ingresados coinciden con alguno de los datos almacenados en la tabla usuario
$resultado = $conex->query("SELECT nombre, id_usuario FROM usuario WHERE nombre = '$username'");

if (mysqli_num_rows($resultado) > 0) {
    // Si hay una coincidencia, guarda el nombre del usuario y el ID en dos variables y redirige a una página
    $row = mysqli_fetch_assoc($resultado); //se usa para obtener una fila de resultados como una matriz asociativa
    //luego se puede acceder a los campos individuales de la fila por su nombre
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['id_usuario'] = $row['id_usuario'];
    header('Location: ../preguntas-seguridad.php');
} else {
    // Si no hay una coincidencia, muestra un mensaje emergente de error
    echo '<script type="text/javascript">';
    echo 'alert("Error: Nombre de usuario incorrecto");';
    echo '</script>';
}

$conex->close();
?>