<?php
	// AJAX para la seleccion de Ciudades
	if (isset($_POST['id_estado'])) :
		require "conexion.php";
		$user = new CodeaDB();
		$u = $user->buscar("ciudad", "id_estado=" . $_POST['id_estado']);
		$html = [];
		foreach ($u as $value)
			$html[] =   ["id" => $value['id_ciudad'], "nombre" => $value['nombre']];
		die(json_encode($html));
	endif;
