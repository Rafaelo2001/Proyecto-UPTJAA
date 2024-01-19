<?php

    // session_start();
    // header('Cache-Control: no-cache, no-store, must-revalidate');
    // header('Pragma: no-cache');
    // header('Expires: 0');

    // if(!isset($_SESSION['username'])) {
    //     header('Location: index.php');
    //     exit;
//     Texto:

    // Turquesa oscuro: 3, 94, 115
    // Rojo: 225, 22, 31
    // Negro: 13, 13, 13
    // }

    include "../php/conexion.php";
    $user = new CodeaDB();

    require('../fpdf/fpdf.php');

    class PDF extends FPDF
    {
        function Header(){
            $this->Image('../images/logo.png', 10, 0, 50); 

            $this->SetFont('Montserrat-Regular','',12);

            $this->SetFillColor(186, 236, 247);
            
            $this->SetXY(60,23);
            
            $direccionCabecera1 = mb_convert_encoding(' Médico Anatomopatologo ', 'ISO-8859-1');
            $this->Cell(58,8,$direccionCabecera1,0,2,"C",true);
            $this->SetFontSize(10);
            $direccionCabecera2 = mb_convert_encoding('Citologías y Biopsias', 'ISO-8859-1');
            $this->Cell(58,7,$direccionCabecera2,0,0,"C", true);

            $this->SetXY(130,25);
            $this->SetFont('Montserrat-Bold','',18);
            $n_citologia = mb_convert_encoding("CITOLOGÍA N°: ".$_POST["id_c"], "ISO-8859-1");
            $this->Cell(67,10,$n_citologia,0,0,"C");

            $this->Ln(25);
        }
    }

    $citoPDF = new PDF();

    $citoPDF->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
    $citoPDF->AddFont('Montserrat-Bold','','Montserrat-Bold.php');

    $citoPDF-> AddPage('P','Legal');

    $citoPDF-> SetFont('Arial', '', 10);

    $urraca = mb_convert_encoding('Ñaméz', 'ISO-8859-1');
    // $urraca = "Ñaméz";

    
    // Datos para cabecera
        $fecha = date("d/m/Y", strtotime($_POST["fecha"]));
        
        $datosPaciente = $user->buscar("persona","CI=".$_POST["cip"]);
            $nombrePaciente = strtoupper($datosPaciente[0]["PN"].' '.$datosPaciente[0]["PA"]);
            $edadPaciente = $datosPaciente[0]["Edad"].mb_convert_encoding(" años","ISO-8859-1");
            $sexoPaciente = $datosPaciente[0]["Sexo"];

        $nombreMedico = mb_convert_encoding(strtoupper($_POST["medico"]), "ISO-8859-1");
    

    // Primera Fila de Datos del Paciente
        $citoPDF->SetTextColor(3, 94, 115);
            $fechaLargo = $citoPDF->GetStringWidth("Fecha: ");
            $citoPDF->Cell($fechaLargo,10,"Fecha: ",0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(35-$fechaLargo,10,$fecha,0,0);

        $citoPDF->setX(50);

        $citoPDF->SetTextColor(3, 94, 115);
            $nombreLargo = $citoPDF->GetStringWidth("Nombre:   ");
            $citoPDF->Cell($nombreLargo,10,"Nombre:   ",0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(80-$nombreLargo,10,$nombrePaciente,0,0);

        $citoPDF->setX(140);

        $citoPDF->SetTextColor(3, 94, 115);
            $edadLargo = $citoPDF->GetStringWidth("Edad: ");
            $citoPDF->Cell($edadLargo,10,"Edad: ",0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(40-$edadLargo,10,$edadPaciente,0,0);

        $citoPDF->setX(185);

        $citoPDF->SetTextColor(3, 94, 115);
            $sexoLargo = $citoPDF->GetStringWidth("Sexo: ");
            $citoPDF->Cell($sexoLargo,10,"Sexo: ",0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(35-$sexoLargo,10,$sexoPaciente,0,1);

        // Linea Horinzontal
        $citoPDF->Cell(35,2,'',0,2);
        $citoPDF->Cell(0,0,'',1,2);
        $citoPDF->Cell(35,4,'',0,2);


    // Primera Fila de Datos del Paciente
        $citoPDF->SetTextColor(3, 94, 115);
            $ciLargo = $citoPDF->GetStringWidth("C.I.:   ");
            $citoPDF->Cell($ciLargo,10,"C.I.:   ",0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(35-$ciLargo,10,number_format($_POST["cip"], 0, ",","."),0,0);

        $citoPDF->setX(50);

        $citoPDF->SetTextColor(3, 94, 115);
            $medicoLargo = $citoPDF->GetStringWidth("Médico:   DR(A).");
            $citoPDF->Cell($medicoLargo,10,mb_convert_encoding('Médico:   DR(A).', 'ISO-8859-1'),0,0);
        $citoPDF->SetTextColor(13, 13, 13);
            $citoPDF->Cell(80-$medicoLargo,10,$nombreMedico,0,1);

        $citoPDF->Cell(35,2,'',0,2);
        $citoPDF->Cell(0,0,'',1,0);
    

    $citoPDF-> Output();

?>