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
	<title>Registro de Insumos</title>
	<link rel="stylesheet" href="css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
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

	<section class="home-section">
		<div class="home-content">
			<i class="fi fi-sr-menu-burger bx-menu"></i>
			<a href="mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
		</div>

		<div class="register-box-supplies">
			<h1>REGISTRO DE INSUMOS</h1>
			<h4>Obligatorio (*).</h4>
			<form action="php/insert-insumo.php" method="post" class="form" id="form">

				<!-- Se usan para el procesamiento 6 envases de alcohol cada uno con 400cc, 
			Tres envases con xilol cada uno de 400 cc
			Y dos envases con parafina líquida cada uno con 400 cc. 
			Estas cantidades se reponen una vez al mes. -->

				<div class="grid">

					<!--group: material-->
					<div class="form-group" id="group_material">
						<div class="form-group-input">
							<label for="material">Material (*)</label>
							<input type="text" name="material" id="material" required placeholder="Nombre del material" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: unidades-->
					<div class="form-group" id="group_duration">
						<div class="form-group-input">
							<label for="unidades">Unidades (*)</label>
							<input type="text" name="unidades" id="unidades" required placeholder="Unidad de medida" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: cant minima-->
					<div class="form-group" id="group_top">
						<div class="form-group-input">
							<label for="cant_minima">Cantidad Minima (*)</label>
							<input type="number" min="0" name="cant_minima" required id="cant_minima" placeholder="Indique cant. mínima" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: stock-->
					<div class="form-group" id="group_stock">
						<div class="form-group-input">
							<label for="existencia">Existencia</label>
							<input type="number" name="existencia" id="existencia" placeholder="Indique la existencia">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>


					<!--group: consumo_biop-->
					<div class="form-group" id="group_supplier">
						<div class="form-group-input">
							<label for="consumo_biop">Consumo en Biopsias (*)</label>
							<input type="number" min="0" name="consumo_biop" id="consumo_biop" placeholder="Indique cantidad" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>

					<!--group: consumo_cito-->
					<div class="form-group" id="group_supplier">
						<div class="form-group-input">
							<label for="consumo_cito">Consumo en Citologías (*)</label>
							<input type="number" min="0" name="consumo_cito" id="consumo_cito" placeholder="Indique cantidad" required>
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
						</div>
						<p class="form-input-error">Rellene este campo correctamente</p>
					</div>
				</div>

				<div class="form-mess" id="form-mess">
					<p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
				</div>

				<div class="button-container">
					<div class="form__group form__group-btn-submit">
						<input class="button-submit" type="submit" id="registrar" value="Registrar">
					</div>
					<p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
				</div>
			</form>
		</div>
	</section>

	<script>
		let arrow = document.querySelectorAll(".arrow");
		for (var i = 0; i < arrow.length; i++) {
			arrow[i].addEventListener("click", (e) => {
				let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
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

	<script src="js/form-inventory.js"></script>

</body>

</html>