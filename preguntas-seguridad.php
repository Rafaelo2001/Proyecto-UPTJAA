<?php

include "php/conexion.php";
$user = new CodeaDB();

session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    header('Location: ./gestion/gestion_usuarios.php', true, 303);
    exit;
}

// Incluye el archivo de permisos
require 'php/permisos.php';

// Obtiene el rol del usuario de la variable de sesión
$rol = $_SESSION['Rol'];

// Obtiene el nombre de la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Verifica si el usuario tiene permiso para acceder a la página actual
if (!in_array($paginaActual, $permisos[$rol])) {
	header('Location: ./sin_permiso.php', true, 303);

	exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Recuperación de Contraseña</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
</head>

<body class="login-register">
	<header>
		<nav>
			<a class="title">
				<img src="images/Logo con contorno.png" alt="Logo de Higea" width="90" height="90">
				<img src="images/Letras.png" alt="Higea" width="180px" height="45px">
			</a>

			<ul class="items">
				<button class="buttom"><a href="gestion/gestion_usuarios.php" class="buttom-item"><i class="fi fi-sr-users-alt"></i>Gestión de usuarios</a></button>
			</ul>
		</nav>
	</header>

	<div class="login-box-quest" style="height: 520px;">
		<h1>PREGUNTAS DE SEGURIDAD</h1>
		<form action="./php/val-preguntas.php" method="post" class="form" id="form">

			<?php
			// Crea la conexión
			$conex = mysqli_connect("localhost", "root", "", "higea_db");

			// Verifica la conexión
			if ($conex->connect_error) {
				die("Conexión fallida: " . $conex->connect_error);
			}

			//inicia la sesión
			// session_start();

			// Utiliza el ID de usuario de la sesión
			$id_usuario = $_POST['id'];

			// Ejecuta la consulta SQL para verificar si los datos ingresados coinciden con alguno de los datos almacenados en la tabla recup_password
			$resultado = $conex->query("SELECT p1, p2, p3 FROM recup_password WHERE id_usuario = '$id_usuario'");

			if (mysqli_num_rows($resultado) > 0) {
				// Si hay una coincidencia, guarda p1, p2, p3, r1, r2 y r3 en unas variables y redirige a una página
				$row = mysqli_fetch_assoc($resultado); //se usa para obtener una fila de resultados como una matriz asociativa
				//luego se puede acceder a los campos individuales de la fila por su nombre
				$_SESSION['p1'] = $row['p1'];
				$_SESSION['p2'] = $row['p2'];
				$_SESSION['p3'] = $row['p3'];
				//header('Location: nueva-contrasena.php'); //página de nueva contraseña

				echo '<div class="form-group" id="group_username">';
				echo '<div class="form-group-input">';
				echo '<label for="r1">' . $_SESSION['p1'] . '</label>';
				echo '<input type="text" name="r1" id="r1" placeholder="Ingresa la respuesta" autocomplete="off" required>';
				echo '</div>';
				echo '<p class="form-input-error">Rellene este campo correctamente</p>';
				echo '</div>';

				echo '<div class="form-group" id="group_username">';
				echo '<div class="form-group-input">';
				echo '<label for="r2">' . $_SESSION['p2'] . '</label>';
				echo '<input type="text" name="r2" id="r2" placeholder="Ingresa la respuesta" autocomplete="off" required>';
				echo '</div>';
				echo '<p class="form-input-error">Rellene este campo correctamente</p>';
				echo '</div>';

				echo '<div class="form-group" id="group_username">';
				echo '<div class="form-group-input">';
				echo '<label for="r3">' . $_SESSION['p3'] . '</label>';
				echo '<input type="text" name="r3" id="r3" placeholder="Ingresa la respuesta" autocomplete="off" required>';
				echo '</div>';
				echo '<p class="form-input-error">Rellene este campo correctamente</p>';
				echo '</div>';
			} else {
				// Si no hay una coincidencia, muestra un mensaje emergente de error
				echo '<script type="text/javascript">';
				echo 'alert("Error: ID de usuario incorrecto");';
				echo '</script>';
			}

			$conex->close();
			?>

			<div class="button-container">
				<div class="form__group form__group-btn-submit">
					<input type="hidden" name="id" value="<?php echo ($id_usuario); ?>" required>
					<input class="button-submit" type="submit" name="registrar" id="registrar" value="Siguiente">
				</div>
			</div>
		</form>

		<p></p>

		<div class="acciones">
			<div class="button-container">
				<div class="form__group form__group-btn-submit">
					<form action="php/token-seguridad.php" method="post"><input type="hidden" name="id" value="<?php echo ($id_usuario); ?>" required><input type="submit" value="¿Olvidó sus respuestas?"></form>
					<label style="font-size: 12px; text-align: center;">Requiere conexión a internet</label>
				</div>
				<p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
			</div>
		</div>
	</div>

	<footer>
		<div class="div-footer">
			<img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
			<img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
			<span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos
				reservados.</span>
		</div>
	</footer>


</body>

</html>