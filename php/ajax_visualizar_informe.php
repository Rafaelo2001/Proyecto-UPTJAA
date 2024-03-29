<?php
    // Busqueda de datos del Informe selecionado
    if (isset($_POST["ID_Informe"])) :
        require "conexion.php";
        $user = new CodeaDB();

        $u = $user->buscar("informe", "ID_Informe=" . $_POST["ID_Informe"]);
        $datosInforme = [];

        if ($u) {
            foreach ($u as $informe) {
                $medico = $user->buscar("medico", "ID_Medico =" . $informe["ID_Medico"]);
                $nombreMedico = $medico[0]["Nombre_Medico"];

                if ($inf_biop = $user->buscar("inf_biopsia", "ID_Informe=" . $_POST["ID_Informe"])) {
                    foreach ($inf_biop as $b) {
                        $datosInforme[] = [
                            "id_inf"    => $informe["ID_Informe"],
                            "fecha"     => $informe["Fecha"],
                            "des_mr"    => $informe["Descripcion_M_Remitido"],
                            "diag"      => $informe["Diagnostico"],
                            "obs"       => $informe["Observacion"],
                            "cip"       => $informe["CIP"],
                            "medico"    => $nombreMedico,

                            "tipo"      => "Biopsia",
                            "id_b"      => $b["ID_Inf_Biopsia"],
                            "des_macro" => $b["Desc_Macro"],
                            "des_micro" => $b["Desc_Micro"],

                            "error" => 0
                        ];
                    }
                } elseif ($inf_cito = $user->buscar("inf_citologia", "ID_Informe=" . $_POST["ID_Informe"])) {
                    foreach ($inf_cito as $c) {
                        $datosInforme[] = [
                            "id_inf"    => $informe["ID_Informe"],
                            "fecha"     => $informe["Fecha"],
                            "des_mr"    => $informe["Descripcion_M_Remitido"],
                            "diag"      => $informe["Diagnostico"],
                            "obs"       => $informe["Observacion"],
                            "cip"       => $informe["CIP"],
                            "medico"    => $nombreMedico,

                            "tipo"      => "Citologia",
                            "id_c"      => $c["ID_Inf_Citologia"],
                            "calidad"   => $c["Calidad"],
                            "ctg_gnrl"  => $c["Categ_Gral"],
                            "hallazgos" => $c["Hallazgos"],
                            "conducta"  => $c["Conducta"],

                            "error" => 0
                        ];
                    }
                } else {
                    $datosInforme[] = [
                        "error" => 1,
                        "error_msj" => "Informe no encontrado"
                    ];
                }
            }
        } else {
            $datosInforme[] = ["error" => 1, "error_msj" => "ID de informe no valido"];
        }
        die(json_encode($datosInforme));
    endif;
