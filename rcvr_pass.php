<?php
include "php/conexion.php";
$user = new CodeaDB();
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
				<button class="buttom"><a href="gestion/gestion_usuarios.php" class="buttom-item"><i class="fi fi-sr-enter"></i>Gestión de usuarios</a></button>
			</ul>
		</nav>
	</header>

	<div class="login-box-rcvr">
		<h1>VALIDACIÓN DE USUARIO</h1>
		<form action="php/val-user-recup.php" method="post" class="form" id="form">

			<!--username-->
			<div class="form-group" id="group_username">
				<div class="form-group-input">
					<label for="username">Nombre de usuario</label>
					<input type="text" name="username" id="username" placeholder="Ingresa nombre de usuario" autocomplete="off" required>
				</div>
				<p class="form-input-error">Rellene este campo correctamente</p>
			</div>


			<div class="form-mess" id="form-mess">
				<p><i class="fi fi-rr-triangle-warning"></i> <b>Error:</b> ¡Revise los campos!</p>
			</div>

			<div class="button-container">
				<div class="form__group form__group-btn-submit">
					<input class="button-submit" type="submit" name="registrar" id="registrar" value="Siguiente">
				</div>
				<p class="form-mess-good" id="form-mess-good">¡Formulario enviado exitosamente!</p>
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