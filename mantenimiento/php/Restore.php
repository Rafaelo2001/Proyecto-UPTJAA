<?php
	$tiempoInicio = hrtime(true);

	include './Connet.php';

	$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);

	$sql=explode(";",file_get_contents($restorePoint));

	$totalErrors=0;
	set_time_limit (600);

	$con=mysqli_connect(SERVER, USER, PASS, BD);
	$con->query("SET FOREIGN_KEY_CHECKS=0");

	for($i = 0; $i < (count($sql)-1); $i++){
		if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
	}

	$con->query("SET FOREIGN_KEY_CHECKS=1");
	$con->close();

	$tiempoFinal = hrtime(true);
	$totalTime = ($tiempoFinal - $tiempoInicio) / 1000000000;
	$roundTime = round($totalTime,2);

	if($totalErrors<=0){
		echo "Restauración completada con éxito<br>";
		echo "Tiempo de ejecución: ".$roundTime." segundos";
		echo "<script>
              alert('Restauración completada con éxito.\\nTiempo de ejecución: ".$roundTime." segundos');
              window.location.href = './Gestion-BDD.php'; 
              </script>";     
	}
	else{
		echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente<br>";
		echo "Tiempo de ejecución: ".$roundTime." segundos";
		echo "<script>
              alert('Ocurrio un error inesperado, no se pudo hacer la restauración completamente.\\nTiempo de ejecución: ".$roundTime." segundos');
              window.location.href = './Gestion-BDD.php'; 
              </script>";
	}
?>