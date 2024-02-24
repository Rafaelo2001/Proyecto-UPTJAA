<?php
	// AJAX para la visualizacion de datos de Insumo
    if (isset($_POST["id_insumo"])) {
        require "conexion.php";
        $user = new CodeaDB();

        $id_insumo = $_POST["id_insumo"];
        $insumo_raw = $user->buscar("insumo", "ID_Insumo = '$id_insumo'");

        $insumo[] = [
            "material" => $insumo_raw[0]["Material"],
            "existencia" => $insumo_raw[0]["Existencia"],
            "unidades"  => $insumo_raw[0]["Unidades"],
            "cant_minima" => $insumo_raw[0]["Cant_minima"]
        ];

        die(json_encode($insumo));
    }
