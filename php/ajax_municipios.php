<?php
	// AJAX para la seleccion de Municipios
	if (isset($_POST['id_estado'])) :
		require "conexion.php";
		$user = new CodeaDB();
		$u = $user->buscar("municipio", "id_estado=" . $_POST['id_estado']);
		$html = [];
		foreach ($u as $value)
			$html[] =   ["id" => $value['id_municipio'], "nombre" => $value['nombre']];
		die(json_encode($html));
	endif;