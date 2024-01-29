<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$m=$user->buscar("m_remitido","examinado = 0 AND CI_Paciente='".$_POST['CI_Paciente']."'");    
        
		$material_remitido=[];
        
		if($m>0)
		{
			foreach ($m as $material)
			{
				if($b = $user->buscar("m_biopsia", "ID_M_Remitido = ".$material['ID_M_Remitido']))
				{
					foreach ($b as $m_biopsia)
					{
						$fecha_formateada = date("d-m-Y", strtotime($material['F_Entrada']));
						
						if(strlen($material['Descripcion_material']) > 30){
							$Des_corta = substr($material['Descripcion_material'],0,30);
							$descripcion = $Des_corta."... - ";	
						}
						else{
							$descripcion = $material['Descripcion_material']." - ";
						}

						$material_remitido[] = ["id"=>$m_biopsia['ID_M_Remitido'] ,"descripcion"=>$descripcion, "fecha"=>$fecha_formateada, "tipo"=>"b"];
					}
				}
                elseif($c = $user->buscar("m_citologia", "ID_M_Remitido = ".$material['ID_M_Remitido']))
				{
					foreach ($c as $m_citologia)
					{
						$fecha_formateada = date("d-m-Y", strtotime($material['F_Entrada']));

						if(strlen($material['Descripcion_material']) > 30){
							$Des_corta = substr($material['Descripcion_material'],0,30);
							$descripcion = $Des_corta."... - ";	
						}
						else{
							$descripcion = $material['Descripcion_material']." - ";
						}

						$material_remitido[] = ["id"=>$m_citologia['ID_M_Remitido'] ,"descripcion"=>$descripcion, "fecha"=>$fecha_formateada, "tipo"=>"c"];
					}
				}
                else
		        {	$material_remitido[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee Material Remitido sin examinar", "fecha"=>"", "tipo"=>"none"];	}
			}
		}
		else
		{	$material_remitido[] = ["id"=>"" ,"diagnostico"=>"Paciente no posee Material Remitido sin examinar", "fecha"=>"", "tipo"=>"none"];	}

		die(json_encode($material_remitido));
	endif;
?>