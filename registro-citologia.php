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
	<title>Registro de Citología</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

	<link href="css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
	
	<script src="js/jquery-3.7.1.js"></script>
	<script src="js/select2.min.js"></script>
</head>

<body class="login-register">
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
					<li><a class="link_name" href="gestion/gestion_usuarios.php">Gestión de usuarios</a></li>
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

		<!-- Formulario para el registro de una muestra citologica -->
		<section class="form-register">
			<h1>REGISTRO DE CITOLOGÍA</h1>
			<h4>Obligatorio (*).</h4>
			<form action="php/insert-citologia.php" method="post" class="form" id="form" autocomplete="off">

				<!-- Muestra una lista con todos los pacientes registrados en la BDD -->
				<label for="paciente">Paciente (*)</label>
				<select id="paciente" name="paciente" style="min-width: 100px;" required>
					<option></option>

					<?php $listaPacientes = $user->buscar("paciente", "1"); ?>

					<?php foreach ($listaPacientes as $cedula_paciente) : ?>

						<option value="<?php echo $cedula_paciente['CIP'] ?>">
							<?php
							$cedula = $cedula_paciente['CIP'];
							$ci_sql = "CI = '$cedula';";

							$pacientes = $user->buscar("persona", $ci_sql);
							foreach ($pacientes as $paciente) :

								$nombre_completo = $paciente['PN'] . " " . $paciente['SN'] . " " . $paciente['TN'] . " " . $paciente['PA'] . " " . $paciente['SA'];

								$cedula_a_mostrar = " - C.I.: $cedula";

								echo $nombre_completo, $cedula_a_mostrar;

							endforeach;
							?>
						</option>

					<?php endforeach; ?>
				</select>

				<br><br>
				<!-- Descripcion Material Remitido -->
				<label for="descripcion">Descripcion Material Remitido (*)</label>
				<textarea type="text" name="descripcion" id="descripcion" cols="40" rows="3" placeholder="Escriba una descripcion del material" required></textarea>

				<!-- Resumen Historia Medica -->
				<label for="resumen">Resumen de Historia Clínica (*)</label>
				<textarea type="text" name="resumen" id="resumen" cols="40" rows="3" placeholder="Escriba el resumen" required></textarea>

				<!-- Diagnotico -->
				<label for="diagnostico">Diagnóstico Clínico (*)</label>
				<textarea type="text" name="diagnostico" id="diagnostico" cols="40" rows="3" placeholder="Escriba el diagnóstico" required></textarea>


				<br><br>


				<div class="grid">
					<!-- Lista de Medicos -->
					<div class="form-group" id="group_state">
						<div id="medico_en_bdd">
							<label for="medico">Médico (*)</label>
							<select id="medico" name="medico" required>
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

					<!-- FUR -->
					<div class="form-group" id="group_name_patient3">
						<div class="form-group-input">
							<label for="FUR">Fecha de la Última Regla (*)</label>
							<input type="date" name="FUR" id="FUR" min="1900-01-01" required>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<!-- Script de Validacion de Fecha -->
					<script>
						var hoy = new Date(new Date().getTime() + new Date().getTimezoneOffset() * 60 * 1000 - 4 * 60 * 60 *
							1000);
						var fechaMaxima = hoy.toISOString().split('T')[0];
						document.getElementById("FUR").max = fechaMaxima;
					</script>


				</div>


				<!-- Checkbox de tipos de frotis -->
				<div class="checkbox" id="frotis">
					<h2>Frotis de: (*)</h2>
					<input type="checkbox" name="endocervix" id="endocervix" value="endocervix">
					<label for="endocervix">Endocervix</label>

					<input type="checkbox" name="exocervix" id="exocervix" value="exocervix">
					<label for="exocervix">Exocervix</label>

					<input type="checkbox" name="vagina" id="vagina" value="vagina">
					<label for="vagina">Vagina</label>

					<br>

					<input type="checkbox" name="otro_check" id="otro_check">
					<label for="otro_check">Otro:</label>
					<input type="text" name="otro" id="otro" placeholder="Especifique" disabled>
				</div>

				<!-- Validacion de Frotis -->
				<script>
					document.getElementById('form').addEventListener('submit', function(event) {
						var checkboxes = document.querySelectorAll('#frotis input[type="checkbox"]');
						var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
						if (!checkedOne) {
							alert('Por favor, selecciona al menos una opción de Frotis.');
							event.preventDefault();
						}
					});
				</script>

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
	<script src="js/form-citologia.js"></script>
</body>

</html>