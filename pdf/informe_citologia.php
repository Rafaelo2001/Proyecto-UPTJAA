<?php

session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

include "../php/conexion.php";
$user = new CodeaDB();

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        if ($this->PageNo() == 1)
        {
            $this->Image('../images/logo.png', 10, 0, 50);

            $this->SetFont('Montserrat-Regular', '', 12);

            $this->SetFillColor(186, 236, 247);

            $this->SetXY(60, 23);

            $direccionCabecera1 = mb_convert_encoding(' Médico Anatomopatologo ', 'ISO-8859-1');
            $this->Cell(58, 8, $direccionCabecera1, 0, 2, "C", true);
            $this->SetFontSize(10);
            $direccionCabecera2 = mb_convert_encoding('Citologías y Biopsias', 'ISO-8859-1');
            $this->Cell(58, 7, $direccionCabecera2, 0, 0, "C", true);

            $this->SetXY(130, 25);
            $this->SetFont('Montserrat-Bold', '', 18);
            $n_citologia = mb_convert_encoding("CITOLOGÍA N°: " . $_POST["id_c"], "ISO-8859-1");
            $this->Cell(67, 10, $n_citologia, 0, 0, "C");
        
            $this->Ln(25);
        }
        else
        {
            $this->SetXY(130, 10);
            $this->SetFont('Montserrat-Bold', '', 10);
            $n_citologia = mb_convert_encoding("C-" . $_POST["id_c"], "ISO-8859-1");
            $this->Cell(67, 10, $n_citologia, 0, 0, "R");

            $this->Ln(15);
        }
    }

    function Footer()
    {
            $this->SetFont('Arial', 'BI', 10);

            $this->SetY(-24);
            $this->MultiCell(0, 5, "DR. MIGUEL BLANCO     \nMEDICO ANATOMOPATOLOGO     ", 0, "R");

            $this->SetFont('Arial', 'I', 8);

            $this->Cell(0, 10, mb_convert_encoding("Av. Francisco de Miranda, C.C. Mansión Flamingo, Piso 1, Local N°5, Telf.: (0283) 2356539, El Tigre - Edo. Anzoátegui", "ISO-8859-1"), 0, 0, 'C');
    }
}

// Declaracion del Documento PDF
$c = new PDF();

$c->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');
$c->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');

$c->AddPage('P', 'Letter');

$c->SetFont('Arial', '', 10);


// Cabecera Datos Paciente
// Datos para cabecera
$fecha = date("d/m/Y", strtotime($_POST["fecha"]));

$datosPaciente = $user->buscar("persona", "CI='" . $_POST["cip"] . "'");
$nombrePaciente = strtoupper($datosPaciente[0]["PN"] . ' ' . $datosPaciente[0]["PA"]);
$edadPaciente = $datosPaciente[0]["Edad"] . mb_convert_encoding(" años", "ISO-8859-1");
$sexoPaciente = $datosPaciente[0]["Sexo"];

$nombreMedico = mb_convert_encoding(strtoupper($_POST["medico"]), "ISO-8859-1");


// Primera Fila de Datos del Paciente
$c->SetTextColor(3, 94, 115);
$fechaLargo = $c->GetStringWidth("Fecha: ");
$c->Cell($fechaLargo, 10, "Fecha: ", 0, 0);
$c->SetTextColor(13, 13, 13);
$c->Cell(35 - $fechaLargo, 10, $fecha, 0, 0);

$c->setX(50);

$c->SetTextColor(3, 94, 115);
$nombreLargo = $c->GetStringWidth("Nombre:   ");
$c->Cell($nombreLargo, 10, "Nombre:   ", 0, 0);
$c->SetTextColor(13, 13, 13);
$c->Cell(80 - $nombreLargo, 10, $nombrePaciente, 0, 0);

$c->setX(140);

$c->SetTextColor(3, 94, 115);
$edadLargo = $c->GetStringWidth("Edad: ");
$c->Cell($edadLargo, 10, "Edad: ", 0, 0);
$c->SetTextColor(13, 13, 13);
$c->Cell(40 - $edadLargo, 10, $edadPaciente, 0, 0);

$c->setX(185);

$c->SetTextColor(3, 94, 115);
$sexoLargo = $c->GetStringWidth("Sexo: ");
$c->Cell($sexoLargo, 10, "Sexo: ", 0, 0);
$c->SetTextColor(13, 13, 13);
$c->Cell(35 - $sexoLargo, 10, $sexoPaciente, 0, 1);

// Linea Horinzontal
$c->Cell(35, 2, '', 0, 2);
$c->Cell(0, 0, '', 1, 2);
$c->Cell(35, 4, '', 0, 2);


// Segunda Fila de Datos del Paciente
$c->SetTextColor(3, 94, 115);
$ciLargo = $c->GetStringWidth("C.I.:   ");
$c->Cell($ciLargo, 10, "C.I.:   ", 0, 0);
$c->SetTextColor(13, 13, 13);
list($tipo_identidad, $ci_numerica) = explode('-', $_POST["cip"]);
$ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
$cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;
$c->Cell(35 - $ciLargo, 10, $cedula_formateada, 0, 0);

$c->setX(50);

$c->SetTextColor(3, 94, 115);
$medicoLargo = $c->GetStringWidth("Médico:   DR(A).");
$c->Cell($medicoLargo, 10, mb_convert_encoding('Médico:   DR(A).', 'ISO-8859-1'), 0, 0);
$c->SetTextColor(13, 13, 13);
$c->Cell(80 - $medicoLargo, 10, $nombreMedico, 0, 1);

// Linea Horinzontal
$c->Cell(35, 2, '', 0, 2);
$c->Cell(0, 0, '', 1, 2);
$c->Cell(35, 8, '', 0, 2);


// Informacion de Planilla
// Linea Titulo
$c->SetFont('Arial', 'U', 14);
$c->SetFillColor(186, 236, 247);
$c->SetTextColor(3, 94, 115);
$c->Cell(5, 8, "", 0, 0, "", true);
$c->Cell(0, 8, "MATERIAL REMITIDO", 0, 1, "L", true);

// Standar Font
$c->SetFont('Arial', '', 12);
$c->SetTextColor(13, 13, 13);
$c->cell(0, 3, "", 0, 1);
$c->MultiCell(0, 10, mb_convert_encoding($_POST["des_mr"], 'ISO-8859-1'), 0, 1);
$c->cell(0, 3, "", 0, 1);

// Linea Titulo
$c->SetFont('Arial', 'U', 14);
$c->SetFillColor(186, 236, 247);
$c->SetTextColor(3, 94, 115);
$c->Cell(5, 8, "", 0, 0, "", true);
$c->Cell(0, 8, mb_convert_encoding("INFORME CITOLÓGICO", 'ISO-8859-1'), 0, 1, "C", true);

// Calidad de Muestra
$c->SetFont('Arial', 'U', 10);
$c->SetTextColor(13, 13, 13);
$c->cell(0, 3, "", 0, 1);
$c->cell($c->GetStringWidth("CALIDAD DE LA MUESTRA"), 10, "CALIDAD DE LA MUESTRA", 0, 0);
$c->SetFont('Arial', '', 10);
$c->cell(3, 10, ": ", 0, 0);
$c->MultiCell(0, 10, mb_convert_encoding($_POST["calidad"], 'ISO-8859-1'), 0, 1);

// Categoria General
$c->SetFont('Arial', 'U', 10);
$c->SetTextColor(13, 13, 13);
$c->cell($c->GetStringWidth("CATEGORIA GENERAL"), 10, "CATEGORIA GENERAL", 0, 0);
$c->SetFont('Arial', '', 10);
$c->cell(3, 10, ": ", 0, 0);
$c->MultiCell(0, 10, mb_convert_encoding($_POST["ctg_gnrl"], 'ISO-8859-1'), 0, 1);

// Hallasgos
$c->SetFont('Arial', 'U', 10);
$c->SetTextColor(13, 13, 13);
$c->cell($c->GetStringWidth("HALLAZGOS MICROSCOPICOS"), 10, "HALLAZGOS MICROSCOPICOS", 0, 0);
$c->SetFont('Arial', '', 10);
$c->cell(3, 10, ": ", 0, 1);
$c->cell(5, 0, "", 0, 0);
$c->MultiCell(0, 5, mb_convert_encoding($_POST["hallazgos"], 'ISO-8859-1'), 0, 1);
$c->cell(0, 3, "", 0, 1);

// Diagnostico
$c->SetFont('Arial', 'U', 10);
$c->SetTextColor(13, 13, 13);
$c->cell($c->GetStringWidth("DIAGNOSTICO"), 10, "DIAGNOSTICO", 0, 0);
$c->SetFont('Arial', '', 10);
$c->cell(3, 10, ": ", 0, 1);
$c->cell(5, 0, "", 0, 0);
$c->MultiCell(0, 5, mb_convert_encoding($_POST["diag"], 'ISO-8859-1'), 0, 1);
$c->cell(0, 3, "", 0, 1);

// Conducta
$c->SetFont('Arial', 'U', 10);
$c->SetTextColor(13, 13, 13);
$c->cell($c->GetStringWidth("CONDUCTA"), 10, "CONDUCTA", 0, 0);
$c->SetFont('Arial', '', 10);
$c->cell(3, 10, ": ", 0, 0);
$c->MultiCell(0, 10, mb_convert_encoding($_POST["conducta"], 'ISO-8859-1'), 0, 1);
$c->cell(0, 3, "", 0, 1);


// Comentario/Observacion
$c->SetFont('Arial', 'U', 7);
$c->SetTextColor(13, 13, 13);
$c->cell($c->GetStringWidth("COMENTARIO"), 5, "COMENTARIO", 0, 0);
$c->SetFont('Arial', '', 7);
$c->cell(3, 5, ": ", 0, 0);
$c->MultiCell(0, 5, mb_convert_encoding($_POST["obs"], 'ISO-8859-1'), 0, 1);          

$c->Output();
