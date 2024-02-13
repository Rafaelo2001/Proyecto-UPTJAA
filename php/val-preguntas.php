<?php
// Crea la conexión
$conex = mysqli_connect("localhost", "root", "", "higea_db");

// Verifica la conexión
if ($conex->connect_error) {
    die("Conexión fallida: " . $conex->connect_error);
}

session_start();

// Guarda los datos recibidos por el método POST en dos variables
$r1 = $_POST['r1'];
$r2 = $_POST['r2'];
$r3 = $_POST['r3'];

// Escapa los caracteres especiales en las variables para evitar inyecciones SQL
$r1 = $conex->real_escape_string($r1);
$r2 = $conex->real_escape_string($r2);
$r3 = $conex->real_escape_string($r3);

// Ejecuta la consulta SQL para verificar si los datos ingresados coinciden con alguno de los datos almacenados en la tabla recup_password
$resultado = $conex->query("SELECT id_usuario FROM recup_password WHERE r1 = '$r1' AND r2 = '$r2' AND r3 = '$r3'");

if (mysqli_num_rows($resultado) > 0) {
    // Si hay una coincidencia, guarda el ID  del usuario en una variable y redirige a una página
    $row = mysqli_fetch_assoc($resultado); //se usa para obtener una fila de resultados como una matriz asociativa
    //luego se puede acceder a los campos individuales de la fila por su nombre
    $_SESSION['id_user'] = $row['id_usuario'];
    header('Location: ../nueva-contrasena.php');
} else {
    // Si no hay una coincidencia, muestra un mensaje emergente de error
    echo '<script type="text/javascript">';
    echo 'alert("Error: Respuesta(s) incorrecta(s)");';
    echo '</script>';
}

$conex->close();
?>