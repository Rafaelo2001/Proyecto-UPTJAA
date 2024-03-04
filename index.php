<?php
	// Coneccion con la BDD
	include "php/conexion.php";
	$user = new CodeaDB();
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Inicio de Sesión</title>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

	<style>
		.password-wrapper {
			position: relative;
		}

		#toggle-password {
			position: absolute;
			right: 10px;
			top: 7px;
			border: none;
			background: none;
			cursor: pointer;
		}

		#toggle-password i {
			font-size: 22px;
			color: #003971;
		}

		/* Para Google Chrome */
		input[type="password"]::-webkit-inner-spin-button,
		input[type="password"]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		input[type="password"]::-webkit-input-password-eye {
			display: none;
		}

		/* Para Mozilla Firefox */
		input[type="password"]::-ms-reveal,
		input[type="password"]::-ms-clear {
			display: none;
		}
	</style>
</head>

<body class="login-register">
	<header>
		<nav>
			<a href="index.php" class="title">
				<img src="images/Logo con contorno.png" alt="Logo de Higea" width="90" height="90">
				<img src="images/Letras.png" alt="Higea" width="180px" height="45px">
			</a>
		</nav>
	</header>

	<div class="login-box">
		<h1>INICIO DE SESIÓN</h1>

		<!-- Formulario de login con el cual se ingresara al sistema -->
		<form action="php/login.php" method="post" class="form" id="form">

			<div class="form-group" id="group_username">
				<div class="form-group-input">
					<label for="username">Nombre de usuario</label>
					<input type="text" name="username" id="username" placeholder="Ingrese nombre de usuario" autocomplete="off" required>
				</div>
				<p class="form-input-error">Rellene este campo correctamente</p>
			</div>

			<div class="form-group" id="group_password">
				<div class="form-group-input">
					<label for="password">Contraseña</label>
					<div class="password-wrapper">
						<input type="password" name="password" id="password" placeholder="Ingrese contraseña" autocomplete="off" required>
						<button type="button" id="toggle-password" aria-label="Toggle Password Visibility">
							<i class="fi fi-sr-eye" aria-hidden="true"></i>
						</button>
					</div>
				</div>
				<p class="form-input-error">Rellene este campo correctamente</p>
			</div>

			<script>
				document.querySelector("#toggle-password").addEventListener("click", function() {
				var passwordInput = document.querySelector("#password");
				var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
				passwordInput.setAttribute("type", type);
				
				// Obtiene el icono
				var eyeIcon = this.querySelector("i");
				
				// Cambia el icono del ojo
				if (eyeIcon.classList.contains("fi-sr-eye")) {
					eyeIcon.classList.remove("fi-sr-eye");
					eyeIcon.classList.add("fi-sr-eye-crossed");
				} else {
					eyeIcon.classList.remove("fi-sr-eye-crossed");
					eyeIcon.classList.add("fi-sr-eye");
				}
				});
			</script>

			<div class="form-mess" id="form-mess">
				<p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
			</div>

			<br><br>

			<div class="button-container">
				<div class="form__group form__group-btn-submit">
					<input class="button-submit" type="submit" name="registrar" id="registrar" value="Acceder">
				</div>
				<p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
			</div>
		</form>
	</div>

	<footer>
		<div class="div-footer">
			<img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
			<a href="./recuperacion_admin/recuperacion_admin.php"><img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70"></a>
			<span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos reservados.</span>
		</div>
	</footer>

</body>

</html>