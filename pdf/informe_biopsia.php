<?php

    // session_start();
    // header('Cache-Control: no-cache, no-store, must-revalidate');
    // header('Pragma: no-cache');
    // header('Expires: 0');

    // if(!isset($_SESSION['username'])) {
    //     header('Location: index.php');
    //     exit;
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
            $n_biopsia = mb_convert_encoding("BIOPSIA N°: ".$_POST["id_b"], "ISO-8859-1");
            $this->Cell(70,10,$n_biopsia,0,0,"C");

            $this->Ln(25);
        }
    }

    $biopPDF = new PDF();

    $biopPDF->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
    $biopPDF->AddFont('Montserrat-Bold','','Montserrat-Bold.php');

    $biopPDF-> AddPage('P','Legal');

    $biopPDF-> SetFont('Arial', '', 10);

    // Datos para cabecera
        $fecha = date("d/m/Y", strtotime($_POST["fecha"]));
            
        $datosPaciente = $user->buscar("persona","CI=".$_POST["cip"]);
            $nombrePaciente = strtoupper($datosPaciente[0]["PN"].' '.$datosPaciente[0]["PA"]);
            $edadPaciente = $datosPaciente[0]["Edad"].mb_convert_encoding(" años","ISO-8859-1");
            $sexoPaciente = $datosPaciente[0]["Sexo"];

        $nombreMedico = mb_convert_encoding(strtoupper($_POST["medico"]), "ISO-8859-1");


    // Primera Fila de Datos del Paciente
        $biopPDF->SetTextColor(3, 94, 115);
            $fechaLargo = $biopPDF->GetStringWidth("Fecha: ");
            $biopPDF->Cell($fechaLargo,10,"Fecha: ",0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(35-$fechaLargo,10,$fecha,0,0);

        $biopPDF->setX(50);

        $biopPDF->SetTextColor(3, 94, 115);
            $nombreLargo = $biopPDF->GetStringWidth("Nombre:   ");
            $biopPDF->Cell($nombreLargo,10,"Nombre:   ",0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(80-$nombreLargo,10,$nombrePaciente,0,0);

        $biopPDF->setX(140);

        $biopPDF->SetTextColor(3, 94, 115);
            $edadLargo = $biopPDF->GetStringWidth("Edad: ");
            $biopPDF->Cell($edadLargo,10,"Edad: ",0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(40-$edadLargo,10,$edadPaciente,0,0);

        $biopPDF->setX(185);

        $biopPDF->SetTextColor(3, 94, 115);
            $sexoLargo = $biopPDF->GetStringWidth("Sexo: ");
            $biopPDF->Cell($sexoLargo,10,"Sexo: ",0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(35-$sexoLargo,10,$sexoPaciente,0,1);

        // Linea Horinzontal
        $biopPDF->Cell(35,2,'',0,2);
        $biopPDF->Cell(0,0,'',1,2);
        $biopPDF->Cell(35,4,'',0,2);


    // Primera Fila de Datos del Paciente
        $biopPDF->SetTextColor(3, 94, 115);
            $ciLargo = $biopPDF->GetStringWidth("C.I.:   ");
            $biopPDF->Cell($ciLargo,10,"C.I.:   ",0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(35-$ciLargo,10,number_format($_POST["cip"], 0, ",","."),0,0);

        $biopPDF->setX(50);

        $biopPDF->SetTextColor(3, 94, 115);
            $medicoLargo = $biopPDF->GetStringWidth("Médico:   DR(A).");
            $biopPDF->Cell($medicoLargo,10,mb_convert_encoding('Médico:   DR(A).', 'ISO-8859-1'),0,0);
        $biopPDF->SetTextColor(13, 13, 13);
            $biopPDF->Cell(80-$medicoLargo,10,$nombreMedico,0,1);

        $biopPDF->Cell(35,2,'',0,2);
        $biopPDF->Cell(0,0,'',1,0);

    $biopPDF-> Output();

?>