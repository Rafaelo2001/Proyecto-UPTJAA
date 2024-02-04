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
			<a href="index.php" class="title">
				<img src="images/Logo con contorno.png" alt="Logo de Higea" width="90" height="90">
				<img src="images/Letras.png" alt="Higea" width="180px" height="45px">
			</a>

			<ul class="items">
				<button class="buttom"><a href="index.php" class="buttom-item"><i class="fi fi-sr-enter"></i>Iniciar
						Sesión</a></button>
				<button class="buttom"><a href="user_register.php" class="buttom-item"><i class="fi fi-sr-user-add"></i>Registrarse</a></button>
			</ul>
		</nav>
	</header>

	<div class="login-box-quest">
		<h1>PREGUNTAS DE SEGURIDAD</h1>
		<form action="php/val-preguntas.php" method="post" class="form" id="form">

			<?php
			// Crea la conexión
			$conex = mysqli_connect("localhost", "root", "", "higea_db");

			// Verifica la conexión
			if ($conex->connect_error) {
				die("Conexión fallida: " . $conex->connect_error);
			}

			//inicia la sesión
			session_start();

			// Utiliza el ID de usuario de la sesión
			$id_usuario = $_SESSION['id_usuario'];

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

			<!--<div class="form-mess" id="form-mess">
				<p><i class="fi fi-rr-triangle-warning"></i> <b>Error:</b> ¡Revise los campos!</p>
			</div>-->

			<div class="button-container">
				<div class="form__group form__group-btn-submit">
					<input class="button-submit" type="submit" name="registrar" id="registrar" value="Siguiente">
				</div>
				<!--<p class="form-mess-good" id="form-mess-good">¡Formulario enviado exitosamente!</p>-->
			</div>
		</form>
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