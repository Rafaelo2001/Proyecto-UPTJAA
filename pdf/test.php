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
    function Header()
    {
        // $this->SetFont('Arial', 'U', 10);
        // $this->Cell(0, 30, "Watashi o mite MOTTO",1);
        // $this->Ln(30);

        $this->Image('../images/logo.png', 25, -3, 30);

        $this->SetFont('Montserrat-Regular', '', 10);

        $this->SetX(60);
        $direccionCabecera1 = mb_convert_encoding('Av. Francisco de Miranda, C.C. Mansión Flamingo, Piso 1, Local N°5.', 'ISO-8859-1');
        $this->Cell(0, 4, $direccionCabecera1, 0, 2);

        $direccionCabecera2 = mb_convert_encoding('Telf.: (0283) 2356539, El Tigre - Edo. Anzoátegui', 'ISO-8859-1');
        $this->Cell(0, 4, $direccionCabecera2, 0, 2);

        $telefonoCabecera = mb_convert_encoding('RIF. V-04281149-8', 'ISO-8859-1');
        $this->Cell(0, 4, $telefonoCabecera, 0, 1);

        $this->Ln(5);
    }
}

$testPDF = new PDF();

$testPDF->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');
$testPDF->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');

$testPDF->AddPage('P', 'Legal');

$testPDF->SetFont('Arial', 'U', 10);

$urraca = mb_convert_encoding('Ñaméz', 'ISO-8859-1');
// $urraca = "Ñaméz";

$listaPacientes = $user->buscar('paciente', '1');
foreach ($listaPacientes as $cip) {
    $datosPaciente = $user->buscar('persona', 'CI = ' . $cip["CIP"]);

    foreach ($datosPaciente as $info) {
        $pn = mb_convert_encoding($info["PN"], 'ISO-8859-1') . ' ';
        (isset($info['SN']) && $info['SN'] !== '') ? $sn = mb_convert_encoding($info['SN'], 'ISO-8859-1') . ' ' : $sn = '';

        $pa = mb_convert_encoding($info["PA"], 'ISO-8859-1');
        (isset($info['SA']) && $info['SA'] !== '') ? $sa = ' ' . mb_convert_encoding($info['SA'], 'ISO-8859-1') : $sa = '';

        $nombre = $pn . $sn . $pa . $sa;
        $testPDF->Cell(0, 10, $nombre, 1, 1);
    }
}

$testPDF->Output();
?>