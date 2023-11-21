<?php 
	if(isset($_POST['CI_Paciente'])):
		require "conexion.php";
		$user=new CodeaDB();
		$u=$user->buscar("m_remitido","examinado = 1 AND CI_Paciente=".$_POST['CI_Paciente']);    
		$html=[];

		foreach ($u as $value){
			$tipo_examen = $user->buscar("examen", "ID_M_remitido =".$value['ID_M_Remitido']);

			foreach ($tipo_examen as $examen)
			{
				if ($examen['Tipo'] == "citologia")
				{
					$html[] =   ["id"=>$value['ID_M_Remitido'] ,"diagnostico"=>$value['Diagnostico'] ];
				}
			}
		}
		die(json_encode($html));
	endif;
?>