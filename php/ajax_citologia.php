<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$u=$user->buscar("m_remitido","examinado = 1 AND CI_Paciente=".$_POST['CI_Paciente']);    
		$html=[];

		$cuenta_biop = 0;

		if (count($u) > 0) {
			foreach ($u as $value){
				$tipo_examen = $user->buscar("examen", "ID_M_remitido =".$value['ID_M_Remitido']);
				
				foreach ($tipo_examen as $examen)
				{
					if ($examen['Tipo'] == "citologia")
					{
						$fecha_formateada = date("d-m-Y", strtotime($examen['F_Examen']));
						$diagnostico = $value['Diagnostico']." - ";

						$html[] = ["id"=>$examen['ID_Examen'] ,"diagnostico"=> $diagnostico, "fecha"=>$fecha_formateada ];
					}
					else {
						$cuenta_biop++;
					}
				}
			}
		}

		if (count($u) == 0) {
			$html[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee examen", "fecha"=>"" ];
		}
		elseif ($cuenta_biop == count($u)) {
			$html[] = ["id"=>"" ,"diagnostico"=>"Sin examen de citología", "fecha"=>"" ];
		}

		die(json_encode($html));
	endif;
?>