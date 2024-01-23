<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$u=$user->buscar("m_remitido","examinado = 1 AND CI_Paciente='".$_POST['CI_Paciente']."'");    
		$html=[];
		$no_cito = 0;

		if($u)
		{
			foreach ($u as $value)
			{
				if($tipo_examen = $user->buscar("examen", "Tipo = 'citologia' AND ID_M_remitido =".$value['ID_M_Remitido']))
				{
					foreach ($tipo_examen as $examen)
					{
						$fecha_formateada = date("d-m-Y", strtotime($examen['F_Examen']));
						$diagnostico = $value['Descripcion_material']." - ";

						$html[] = ["id"=>$examen['ID_Examen'] ,"diagnostico"=>$diagnostico, "fecha"=>$fecha_formateada];
					}
				}
				else {	$no_cito++;	}
			}
		}
		elseif($no_cito == count($u)) {
			$html[] = ["id"=>"" ,"diagnostico"=>"Sin examen de citología", "fecha"=>""];
		}
		else
		{	$html[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee examen", "fecha"=>""];	}

		die(json_encode($html));
	endif;
?>