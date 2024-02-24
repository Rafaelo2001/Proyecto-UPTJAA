<?php
	// AJAX para la seleccion de muestras para el examen

	if (isset($_POST['CI_Paciente'])) :
		require "conexion.php";
		$user = new CodeaDB();
		$m = $user->buscar("m_remitido", "examinado = 0 AND CI_Paciente='" . $_POST['CI_Paciente'] . "'");

		$material_remitido = [];

		// Si el paciente tiene muestras, ejecuta el if
		if ($m > 0) {
			foreach ($m as $material) {
				// Si la muestra es de biopsia, la guarda en el array $material_remitido
				if ($b = $user->buscar("m_biopsia", "ID_M_Remitido = " . $material['ID_M_Remitido'])) {
					foreach ($b as $m_biopsia) {
						$fecha_formateada = date("d-m-Y", strtotime($material['F_Entrada']));

						if (strlen($material['Descripcion_material']) > 30) {
							$Des_corta = substr($material['Descripcion_material'], 0, 30);
							$descripcion = $Des_corta . "... - ";
						} else {
							$descripcion = $material['Descripcion_material'] . " - ";
						}

						$material_remitido[] = ["id" => $m_biopsia['ID_M_Remitido'], "descripcion" => $descripcion, "fecha" => $fecha_formateada, "tipo" => "b"];
					}
				} 
				// Si la muestra es de vitologia, la guarda en el array $material_remitido
				elseif ($c = $user->buscar("m_citologia", "ID_M_Remitido = " . $material['ID_M_Remitido'])) {
					foreach ($c as $m_citologia) {
						$fecha_formateada = date("d-m-Y", strtotime($material['F_Entrada']));

						if (strlen($material['Descripcion_material']) > 30) {
							$Des_corta = substr($material['Descripcion_material'], 0, 30);
							$descripcion = $Des_corta . "... - ";
						} else {
							$descripcion = $material['Descripcion_material'] . " - ";
						}

						$material_remitido[] = ["id" => $m_citologia['ID_M_Remitido'], "descripcion" => $descripcion, "fecha" => $fecha_formateada, "tipo" => "c"];
					}
				} else {
					$material_remitido[] = ["id" => "", "diagnostico" => "Paciente no posee Material Remitido sin examinar", "fecha" => "", "tipo" => "none"];
				}
			}
		} else {
			// Si no posee muestra, guarda un mensaje de advertencia y lo envia de vuelta
			$material_remitido[] = ["id" => "", "diagnostico" => "Paciente no posee Material Remitido sin examinar", "fecha" => "", "tipo" => "none"];
		}

		// Termina la conexion y envia de vuelta los datos
		die(json_encode($material_remitido));
	endif;
