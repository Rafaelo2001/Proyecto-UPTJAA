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
	// Si el usuario no tiene permiso, muestra una alerta y redirige al usuario
	echo "<script>
						alert('No tienes permiso para acceder a esta página.');
						window.location.href = 'home.php';
				</script>";

	exit();
}
?>

<!DOCTYPE html>

<html lang="es">

<head>
	<title>Registro de Informe</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/styles_higea.css">
	<link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

	<script src="js/jquery-3.7.1.js"></script>
	<script src="js/select2.min.js"></script>
</head>

<body class="login-register" style="text-align: center;">
	<div class="sidebar close">
		<div class="logo-details">
			<img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
			<img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
		</div>
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
				<a href="registro-pagos.php">
					<i class="fi fi-sr-file-invoice-dollar"></i>
					<span class="link_name">Facturación</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="registro-pagos.php">Facturación</a></li>
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
					<li><a href="#">Ayuda</a></li>
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

		<section class="form-register">
			<h1>REGISTRO DE INFORMES</h1>
			<h4>Obligatorio (*)</h4>
			<form action="" method="post" class="form" id="form" autocomplete="off">

				<div class="grid2">
					<div>
						<div class="radio" id="tipo_informe">
							<input type="radio" name="tipo_informe" class="tipo_informe" id="citologia" value="citologia">
							<label for="citologia">Citología</label>
							<br>
							<input type="radio" name="tipo_informe" class="tipo_informe" id="biopsia" value="biopsia">
							<label for="biopsia">Biopsia</label>
						</div>
					</div>

					<!--group: ci-->
					<div class="form-group" id="group_ci_patient">
						<div class="form-group-input">
							<label for="paciente_id">Paciente (*)</label>
							<select style="min-width: 100px;" id="paciente_id" name="paciente_id" required>
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

											// list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
											// $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
											// $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

											$cedula_a_mostrar = " - C.I.: $cedula";

											echo $nombre_completo, $cedula_a_mostrar;

										endforeach;
										?>
									</option>

								<?php endforeach; ?>
							</select>
						</div>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>La cédula debe contener entre 6-8 caracteres, solo puede contener números</p>
						</span>
					</div>

					<!--group: name1-->
					<div class="form-group" id="group_name_patient1">
						<div class="form-group-input">
							<label for="medico">Medico (*)</label>
							<select id="medico" name="medico_id" style="width: 506px;" required>
								<option></option>

								<?php $listaMedicos = $user->buscar("medico", "1"); ?>
								<?php foreach ($listaMedicos as $medico) : ?>

									<option value=" <?php echo $medico['ID_Medico'] ?> ">
										<?php echo $medico['Nombre_Medico'] ?> </option>

								<?php endforeach; ?>
							</select>
						</div><br><br>
						<hr>
						<span class="form-input-error">
							<i class="formulario_validacion_estado fi fi-rr-cross"></i>
							<p>Rellene este campo correctamente</p>
						</span>
					</div>

					<section id="informe_biopsia" style="display:none">
						<h1>INFORME BIOPSIA</h1>

						<label for="examen_id_b">Examenes del Paciente (*)</label>
						<select id="examen_id_b" name="examen_id_b" required>
							<option value="" selected disabled>Seleccione paciente</option>
						</select>


						<br>


						<label for="info_b">
							<h2>Información de material remitido (*)</h2>
						</label>
						<textarea id="info_b" name="info_b" cols="80" rows="7" style="resize: none;" required></textarea>


						<br>


						<label for="des_macro_b">
							<h2>Descripción Macro (*)</h2>
						</label>
						<textarea id="des_macro_b" name="des_macro_b" cols="80" rows="12" style="resize: none;" required></textarea>


						<br>


						<label for="des_micro_b">
							<h2>Descripción Micro (*)</h2>
						</label>
						<textarea id="des_micro_b" name="des_micro_b" cols="80" rows="12" style="resize: none;" required></textarea>


						<br>


						<label for="diag_b">
							<h2>Diagnostico (*)</h2>
						</label>
						<textarea id="diag_b" name="diag_b" cols="65" rows="15" style="resize: none;" required></textarea>


						<br>


						<label for="obs_b">
							<h2>Obsevaciones/Comentarios (*)</h2>
						</label>
						<textarea id="obs_b" name="obs_b" cols="65" rows="8" style="resize: none;" required></textarea>

						<br>

						<script>
							$("#paciente_id").change(function() {
								$.ajax({
									data: "CI_Paciente=" + $("#paciente_id").val(),
									url: 'php/ajax_biopsia.php',
									type: 'post',
									dataType: 'json',
									beforeSend: function() {},
									success: function(response) {
										var html = "";
										$.each(response, function(index, value) {
											html += '<option value="' + value.id + '">' + value
												.diagnostico + value.fecha + "</option>";
										});
										$("#examen_id_b").html(html);
									},
									error: function() {
										alert("error" + $("#paciente_id").val())
									}
								});
							})
						</script>
					</section>

					<section id="informe_citologia" style="display:none">
						<h1>INFORME CITOLOGÍA</h1>

						<label for="examen_id_c">Examenes del Paciente (*)</label>
						<select id="examen_id_c" name="examen_id_c" required>
							<option value="" selected disabled>Seleccione paciente</option>
						</select>

						<label for="info_c">
							<h2>Información de material remitido (*)</h2>
						</label>
						<textarea id="info_c" name="info_c" cols="80" rows="7" style="resize: none;" required></textarea>


						<br>


						<label for="calidad_c">
							<h2>Calidad de muestras (*)</h2>
						</label>
						<textarea id="calidad_c" name="calidad_c" cols="80" rows="12" style="resize: none;" required></textarea>


						<br>


						<label for="categ_c">
							<h2>Categoría General (*)</h2>
						</label>
						<textarea id="categ_c" name="categ_c" cols="80" rows="12" style="resize: none;" required></textarea>


						<br>


						<label for="hallazgos_c">
							<h2>Hallazgos (*)</h2>
						</label>
						<textarea id="hallazgos_c" name="hallazgos_c" cols="80" rows="12" style="resize: none;" required></textarea>


						<br>


						<label for="diag_c">
							<h2>Diagnostico (*)</h2>
						</label>
						<textarea id="diag_c" name="diag_c" cols="65" rows="15" style="resize: none;" required></textarea>


						<br>


						<label for="conducta_c">
							<h2>Conducta (*)</h2>
						</label>
						<textarea id="conducta_c" name="conducta_c" cols="65" rows="8" style="resize: none;" required></textarea>


						<br>


						<label for="obs_c">
							<h2>Obsevaciones/Comentarios (*)</h2>
						</label>
						<textarea name="obs_c" id="obs_c" cols="65" rows="8" style="resize: none;" required></textarea>

						<br>

						<script>
							$("#paciente_id").change(function() {
								$.ajax({
									data: "CI_Paciente=" + $("#paciente_id").val(),
									url: 'php/ajax_citologia.php',
									type: 'post',
									dataType: 'json',
									beforeSend: function() {},
									success: function(response) {
										var html = "";
										$.each(response, function(index, value) {
											html += '<option value="' + value.id + '">' + value
												.diagnostico + value.fecha + "</option>";
										});
										$("#examen_id_c").html(html);
									},
									error: function() {
										alert("error" + $("#paciente_id").val())
									}
								});
							})
						</script>
					</section>
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


	<script src="js/form-informe.js"></script>
</body>

</html>