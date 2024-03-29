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
	<title>Registro de Empleado</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

	<style>
		.password-wrapper {
            position: relative;
            display: inline-block; /* Asegúrate de que el contenedor sea en línea para que no ocupe todo el ancho */
        }

        .toggle-password {
            position: absolute;
            right: 10px; /* Ajusta este valor para mover el botón a la derecha */
            top: 7px; /* Centra el botón verticalmente */
            border: none;
            background: none;
            cursor: pointer;
        }

        .toggle-password i {
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

        .login-box-pass input[type="password"],
        .login-box-pass input[type="text"]:not([type="password"]) {
            border: none;
            border-bottom: 3px solid rgba(254, 101, 0, 1);
            background-color: #F2F2F2;
            outline: none;
            height: 40px;
            color: #0D0D0D;
            font-size: 16px;
            border-radius: 10px;
            box-shadow: 5px 5px 10px 2px rgba(0, 21, 49, 0.2);
        }

        .toggle-password:hover {
            background: none;
        }
	</style>
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
	<div>
		<section class="form-register">
			<h1>REGISTRO DE EMPLEADO</h1>
			<form action="php/insert-user.php" method="post" class="form" id="form">
				<h4>Obligatorio (*).</h4>

				<h2>INFORMACIÓN PRINCIPAL:</h2>
				<div class="grid">
					<!--group: V/E/P/J-->
					<div class="questions" id="tipo_identidad" name="tipo_identidad">
						<label for="tipo_identidad">Tipo de identificación (*)</label>
						<select class="tipo_identidad" name="tipo_identidad" id="tipo_identidad" required>
							<option value="" selected="selected" disabled selected>Seleccione</option>
							<option value="V">Venezolano (V)</option>
							<option value="E">Extranjero (E)</option>
							<option value="P">Pasaporte (P)</option>
							<option value="J">RIF (J)</option>
						</select>
					</div>

					<!--group: ci-->
					<div class="form-group" id="group_ci_empl">
						<div class="form-group-input">
							<label for="ci_empl">Documento de identidad (*)</label>
							<input type="text" name="ci_empl" id="ci_empl" placeholder="Ingrese nro. de documento" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">La cédula debe contener entre 6-8 caracteres, solo puede contener
							números</p>
					</div>

					<script>
						// Validación de documento
						document.getElementById('form').addEventListener('submit', function (e) {
						var input = document.getElementById('ci_empl');

						if (!/^\d{6,10}$/.test(input.value)) {
							// Si la entrada no es válida, previene el envío del formulario
							e.preventDefault();
							alert('Por favor, ingrese un número de cédula válido.');
						}
						});
					</script>

					<!--group: name1-->
					<div class="form-group" id="group_name_empl1">
						<div class="form-group-input">
							<label for="name_empl1">Primer Nombre (*)</label>
							<input type="text" name="name_empl1" id="name_empl1" placeholder="Ingrese su nombre" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: name2-->
					<div class="form-group" id="group_name_empl2">
						<div class="form-group-input">
							<label for="name_empl2">Segundo Nombre</label>
							<input type="text" name="name_empl2" id="name_empl2" placeholder="Ingrese su nombre" autocomplete="off">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: name3-->
					<div class="form-group" id="group_name_empl3">
						<div class="form-group-input">
							<label for="name_empl3">Tercer Nombre</label>
							<input type="text" name="name_empl3" id="name_empl3" placeholder="Ingrese su nombre" autocomplete="off">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: surname1-->
					<div class="form-group" id="group_surname_empl1">
						<div class="form-group-input">
							<label for="surname_empl1">Primer Apellido (*)</label>
							<input type="text" name="surname_empl1" id="surname_empl1" placeholder="Ingrese su apellido" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: surname2-->
					<div class="form-group" id="group_surname_empl2">
						<div class="form-group-input">
							<label for="surname_empl2">Segundo Apellido</label>
							<input type="text" name="surname_empl2" id="surname_empl2" placeholder="Ingrese su apellido" autocomplete="off">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: datebirth-->
					<div class="form-group" id="group_date_birth">
						<div class="form-group-input">
							<label for="date_birth">Fecha de nacimiento (*)</label>
							<input type="date" class="date_birth" name="date_birth" id="date_birth" placeholder="(dd/mm/aaaa)" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
					</div>

					<!-- Validacion de Fechas -->
					<script>
						var minima = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 *
							60 * 1000);
						minima.setFullYear(minima.getFullYear() - 40);
						var fechaMinima = minima.toISOString().split('T')[0];
						document.getElementById("date_birth").min = fechaMinima;


						var maxima = new Date();
						maxima.setFullYear(maxima.getFullYear() - 18);
						var fechaMaxima = maxima.toISOString().split('T')[0];
						document.getElementById("date_birth").max = fechaMaxima;
					</script>

					<div>
						<label>Sexo (*)</label>
						<div class="radio" id="sexo">
							<input type="radio" name="sexo" id="masculino" value="M" required>
							<label for="masculino">Masculino</label>
							<br>
							<input type="radio" name="sexo" id="femenino" value="F" required>
							<label for="femenino">Femenino</label>
						</div>
					</div>
				</div>

				<h2>INFORMACIÓN DE CONTACTO:</h2>
				<div class="grid">

					<!--group: tel-->
					<div class="form-group" id="group_telf_empl">
						<div class="form-group-input">
							<label for="telf_empl">Teléfono (*)</label>
							<input type="tel" name="telf_empl" id="telf_empl" placeholder="Ingrese su nro. de teléfono" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">El número telefónico debe tener 12 dígitos: 1234-1234567</p>
					</div>

					<script>
						// Validación del telefono
						document.getElementById('form').addEventListener('submit', function (e) {
						var phoneInput = document.getElementById('telf_empl');

						if (!/^\d{11}$/.test(phoneInput.value)) {
							// Si la entrada no es válida, previene el envío del formulario
							e.preventDefault();
							alert('Por favor, ingrese un número de teléfono válido.');
						}
						});
					</script>

					<!--group: e-mail-->
					<div class="form-group" id="group_email_empl">
						<div class="form-group-input">
							<label for="email_empl">Correo electrónico (*)</label>
							<input type="email" name="email_empl" id="email_empl" placeholder="Ingrese su e-mail" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Formato incorrecto de e-mail: jhon123@example.com</p>
					</div>
				</div>
				<h2>INFORMACIÓN DE DIRECCIÓN:</h2>
				<div class="grid">
					<!--group: state-->
					<div class="questions">
						<label for="lista_estados">Estado (*)</label>
						<select id="lista_estados" name="estado" class="quest-security quest-direction" required>
							<option value="0" disabled selected>Seleccione</option>
							<?php $estados = $user->buscar("estado", "1"); ?>
							<?php foreach ($estados as $estado) : ?>
								<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['nombre'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="questions" id="ciudades">
						<label for="lista_ciudades">Ciudad (*)</label>
						<select id="lista_ciudades" name="ciudad" class="quest-security quest-direction" required></select>
					</div>

					<div class="questions" id="municipios">
						<label for="lista_municipios">Municipio (*)</label>
						<select id="lista_municipios" name="municipio" class="quest-security quest-direction" required></select>
					</div>

					<div class="questions" id="parroquias">
						<label for="lista_parroquias">Parroquia (*)</label>
						<select id="lista_parroquias" name="parroquia" class="quest-security quest-direction" required>
							<option value="" selected disabled>-- Seleccione Parroquia--</option>
						</select>
					</div>

					<!--group: location-->
					<div class="form-group" id="group_location">
						<div class="form-group-input">
							<label for="location">Punto de referencia (*)</label>
							<input type="text" name="location" id="location" placeholder="Ingrese su localización" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
					<!--group: sector-->
					<div class="form-group" id="group_sector">
						<div class="form-group-input">
							<label for="sector">Sector (*)</label>
							<input type="text" name="sector" id="sector" placeholder="Ingrese su sector" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
					<!--group: street-->
					<div class="form-group" id="group_street">
						<div class="form-group-input">
							<label for="street">Calle (*)</label>
							<input type="text" name="street" id="street" placeholder="Ingrese su calle" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
					<!--group: house-->
					<div class="form-group" id="group_house">
						<div class="form-group-input">
							<label for="house">Número de casa/apto</label>
							<input type="text" name="house" id="house" placeholder="Ingrese su número de casa" autocomplete="off">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
				</div>
				<h2>INFORMACIÓN DE USUARIO:</h2>
				<div class="grid">
					<!--group: username-->
					<div class="form-group" id="group_username">
						<div class="form-group-input">
							<label for="username">Nombre de usuario (*)</label>
							<input type="text" name="username" id="username" placeholder="Ingrese su nombre de usuario" autocomplete="off" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
					<!--group: password-->
					<div class="form-group" id="group_password">
						<div class="form-group-input">
							<label for="password">Contraseña (*)</label>
							<div class="password-wrapper">
								<input type="password" name="password" id="password" placeholder="Ingrese contraseña" autocomplete="off" required>
								<button type="button" class="toggle-password" aria-label="Toggle Password Visibility">
									<i class="fi fi-sr-eye" aria-hidden="true"></i>
								</button>
							</div>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">
							Debe contener al menos: <br>
							*Entre 8 y 16 caracteres. <br>
							*Una letra mayúscula. <br>
							*Una letra minúscula. <br>
							*Un dígito. <br>
							*Un caracter esp: @$!%*?&._-
						</p>
					</div>

					<!-- Validacion de Contraseña -->
					<script>
						document.getElementById('form').addEventListener('submit', function(event) {
							var password = document.getElementById('password').value;
							var regex =
								/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&._-])[A-Za-z\d@$!%*?&._-]{8,16}$/; // al menos una M, una m, un digito, un caracter @$!%*?&._- y una longitud de 8 a 16 caracteres.

							if (!regex.test(password)) {
								event.preventDefault();
								alert('La contraseña no cumple con los requisitos.');
							}
						});
					</script>

					<!--group: confirmation_pass-->
					<div class="form-group" id="group_confirmation_pass">
						<div class="form-group-input">
							<label for="confirmation_pass">Confirme la contraseña (*)</label>
							<div class="password-wrapper">
								<input type="password" name="confirmation_pass" id="confirmation_pass" placeholder="confirme contraseña" autocomplete="off" required>
								<button type="button" class="toggle-password" aria-label="Toggle Password Visibility">
									<i class="fi fi-sr-eye" aria-hidden="true"></i>
								</button>
							</div>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Las contraseñas no coinciden</p>
					</div>

					<script>
						// Obtén los elementos del formulario
						var passwordInput = document.getElementById('password');
						var confirmPasswordInput = document.getElementById('confirmation_pass');

						// Añade un controlador de eventos al formulario
						document.getElementById('form').addEventListener('submit', function(event) {
							// Obtén las contraseñas
							var password = passwordInput.value;
							var confirmPassword = confirmPasswordInput.value;

							// Verifica si las contraseñas son iguales
							if (password !== confirmPassword) {
								// Si las contraseñas no son iguales, muestra un mensaje de error y evita que el formulario se envíe
								alert('Las contraseñas no coinciden.');
								event.preventDefault();
							}
						});

						// Añade un controlador de eventos a los botones de mostrar/ocultar contraseña
						document.querySelectorAll(".toggle-password").forEach(function(togglePassword) {
							togglePassword.addEventListener("click", function() {
								var passwordInput = this.previousElementSibling;
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
						});
					</script>

				</div>

				<div>
					<label>Tipo de usuario (*)</label>
					<div class="radio" id="tipe">
						<input type="radio" name="tipe" id="admin" value="admin" required>
						<label for="admin">Admin</label>
						<br>
						<input type="radio" name="tipe" id="analista" value="analista" required>
						<label for="analista">Analista</label>
					</div>
				</div>

				<h2>PREGUNTAS DE SEGURIDAD:</h2>
				<div class="grid">
					<div>
						<div class="questions">
							<label for="quest-security1">Pregunta de seguridad 1 (*)</label>
							<select class="quest-security quest-question" name="quest1" id="quest-security1" required>
								<option value="0" selected="selected" disabled selected>Seleccione</option>
								<option value="Ciudad de nacimiento">Ciudad de nacimiento</option>
								<option value="Nombre de mi mascota">Nombre de mi mascota</option>
								<option value="Marca de mi primer teléfono">Marca de mi primer teléfono</option>
								<option value="Color favorito">Color favorito</option>
								<option value="Comida favorita">Comida favorita</option>
							</select>
						</div>
						<div class="questions" id="group_respuesta1">
							<div class="form-group-input">
								<label for="respuesta1">Respuesta (*)</label>
								<input type="text" name="respuesta1" id="respuesta1" placeholder="Ingrese su respuesta" autocomplete="off" required>
								<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							</div>
							<p class="form-input-error">Campo obligatorio</p>
						</div>
					</div>
					<div>
						<div class="questions">
							<label for="quest-security2">Pregunta de seguridad 2 (*)</label>
							<select class="quest-security quest-question" name="quest2" id="quest-security2" required>
								<option value="0" selected="selected" disabled selected>Seleccione</option>
								<option value="Ciudad de nacimiento">Ciudad de nacimiento</option>
								<option value="Nombre de mi mascota">Nombre de mi mascota</option>
								<option value="Marca de mi primer teléfono">Marca de mi primer teléfono</option>
								<option value="Color favorito">Color favorito</option>
								<option value="Comida favorita">Comida favorita</option>
							</select>
						</div>
						<div class="questions" id="group_respuesta2">
							<div class="form-group-input">
								<label for="respuesta1">Respuesta (*)</label>
								<input type="text" name="respuesta2" id="respuesta2" placeholder="Ingrese su respuesta" autocomplete="off" required>
								<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							</div>
							<p class="form-input-error">Campo obligatorio</p>
						</div>
					</div>
					<div>
						<div class="questions">
							<label for="quest-security3">Pregunta de seguridad 3 (*)</label>
							<select class="quest-security quest-question" name="quest3" id="quest-security3" required>
								<option value="" selected="selected" disabled selected>Seleccione</option>
								<option value="Ciudad de nacimiento">Ciudad de nacimiento</option>
								<option value="Nombre de mi mascota">Nombre de mi mascota</option>
								<option value="Marca de mi primer teléfono">Marca de mi primer teléfono</option>
								<option value="Color favorito">Color favorito</option>
								<option value="Comida favorita">Comida favorita</option>
							</select>
						</div>
						<div class="questions" id="group_respuesta3">
							<div class="form-group-input">
								<label for="respuesta1">Respuesta (*)</label>
								<input type="text" name="respuesta3" id="respuesta3" placeholder="Ingrese su respuesta" autocomplete="off" required>
								<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							</div>
							<p class="form-input-error">Campo obligatorio</p>
						</div>
					</div>
				</div>

				<div class="button-container">
					<div class="form__group form__group-btn-submit">
						<input class="button-submit" type="submit" name="registrar" id="registrar" value="Registrar">
					</div>
				</div>
			</form>
		</section>
	</div>
	<footer>
		<div class="div-footer">
			<img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
			<img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
			<span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos
				reservados.</span>
		</div>
	</footer>

	<script src="js/form-user.js"></script>
	<script src="https://kit.fontawesome.com/22453eed4e.js" data-mutate-approach="sync" crossorigin="anonymous">
	</script>

	<script>
		// AJAX para la seleccion de Estados, Ciudades, Municipios y Parroquias
		$("#lista_estados").change(function() {
			$.ajax({
				data: "id_estado=" + $("#lista_estados").val(),
				url: 'php/ajax_ciudades.php',
				type: 'post',
				dataType: 'json',
				beforeSend: function() {},
				success: function(response) {
					var html = "";
					$.each(response, function(index, value) {
						html += '<option value="' + value.id + '">' + value.nombre +
							"</option>";
					});
					$("#lista_ciudades").html(html);
					$("#lista_parroquias").html("");
				},
				error: function() {
					alert("error")
				}
			});
		})
		$("#lista_estados").change(function() {
			$.ajax({
				data: "id_estado=" + $("#lista_estados").val(),
				url: 'php/ajax_municipios.php',
				type: 'post',
				dataType: 'json',
				beforeSend: function() {},
				success: function(response) {
					var html = "";
					$.each(response, function(index, value) {
						html += '<option value="' + value.id + '">' + value.nombre +
							"</option>";
					});
					$("#lista_municipios").html(html);
					$("#lista_parroquias").html("");
				},
				error: function() {
					alert("error")
				}
			});
		})
		$("#lista_municipios").change(function() {
			$.ajax({
				data: "id_municipio=" + $("#lista_municipios").val(),
				url: 'php/ajax_parroquias.php',
				type: 'post',
				dataType: 'json',
				beforeSend: function() {},
				success: function(response) {
					var html = "";
					$.each(response, function(index, value) {
						html += '<option value="' + value.id + '">' + value.nombre +
							"</option>";
					});
					$("#lista_parroquias").html(html);
				},
				error: function() {
					alert("error")
				}
			});
		})
	</script>
</body>

</html>

<script>
	// Obtén todos los selectores de preguntas de seguridad
	let selects = document.querySelectorAll('.quest-question');

	// Añade un evento 'change' a cada selector
	selects.forEach((select) => {
		select.addEventListener('change', function() {
			// Al cambiar una opción, actualiza las opciones disponibles en todos los selectores
			updateOptions(this);
		});
	});

	function updateOptions(changedSelect) {
		// Obtén todas las opciones seleccionadas
		let selectedOptions = Array.from(selects).map((select) => select.value);

		// Recorre cada selector
		selects.forEach((select) => {
			// Recorre cada opción en el selector
			Array.from(select.options).forEach((option) => {
				// Si la opción ya está seleccionada en otro selector y no es la opción actualmente seleccionada en este selector, deshabilítala
				if (selectedOptions.includes(option.value) && option.value !== select.value) {
					option.disabled = true;
				} else {
					// De lo contrario, habilítala
					option.disabled = false;
				}
			});
		});
	}
</script>