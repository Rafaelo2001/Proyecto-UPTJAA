<?php
session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit;
}

include "../../php/conexion.php";
$user = new CodeaDB();

// Incluye el archivo de permisos
require '../../php/permisos.php';

// Obtiene el rol del usuario de la variable de sesión
$rol = $_SESSION['Rol'];

// Obtiene el nombre de la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Verifica si el usuario tiene permiso para acceder a la página actual
if (!in_array($paginaActual, $permisos[$rol])) {
	header('Location: ../../sin_permiso.php', true, 303);
	exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Mantenimiento</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="../../css/styles_higea.css?v=1.2">
	<link rel="icon" type="image/png" href="../../images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
	<script src="../../js/jquery-3.7.1.js"></script>
</head>

<body class="login-register" style="text-align: center;">

	<div class="sidebar close">
		<a href="../../home.php">
			<div class="logo-details">
				<img class="logo" src="../../images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
				<img class="logo_name" src="../../images/Letras.png" alt="HIGEA" width="135" height="40">
			</div>
		</a>
		<ul class="nav-links">
			<li>
				<a href="../../registro-paciente.php">
					<i class="fi fi-sr-hospital-user"></i>
					<span class="link_name">Pacientes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../../registro-paciente.php">Pacientes</a></li>
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
					<li><a href="../../registro-citologia.php">Citología</a></li>
					<li><a href="../../registro-biopsia.php">Biopsia</a></li>
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
					<li><a href="../../registro-pagos.php">Nueva Factura</a></li>
					<li><a href="../../detalles/detalles_pagos.php">Lista de Facturas</a></li>
				</ul>
			</li>
			<li>
				<a href="../../registro-examen.php">
					<i class="fi fi-sr-flask"></i>
					<span class="link_name">Exámenes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../../registro-examen.php">Exámenes</a></li>
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
					<li><a href="../../registro-informes.php">Registrar</a></li>
					<li><a href="../../visualizar-informe.php">Visualizar</a></li>
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
					<li><a href="../../registro-insumo.php">Registrar</a></li>
					<li><a href="../../visualizar-insumo.php">Visualizar</a></li>
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
					<li><a href="../../detalles/detalles_paciente.php">Pacientes</a></li>
					<li><a href="../../detalles/detalles_muestras.php">Muestras</a></li>
					<li><a href="../../detalles/detalles_insumo.php">Insumos</a></li>
				</ul>
			</li>
			<li>
				<a href="../../gestion/gestion_usuarios.php">
					<i class="fi fi-sr-users-alt"></i>
					<span class="link_name">Gestión de usuarios</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../../gestion/gestion_usuarios.php">Gestión de usuarios</a></li>
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
					<li><a href="../../info_lab.php">Sobre el Lab.</a></li>
					<li><a href="../../info_higea.php">Sobre HIGEA</a></li>
					<li><a href="../../developers.php">Developers</a></li>
					<li><a href="../../ayuda.php">Ayuda</a></li>
				</ul>
			</li>
			<li>
				<div class="profile-details">
					<a href="../../php/exit.php">
						<i class="fi fi-sr-exit"></i>
						<span class="link_name">Salir</span>
					</a>
					<ul class="sub-menu blank">
						<li><a class="link_name" href="../../php/exit.php">Salir</a></li>
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
		<section class="form-register">

			<div class="center">
				<h1>MANTENIMIENTO</h1>

				<h2>BACKUP</h2>

				<div class="button-container">
					<div class="form__group form__group-btn-submit">
					<a href="./Backup.php" class="buttom-item"><button class="buttom" style="color: white;">Realizar copia de seguridad</button></a>
					</div>
					<!--<p class="form-mess-good" id="form-mess-good">¡Formulario enviado exitosamente!</p>-->
				</div>

				

				<form action="./Restore.php" method="POST" class="form" id="form" autocomplete="off">

					<h2>RESTORE</h2>

					<label for="restorePoint">Selecciona un punto de restauración</label><br>
					<select name="restorePoint" required>
						<option value="" disabled selected>Selecciona un punto de restauración</option>
						<?php
						include_once './Connet.php';
						$ruta = BACKUP_PATH;
						if (is_dir($ruta)) {
							if ($aux = opendir($ruta)) {
								while (($archivo = readdir($aux)) !== false) {
									if ($archivo != "." && $archivo != "..") {
										$nombrearchivo = str_replace(".sql", "", $archivo);
										$nombrearchivo = str_replace("-", ":", $nombrearchivo);
										$ruta_completa = $ruta . $archivo;
										if (is_dir($ruta_completa)) {
										} else {
											echo '<option value="' . $ruta_completa . '">' . $nombrearchivo . '</option>';
										}
									}
								}
								closedir($aux);
							}
						} else {
							echo $ruta . " No es ruta válida";
						}
						?>
					</select>
					<br>

					<input class="button-submit" type="submit" id="restaurar" value="Restaurar">
				</form>
			</div>
		</section>
	</main>

	<script>
		// Comprueba si el boton de la barra de navegacion fue precionado y muestra por completo el menu lateral
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

</body>

</html>