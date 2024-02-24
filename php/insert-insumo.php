<?php

session_start(); // Inicia la sesión

// REGISTRO DE NUEVOS INSUMOS

    require "conexion.php";
    require "sweet.php";

    $user  = new CodeaDB();
    $alert = new SweetForInsert();

    echo($alert->sweetHead("Registro de Insumo"));

    $conex = $user->conexion;

    // TABLA: insumo
    $material    = $_POST["material"];
    $unidades    = $_POST["unidades"];
    $cant_minima = $_POST["cant_minima"];
    $existencia  = $_POST["existencia"];
    $consumo_b   = $_POST["consumo_biop"];
    $consumo_c   = $_POST["consumo_cito"];


    // ENVIANDO DATOS

        try {
            // Enviando Insumo
            $sql_insumo = "INSERT INTO insumo (Material, Unidades, Existencia, Cant_minima, Consumo_Biop, Consumo_Cito) VALUES ('$material', '$unidades', '$existencia', '$cant_minima', '$consumo_b', '$consumo_c')";
            $ejecutado_insumo = mysqli_query($conex,$sql_insumo);
            if (!$ejecutado_insumo) {
                throw new Exception("Error al insertar en la tabla 'insumo'" . mysqli_error($conex));
            }
        }
        catch (Exception $e){
            die($alert->sweetError("../registro-insumo.php","Error al guardar datos",$e->getMessage()));
        }


        die ($alert->sweetOK("../registro-insumo.php", "Los datos del insumo se han insertado correctamente"));
