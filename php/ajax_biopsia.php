<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$u=$user->buscar("m_remitido","examinado = 1 AND CI_Paciente=".$_POST['CI_Paciente']);    
		$html=[];

		$cuenta_cito = 0;

		if (count($u) > 0) {
			foreach ($u as $value){
				$tipo_examen = $user->buscar("examen", "ID_M_remitido =".$value['ID_M_Remitido']);

				foreach ($tipo_examen as $examen)
				{
					if ($examen['Tipo'] == "biopsia")
					{
						$fecha_formateada = date("d-m-Y", strtotime($examen['F_Examen']));
						$diagnostico = $value['Descripcion_material']." - ";

						$html[] = ["id"=>$examen['ID_Examen'] ,"diagnostico"=>$diagnostico, "fecha"=>$fecha_formateada ];
					}
					else {
						$cuenta_cito++;
					}
				}
			}
		}

		if (count($u) == 0) {
			$html[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee examen", "fecha"=>"" ];
		}
		elseif ($cuenta_cito == count($u)) {
			$html[] = ["id"=>"" ,"diagnostico"=>"Sin examen de biopsia", "fecha"=>"" ];
		}

		die(json_encode($html));
	endif;
?>