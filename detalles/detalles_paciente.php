<?php
	session_start();
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');

	if (!isset($_SESSION['username'])) {
		header('Location: ../index.php');
		exit;
	}

	include "../php/conexion.php";
	$user = new CodeaDB();

	require '../php/permisos.php';

	$rol = $_SESSION['Rol'];

	$paginaActual = basename($_SERVER['PHP_SELF']);

	if (!in_array($paginaActual, $permisos[$rol])) {
		header('Location: ../sin_permiso.php', true, 303);
		exit();
	}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Listado de Pacientes</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="../css/styles_higea.css?v=1.2">
	<link rel="icon" type="image/png" href="../images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
	<link href="../css/select2.min.css" rel="stylesheet" />
	<script src="../js/jquery-3.7.1.js"></script>
	<script src="../js/select2.min.js"></script>

	<link href="../css/sweetalert2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/sweetalert2.min.css?v=1.2">
</head>

<body class="login-register">
	<div class="sidebar close">
		<a href="../home.php">
			<div class="logo-details">
				<img class="logo" src="../images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
				<img class="logo_name" src="../images/Letras.png" alt="HIGEA" width="135" height="40">
			</div>
		</a>
		<ul class="nav-links">
			<li>
				<a href="../registro-paciente.php">
					<i class="fi fi-sr-hospital-user"></i>
					<span class="link_name">Pacientes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../registro-paciente.php">Pacientes</a></li>
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
					<li><a href="../registro-citologia.php">Citología</a></li>
					<li><a href="../registro-biopsia.php">Biopsia</a></li>
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
					<li><a href="../registro-pagos.php">Nueva Factura</a></li>
					<li><a href="detalles_pagos.php">Lista de Facturas</a></li>
				</ul>
			</li>
			<li>
				<a href="../registro-examen.php">
					<i class="fi fi-sr-flask"></i>
					<span class="link_name">Exámenes</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../registro-examen.php">Exámenes</a></li>
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
					<li><a href="../registro-informes.php">Registrar</a></li>
					<li><a href="../visualizar-informe.php">Visualizar</a></li>
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
					<li><a href="../registro-insumo.php">Registrar</a></li>
					<li><a href="../visualizar-insumo.php">Visualizar</a></li>
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
					<li><a href="detalles_paciente.php">Pacientes</a></li>
					<li><a href="detalles_muestras.php">Muestras</a></li>
					<li><a href="detalles_insumo.php">Insumos</a></li>
				</ul>
			</li>
			<li>
				<a href="../gestion/gestion_usuarios.php">
					<i class="fi fi-sr-users-alt"></i>
					<span class="link_name">Gestión de usuarios</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../gestion/gestion_usuarios.php">Gestión de usuarios</a></li>
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
					<li><a href="../info_lab.php">Sobre el Lab.</a></li>
					<li><a href="../info_higea.php">Sobre HIGEA</a></li>
					<li><a href="../developers.php">Developers</a></li>
					<li><a href="../ayuda.php">Ayuda</a></li>
				</ul>
			</li>
			<li>
				<div class="profile-details">
					<a href="../php/exit.php">
						<i class="fi fi-sr-exit"></i>
						<span class="link_name">Salir</span>
					</a>
					<ul class="sub-menu blank">
						<li><a class="link_name" href="../php/exit.php">Salir</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<main class="home-section">
		<div class="home-content">
			<i class="fi fi-sr-menu-burger bx-menu"></i>
			<a href="../mantenimiento/php/Gestion-BDD.php"><i class="fi fi-sr-settings bx-menu"></i></a>
		</div>

		<h1 style="text-align: center;" class="table-title">Listado de Pacientes</h1>

        <!-- Cuadro de Busqueda de la Tabla -->
		<div class="items">
			<input type="text" id="filtro" onkeyup="filtrarTabla()" placeholder="Filtrar por Nombre, Cedula, Fecha, etc...">
        </div>

        <!-- Tabla con el Listado de Pacientes -->
		<div class="center-table">
			<table style="text-align: center;" class="table" id="table">
				<thead>
					<th>C.I.</th>
					<th>Nombres y Apellidos</th>
					<th>Fecha de Nacimiento</th>
					<th>Género</th>
					<th>Teléfono</th>
					<th>E-mail</th>
					<th>Acciones</th>
				</thead>
				<?php
				// Busca todos los pacientes almacenados en la BDD
				$listaPacientes = $user->buscar("paciente", "1");
				foreach ($listaPacientes as $cedula_paciente) :

					$cedula = $cedula_paciente['CIP'];
					$ci_sql = "CI = '$cedula';";

					$pacientes = $user->buscar("persona", $ci_sql);
					foreach ($pacientes as $paciente) :

				?>
				<tbody>
					<tr>
						<?php

						// Combina los nombres del paciente en una sola variable
							$nombre_completo = $paciente['PN'] . " " . $paciente['SN'] . " " . $paciente['TN'] . " " . $paciente['PA'] . " " . $paciente['SA'];

						// Busca las variables a mostrar en la tabla
							$genero = ($paciente['Sexo'] == "M") ? "Masculino" : "Femenino";

							$telefono = $user->buscar("telefono", $ci_sql);
							$tlfn = $telefono[0]['Nro_Telf'];

							$correo = $user->buscar("correo", $ci_sql);
							$email = $correo[0]['Correo'];

							$f_nac = $paciente['F_nac'];
							$f_nac_formateada = date('d-m-Y', strtotime($f_nac));

						// Muestra los datos en forma de tabla
							echo ("<td>" . $cedula . "</td>");
							echo ("<td>" . $nombre_completo . "</td>");
							echo ("<td>" . $f_nac_formateada . "</td>");
							echo ("<td>" . $genero . "</td>");
							echo ("<td>" . $tlfn . "</td>");
							echo ("<td>" . $email . "</td>");
							echo ("<td><form action='./edit_paciente.php' method='post'><input type='hidden' name='ci' value='$cedula' required><input type='submit' value='Editar'></form></td>")

						?>
					</tr>
				</tbody>
				<?php

					endforeach;

				endforeach;
				?>
			</table>
		</div>
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

        // Funcion de filtrado para el campo de busqueda
        function filtrarTabla() {
            // Obtener el valor ingresado en el campo de entrada
            var filtro = document.getElementById("filtro").value.toUpperCase();

            // Obtener la tabla y las filas de la tabla
            var tabla = document.getElementById("table");
            var filas = tabla.getElementsByTagName("tr");

            // Recorrer las filas de la tabla y mostrar u ocultar según el filtro
            for (var i = 1; i < filas.length; i++) {
                var celdas = filas[i].getElementsByTagName("td");
                var mostrarFila = false;

                // Comparar el valor del filtro con cada celda de la fila
                for (var j = 0; j < celdas.length; j++) {
                    var contenidoCelda = celdas[j].textContent || celdas[j].innerText;
                    if (contenidoCelda.toUpperCase().indexOf(filtro) > -1) {
                        mostrarFila = true;
                        break;
                    }
                }

                // Mostrar u ocultar la fila según el resultado de la comparación
                if (mostrarFila) {
                    filas[i].style.display = "";
                } else {					
                    filas[i].style.display = "none";
                }
            }
        }
	</script>
</body>

</html>