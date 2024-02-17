<?php

	if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['restorePoint'])){
		header('Location: ./Gestion-BDD.php', true, 303);
		exit;
	}

	$tiempoInicio = hrtime(true);

	include './Connet.php';
	require '../../php/sweet.php';

    $alert = new SweetForInsert();
    echo($alert->sweetHead("BACKUP","../../"));

	$restorePoint = SGBD::limpiarCadena($_POST['restorePoint']);

	$sql = explode(";", file_get_contents($restorePoint));

	$totalErrors = 0;
	set_time_limit(1800);

	$con = mysqli_connect(SERVER, USER, PASS, BD);
	$con->query("SET FOREIGN_KEY_CHECKS=0");

	for ($i = 0; $i < (count($sql) - 1); $i++) {
		if ($con->query($sql[$i] . ";")) {
		} else {
			$totalErrors++;
		}
	}

	$con->query("CREATE TRIGGER `call_actualizar_columna_edad` AFTER INSERT ON `telefono` FOR EACH ROW BEGIN CALL actualizar_columna_edad(); END");
	$con->query("CREATE TRIGGER `call_actualizar_update_columna_edad` AFTER UPDATE ON `telefono` FOR EACH ROW BEGIN CALL actualizar_columna_edad(); END");
	$con->query("SET FOREIGN_KEY_CHECKS=1");
	$con->close();

	$tiempoFinal = hrtime(true);
	$totalTime = ($tiempoFinal - $tiempoInicio) / 1000000000;
	$roundTime = round($totalTime, 2);

	if ($totalErrors <= 0) {
		echo($alert->sweetOK("./Gestion-BDD.php","Restauración Completada con Exito","Tiempo de ejecución: $roundTime segundos"));
	} else {
		echo($alert->sweetError("./Gestion-BDD.php","Ocurrio un error inesperado, no se pudo hacer la restauración completamente"));
	}
