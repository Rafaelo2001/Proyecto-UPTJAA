<?php
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
	require("php/conexion.php");

		$user = new CodeaDB();

	// Obtiene el rol del usuario de la variable de sesión
	$rol = $_SESSION['Rol'];

	// Obtiene el nombre de la página actual
	$paginaActual = basename($_SERVER['PHP_SELF']);

	// Verifica si el usuario tiene permiso para acceder a la página actual
	if (!in_array($paginaActual, $permisos[$rol])) {
		// Si el usuario no tiene permiso, muestra una alerta y redirige al usuario
		echo "<script>
					alert('No tienes permiso para acceder a esta página.');
					window.location.href = 'index.php';
			</script>";

		exit();
	}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Home</title>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?v=1.1">

	<link rel="stylesheet" href="css/styles_home.css">
	<link rel="stylesheet" type="text/css" href="css/styles_home.css?v=1.2">

	<link href="css/sweetalert2.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css?v=1.1">

	<script src="js/sweetalert2.all.min.js?v=1.2"></script>

	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

	<style>
		.swal2-popup {
			background: rgb(248, 255, 254);
			background: linear-gradient(135deg, rgba(248, 255, 254, 1) 0%, rgba(171, 255, 255, 1) 100%);
		}
	</style>

</head>

<body class="body-home">

	<header>
		<nav>
			<a href="#" class="title">
				<img src="images/Logo con contorno.png" alt="Logo de Higea" width="115" height="115">
				<img src="images/Letras.png" alt="Higea" width="180px" height="45px">
			</a>

			<ul class="items">
				<button class="buttom"><a href="php/exit.php" class="buttom-item"><i class="fi fi-sr-exit"></i>Salir</a></button>
			</ul>
		</nav>
	</header>

	<div class="grid">
		<a href="detalles/detalles_paciente.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-pacientes.jpg" alt="imagen1">
					<div class="capa">
						<h3>PACIENTES</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="detalles/detalles_muestras.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-muestras.jpg" alt="imagen1">
					<div class="capa">
						<h3>MUESTRAS</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="registro-examen.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-examenes.jpg" alt="imagen1">
					<div class="capa">
						<h3>EXÁMENES</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="detalles/detalles_insumo.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-insumos.jpg" alt="imagen1">
					<div class="capa">
						<h3>INSUMOS</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="visualizar-informe.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-informes.jpg" alt="imagen1">
					<div class="capa">
						<h3>INFORMES MÉDICOS</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="registro-pagos.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-factura.jpg" alt="imagen1">
					<div class="capa">
						<h3>FACTURACIÓN</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="#">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-usuarios.jpg" alt="imagen1">
					<div class="capa">
						<h3>GESTIÓN DE USUARIOS</h3>
					</div>
				</figure>
			</div>
		</a>

		<a href="mantenimiento/php/Gestion-BDD.php">
			<div class="imagen-hover">
				<figure>
					<img src="images/home-mantenimiento.jpg" alt="imagen1">
					<div class="capa">
						<h3>MANTENIMIENTO</h3>
					</div>
				</figure>
			</div>
		</a>

	</div>

		<br>

	<div class="grid-lower">
		<section class="info-muestra">
			<?php
				$n_examenes = count($user->buscar("m_remitido","Examinado = 0"));

				echo("<h2>Muestras por Analizar: <big>$n_examenes</big></h2>");
			?>
		</section>
		<section class="info-muestra">
			<h2>Insumos por Reponer:</h2>
			<?php
				$lista_insumos = $user->buscar("insumo","1");
				$lista_reponer = "";

				foreach($lista_insumos as $insumo):
					$material = ucfirst($insumo['Material']);
					$existencia = $insumo['Existencia'];
					$minimoRojo = $insumo['Cant_minima'];

					if($insumo['Consumo_Biop'] > $insumo['Consumo_Cito']){
						$minimoAmarillo = $insumo['Consumo_Biop']*3;
					}
					else{
						$minimoAmarillo = $insumo['Consumo_Cito']*3;
					}
					
					if($existencia < $minimoRojo){
						$lista_reponer .= "<li style='background: #DA3838;'><h3>$material (URGENTE)</h3></li>";
					}
					elseif($existencia < $minimoAmarillo){
						$lista_reponer .= "<li style='background: yellow;'><h3>$material</h3></li>";
					}
				endforeach;

				if(empty($lista_reponer)){
					echo("<h3 style='text-align: center; background-color: lightgreen; padding: 0 10px; border-radius: 5px;'>Materiales en cantidades suficientes</h3>");
				}
				else{
					echo("<ul>");
					echo($lista_reponer);
					echo("</ul>");
				}
			?>
		</section>
	</div>

	<br>
	<br>
	<br>
	<br>

	<footer>
		<div class="div-footer">
			<img src="images/Logo.png" alt="Logo de Higea" width="70" height="70">
			<img src="images/higea_color.png" alt="Logo de Higea" width="70" height="70">
			<span class="copyright">&copy; 2024 HIGEA - Laboratorio Dr. Miguel Blanco. Todos los derechos
				reservados.</span>
		</div>
	</footer>

	<script>
		Swal.fire({
			position: 'center',
			html: '<img src="images/higea_color.png" style="width:150px;height:150px;"><p>¡Inicio de sesión exitoso, le damos la bienvenida a HIGEA!</p>',
			title: '¡Bienvenido usuario!',
			showConfirmButton: false,
			timer: 15000,
			showCloseButton: true
		});
	</script>



</body>

</html>