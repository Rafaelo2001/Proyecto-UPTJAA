<?php
session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit;
}

include "php/conexion.php";
$user = new CodeaDB();

require 'php/permisos.php';

$rol = $_SESSION['Rol'];

$paginaActual = basename($_SERVER['PHP_SELF']);

if (!in_array($paginaActual, $permisos[$rol])) {
	header('Location: ./sin_permiso.php', true, 303);

	exit();
}
?>

<!DOCTYPE html>

<html lang="es">

<head>
	<title>Registro de Paciente</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
	
	<!-- Incluye las librerias de JQuery de JS y la de Select2 para mejorar los inputs select -->
	<script src="js/jquery-3.7.1.js"></script>
	<script src="js/select2.min.js"></script>
</head>

<body class="login-register">
	<!-- Barra de navegacion con todos los enlaces del sistema -->
	<div class="sidebar close">
		<a href="home.php">
			<div class="logo-details">
				<img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
				<img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
			</div>
		</a>
		<ul class="nav-links">
			<li>
				<a href="registro-paciente.php">
					<i class="fi fi-sr-hospital-user"></i>
					<span class="link_name">Pacientes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="registro-paciente.php">Pacientes</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-microscope"></i>
						<span class="link_name">Muestras</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Muestras</a></li>
					<li><a href="registro-citologia.php">Citología</a></li>
					<li><a href="registro-biopsia.php">Biopsia</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-file-invoice-dollar"></i>
						<span class="link_name">Facturación</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Facturación</a></li>
					<li><a href="registro-pagos.php">Nueva Factura</a></li>
					<li><a href="detalles/detalles_pagos.php">Lista de Facturas</a></li>
				</ul>
			</li>
			<li>
				<a href="registro-examen.php">
					<i class="fi fi-sr-flask"></i>
					<span class="link_name">Exámenes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="registro-examen.php">Exámenes</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-file-medical-alt"></i>
						<span class="link_name">Informes médicos</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Informes médicos</a></li>
					<li><a href="registro-informes.php">Registrar</a></li>
					<li><a href="visualizar-informe.php">Visualizar</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-box-open-full"></i>
						<span class="link_name">Insumos</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Insumos</a></li>
					<li><a href="registro-insumo.php">Registrar</a></li>
					<li><a href="visualizar-insumo.php">Visualizar</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-eye"></i>
						<span class="link_name">Detalles</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Detalles</a></li>
					<li><a href="detalles/detalles_paciente.php">Pacientes</a></li>
					<li><a href="detalles/detalles_muestras.php">Muestras</a></li>
					<li><a href="detalles/detalles_insumo.php">Insumos</a></li>
				</ul>
			</li>
			<li>
				<a href="gestion/gestion_usuarios.php">
					<i class="fi fi-sr-users-alt"></i>
					<span class="link_name">Gestión de usuarios</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href=gestion/gestion_usuarios.php">Gestión de usuarios</a></li>
				</ul>
			</li>
			<li>
				<div class="iocn-link">
					<a href="#">
						<i class="fi fi-sr-info"></i>
						<span class="link_name">Acerca de</span>
					</a>
					<i class="fi fi-sr-angle-small-down arrow"></i>
				</div>
				<ul class="sub-menu">
					<li><a class="link_name" href="#">Acerca de</a></li>
					<li><a href="info_lab.php">Sobre el Lab.</a></li>
					<li><a href="info_higea.php">Sobre HIGEA</a></li>
					<li><a href="developers.php">Developers</a></li>
					<li><a href="./ayuda.php">Ayuda</a></li>
				</ul>
			</li>
			<li>
				<div class="profile-details">
					<a href="php/exit.php">
						<i class="fi fi-sr-exit"></i>
						<span class="link_name">Salir</span>
					</a>
					<ul class="sub-menu blank">
						<li><a class="link_name" href="php/exit.php">Salir</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<main class="home-section">
		<div class="home-content">
			<i class="fi fi-sr-menu-burger bx-menu"></i>
			<a href="mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
		</div>

		<!-- Formulario para el registro del paciente -->
		<section class="form-register">
			<h1>REGISTRO DE PACIENTE</h1>
			<h4>Obligatorio (*).</h4>
			<form action="php/insert-patient.php" method="post" class="form" id="form" autocomplete="off">

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
					<div class="form-group" id="group_ci_patient">
						<div class="form-group-input">
							<label for="ci">Documento de identidad (*)</label>
							<input id="ci" name="cedula" class="cedula" type="text" maxlength="11" placeholder="Ingrese nro. de documento" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>La cédula debe contener entre 6-8 caracteres, solo puede contener números</p>
						</span>
					</div>

					<script>
						// Validación de documento
						document.getElementById('form').addEventListener('submit', function (e) {
						var input = document.getElementById('ci');

						if (!/^\d{6,10}$/.test(input.value)) {
							// Si la entrada no es válida, previene el envío del formulario
							e.preventDefault();
							alert('Por favor, ingrese un número de cédula válido.');
						}
						});
					</script>

					<!--group: name1-->
					<div class="form-group" id="group_name_patient1">
						<div class="form-group-input">
							<label for="pn">Primer Nombre (*)</label>
							<input id="pn" name="pn" class="pn" type="text" maxlength="45" placeholder="Ingrese su primer nombre" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: name2-->
					<div class="form-group" id="group_name_patient2">
						<div class="form-group-input">
							<label for="sn">Segundo Nombre</label>
							<input id="sn" name="sn" class="sn" type="text" maxlength="45" placeholder="Ingrese su segundo nombre">
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: name3-->
					<div class="form-group" id="group_name_patient3">
						<div class="form-group-input">
							<label for="tn">Tercer Nombre</label>
							<input id="tn" name="tn" class="tn" type="text" maxlength="45" placeholder="Ingrese su tercer nombre">
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: surname1-->
					<div class="form-group" id="group_surname_patient1">
						<div class="form-group-input">
							<label for="pa">Primer Apellido (*)</label>
							<input id="pa" name="pa" class="pa" type="text" maxlength="45" placeholder="Ingrese su primer apellido" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: surname2-->
					<div class="form-group" id="group_surname_patient2">
						<div class="form-group-input">
							<label for="sa">Segundo Apellido</label>
							<input id="sa" name="sa" class="sa" type="text" maxlength="45" placeholder="Ingrese su segundo apellido">
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: datebirth-->
					<div class="form-group" id="group_date_birth">
						<div class="form-group-input">
							<label for="f_nac">Fecha de Nacimiento (*)</label>
							<input id="f_nac" name="f_nac" class="f_nac" type="date" placeholder="(dd/mm/aaaa)" min="1900-01-01" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
					</div>

					<!-- Restriccion del campo date -->
					<script>
						var hoy = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 * 60 *
							1000);
						var fechaMaxima = hoy.toISOString().split('T')[0];
						document.getElementById("f_nac").max = fechaMaxima;
					</script>
				</div>

				<div>
					<label>Sexo (*)</label>
					<div class="radio" id="sexo">
						<input type="radio" name="sexo" id="masculino" value="M" required>
						<label for="masculino">Masculino</label>

						<input type="radio" name="sexo" id="femenino" value="F" required>
						<label for="femenino">Femenino</label>
					</div>
				</div>

				<h2>INFORMACIÓN DE CONTACTO:</h2>
				<div class="grid">
					<!--group: tel-->
					<div class="form-group" id="group_telf_patient">
						<div class="form-group-input">
							<label for="tlfn">Número telefónico (*)</label>
							<input id="tlfn" name="tlfn" class="tlfn" type="tel" maxlength="12" placeholder="Ingrese su nro. telefónico" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>El número telefónico debe tener 11 dígitos</p>
						</span>
					</div>

					<script>
						// Validación del telefono
						document.getElementById('form').addEventListener('submit', function (e) {
						var phoneInput = document.getElementById('tlfn');

						if (!/^\d{11}$/.test(phoneInput.value)) {
							// Si la entrada no es válida, previene el envío del formulario
							e.preventDefault();
							alert('Por favor, ingrese un número de teléfono válido.');
						}
						});
					</script>

					<!--group: e-mail-->
					<div class="form-group" id="group_email_patient">
						<div class="form-group-input">
							<label for="email">Correo electrónico (*)</label>
							<input id="email" name="correo" class="correo" type="email" placeholder="Ingrese su de email" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Formato incorrecto de e-mail: jhon123@example.com</p>
						</span>
					</div>
				</div>

				<h2>INFORMACIÓN DE DIRECCIÓN:</h2>
				<div class="grid">

					<!-- Grupo de listas con los Estados, Municipios, Ciudades y Parroquias -->
					<!--
						Al seleccionar un Estado, carga en el siguiente select todos 
						los Municipios correspondientes, y asi sucesivamente con las Cuidades y Parroquias
					-->

					<!--group: state-->
					<div class="form-group" id="group_state">
						<div class="form-group-input">
							<label for="estados">Estado (*)</label>
							<select id="estados" name="estado" required>

								<option value="" selected disabled>-- Seleccione Estado--</option>

								<?php $listaEstados = $user->buscar("estado", "1"); ?>

								<?php foreach ($listaEstados as $estado) : ?>
									<option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['nombre'] ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: city-->
					<div class="form-group" id="group_city">
						<div class="form-group-input">
							<label for="ciudad">Ciudad (*)</label>
							<select id="ciudades" name="ciudad" required>
								<option value="" selected disabled>-- Seleccione Ciudad--</option>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: municipality-->
					<div class="form-group" id="group_municipality">
						<div class="form-group-input">
							<label for="municipio">Municipio (*)</label>
							<select id="municipios" name="municipio" required>
								<option value="" selected disabled>-- Seleccione Municipio--</option>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: parish-->
					<div class="form-group" id="group_parish">
						<div class="form-group-input">
							<label for="parroquia">Parroquia (*)</label>
							<select id="parroquias" name="parroquia" required>
								<option value="" selected disabled>-- Seleccione Parroquia--</option>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: location-->
					<div class="form-group" id="group_location">
						<div class="form-group-input">
							<label for="localizacion">Punto de referencia (*)</label>
							<input type="text" id="localizacion" name="localizacion" maxlength="250" placeholder="Ingrese su localización" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: sector-->
					<div class="form-group" id="group_sector">
						<div class="form-group-input">
							<label for="sector">Sector (*)</label>
							<input type="text" id="sector" name="sector" maxlength="60" placeholder="Ingrese su sector" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: street-->
					<div class="form-group" id="group_street">
						<div class="form-group-input">
							<label for="calle">Calle (*)</label>
							<input type="text" id="calle" name="calle" maxlength="60" placeholder="Ingrese su calle" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!--group: house-->
					<div class="form-group" id="group_house">
						<div class="form-group-input">
							<label for="nro_casa">Número de casa/apto</label>
							<input type="text" id="nro_casa" name="nro_casa" maxlength="45" placeholder="Ingrese su nro. de casa">
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>
				</div>

				<h2>INFORMACIÓN DE MÉDICO:</h2>

				<!-- Seleccion de Medico -->
				<!-- Se selecciona un medico ya existente, o en caso de no haberlo, se presiona el checkbox y se registra uno nuevo -->

				<div class="grid">
					<!--group: state-->
					<div class="form-group" id="group_state">
						<div id="medico_en_bdd">
							<label for="medicos-bdd">Médico (*)</label>
							<select id="medicos-bdd" name="medico-bdd" required>
								<option value="" selected disabled>-- Selecciona Medico--</option>

								<?php $listaMedicos = $user->buscar("medico", "1"); ?>

								<?php foreach ($listaMedicos as $medico) : ?>
									<option value="<?php echo $medico['ID_Medico'] ?>">
										<?php echo $medico['Nombre_Medico'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<div>
						<div class="checkbox" id="registro_medico_nuevo">
							<input id="registro_medico" name="registro_medico_nuevo" type="checkbox">
							<label for="registro_medico">¿Médico no registrado?</label>
						</div>
					</div>

					<div id="medico_nuevo" style="display: none;">

						<label for="nombre-medico-registro">Nombre Médico (*)</label>
						<input id="nombre-medico-registro" name="nombre-medico-registro" type="text">

						<label for="telefono-medico-registro">Teléfono Médico (*)</label>
						<input id="telefono-medico-registro" maxlength="12" name="telefono-medico-registro" type="tel">
					</div>

					<div id="observaciones">
						<label for="obs">Observaciones</label>
						<input id="obs" name="obs" type="text" maxlength="200">
					</div>

				</div>

				<div class="form-mess" id="form-mess">
					<p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
				</div>

				<div class="button-container">
					<div class="form__group form__group-btn-submit">
						<input class="button-submit" type="submit" name="registrar" id="registrar" value="Registrar">
					</div>
					<p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
				</div>
			</form>
		</section>
	</main>

	<script>
		// Comprueba si el boton de la barra de navegacion fue precionado y muestra por completo el menu lateral
		let arrow = document.querySelectorAll(".arrow");
		for (var i = 0; i < arrow.length; i++) {
			arrow[i].addEventListener("click", (e) => {
				let arrowParent = e.target.parentElement.parentElement;
				arrowParent.classList.toggle("showMenu");
			});
		}
		let sidebar = document.querySelector(".sidebar");
		let sidebarBtn = document.querySelector(".bx-menu");
		console.log(sidebarBtn);
		sidebarBtn.addEventListener("click", () => {
			sidebar.classList.toggle("close");
		});
	</script>

	<!-- Codigo JS necesario para el funcionamiento del formulario -->
	<script src="js/form-paciente.js"></script>
</body>

</html>