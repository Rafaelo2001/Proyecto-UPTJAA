<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$u=$user->buscar("m_remitido","examinado = 1 AND CI_Paciente='".$_POST['CI_Paciente']."'");    
		$html=[];
		$no_bio = 0;

		if($u)
		{
			foreach ($u as $value)
			{
				if($tipo_examen = $user->buscar("examen", "Tipo = 'biopsia' AND ID_M_remitido =".$value['ID_M_Remitido']))
				{
					foreach ($tipo_examen as $examen)
					{
						$fecha_formateada = date("d-m-Y", strtotime($examen['F_Examen']));

						if(strlen($value['Descripcion_material']) > 30){
							$Des_corta = substr($value['Descripcion_material'],0,30);
							$diagnostico = $Des_corta."... - ";	
						}
						else{
							$diagnostico = $value['Descripcion_material']." - ";
						}

						$html[] = ["id"=>$examen['ID_Examen'] ,"diagnostico"=>$diagnostico, "fecha"=>$fecha_formateada];
					}
				}
				else {	$no_bio++;	}
			}
		}
		
		if(count($u) == 0)
		{	$html[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee examen", "fecha"=>""];	}
		elseif($no_bio == count($u)) 
		{	$html[] = ["id"=>"" ,"diagnostico"=>"Sin examen de biopsia", "fecha"=>""];}

		die(json_encode($html));
	endif;
?>