<?php
	// AJAX para la seleccion de Paroquias
	if (isset($_POST['id_municipio'])) :
		require "conexion.php";
		$user = new CodeaDB();
		$u = $user->buscar("parroquia", "id_municipio=" . $_POST['id_municipio']);
		$html = [];
		foreach ($u as $value)
			$html[] =   ["id" => $value['id_parroquia'], "nombre" => $value['nombre']];
		die(json_encode($html));
	endif;
