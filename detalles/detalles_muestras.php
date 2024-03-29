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
	<title>Listado de Muestras</title>
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

		<h1 style="text-align: center;" class="table-title">Listado de Muestras</h1>

        <!-- Cuadro de Busqueda de la Tabla -->
		<div class="items">
			<input type="text" id="filtro" onkeyup="filtrarTabla()" placeholder="Filtrar por Nombre, Cedula, Fecha, etc...">
        </div>

        <!-- Tabla con el Listado de Pacientes -->
		<div class="center-table">

			<table style="text-align: center;" class="table" id="table">
				<thead>
					<th>N° Muestra</th>
					<th>ID</th>
					<th>Paciente</th>
					<th>Tipo</th>
					<th>Descripción</th>
					<th>Fecha Entrada</th>
					<th>Examinado</th>
					<th>Acciones</th>
				</thead>
				<?php
				// Busca todas las muestras almacenadas en la BDD
				$busquedaBiopsia = $user->buscar("m_biopsia", "1");
				$busquedaCitologia = $user->buscar("m_citologia", "1");

				$listaMuestras = array_merge($busquedaBiopsia, $busquedaCitologia);
				array_multisort(array_column($listaMuestras, 'ID_M_Remitido'), SORT_ASC, $listaMuestras);

				foreach ($listaMuestras as $m) :

					$material = $user->buscarSINGLE("m_remitido", "ID_M_Remitido = " . $m['ID_M_Remitido']);

				?>
					<tr>
						<?php

						$paciente = $user->buscarSINGLE('persona', 'CI = "' . $material['CI_Paciente'] . '"');

						list($tipo_identidad, $ci_numerica) = explode('-', $paciente['CI']);
						$ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
						$cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

						$datos_paciente = $paciente['PN'] . " " . $paciente['PA'] . " (" . $cedula_formateada . ")";


						// Muestra los datos en forma de tabla
							echo ("<td>" . $m['ID_M_Remitido'] . "</td>");

							if (isset($m["ID_M_Biopsia"])) {
								echo ("<td>B-" . $m["ID_M_Biopsia"] . "</td>");
							} elseif (isset($m["ID_M_Citologia"])) {
								echo ("<td>C-" . $m["ID_M_Citologia"] . "</td>");
							}

							echo ("<td>" . $datos_paciente . "</td>");

							$tipo_m;
							if (isset($m["ID_M_Biopsia"])) {
								$tipo_m = "Biopsia";
							} elseif (isset($m["ID_M_Citologia"])) {
								$tipo_m = "Citología";
							}
							echo ("<td>$tipo_m</td>");

							// Si la descripcion es muy larga, la reduce.
							if (strlen($material['Descripcion_material']) > 30) {
								$Des_corta = substr($material['Descripcion_material'], 0, 30);
								$descripcion = $Des_corta . "...";
								echo ("<td>" . $descripcion . "</td>");
							} else {
								echo ("<td>" . $material['Descripcion_material'] . "</td>");
							}

							$fecha = date("d-m-Y", strtotime($material['F_Entrada']));
							echo ("<td>" . $fecha . "</td>");

							if ($material['Examinado']) {
								echo ("<td>Si</td>");
							} else {
								echo ("<td>No</td>");
							}

						echo ("<td><form action='./edit_muestras.php' method='post'><input type='hidden' name='id_m' value='" . $m['ID_M_Remitido'] . "' required><input type='hidden' name='tipo_m' value='" . $tipo_m . "' required><input type='submit' value='Editar'></form></td>")
						
						?>
					</tr>
				<?php

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