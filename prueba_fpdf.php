<?php
// Incluye la biblioteca FPDF
require 'fpdf/fpdf.php';

// Crea una nueva instancia de la clase FPDF
$pdf = new FPDF('P', 'mm', 'Letter');

// Agrega las fuentes Montserrat-Regular y Montserrat-Bold
$pdf->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
$pdf->AddFont('Montserrat-Bold','','Montserrat-Bold.php');

// Agrega una nueva página al documento PDF
$pdf->AddPage();

// Configura los márgenes
$pdf->SetMargins(25, 25, 25);

// Agrega el logo
$pdf->Image('images/logo.png', 25, -3, 30); // Asegúrate de cambiar 'ruta/a/logo.png' a la ruta correcta donde se encuentra tu archivo de logo

// Configura el tamaño de letra para la dirección y el número de teléfono
$pdf->SetFont('Montserrat-Regular','',10);

// Agrega la dirección del local
$direccion = utf8_decode('Av. Francisco de Miranda, C.C. Mansión Flamingo, Piso 1, Local N°5.');
$pdf->SetX(60); // Ajusta la posición X para que la dirección aparezca al lado del logo
$pdf->Multicell(0,4,$direccion,0,1);

// Agrega la dirección del local
$direccion = utf8_decode('Telf.: (0283) 2356539, El Tigre - Edo. Anzoátegui');
$pdf->SetX(60); // Ajusta la posición X para que la dirección aparezca al lado del logo
$pdf->Multicell(0,4,$direccion,0,1);

// Agrega el número de teléfono
$telefono = utf8_decode('RIF. V-04281149-8');
$pdf->SetX(60); // Ajusta la posición X para que el número de teléfono aparezca debajo de la dirección
$pdf->Multicell(0,4,$telefono,0,1);

// Configura el tamaño de letra para el título
$pdf->SetFont('Montserrat-Bold','',14);

// Configura el color del texto para el título
$pdf->SetTextColor(13,13,13);

$pdf->Ln(10); // Agrega una línea en blanco

// Agrega el título
$titulo = utf8_decode('Definición de la Informática');
$pdf->cell(0,7.5,$titulo,0,1,'C');

// Configura el tamaño de letra para el cuerpo del texto
$pdf->SetFont('Montserrat-Regular','',12);

// Configura el color del texto para el cuerpo del texto
$pdf->SetTextColor(3,94,115);

// Agrega el cuerpo del texto con un interlineado de 1.0
$texto = utf8_decode("La informática, también llamada computación, es el área de la ciencia que se encarga de estudiar la administración de métodos, técnicas y procesos con el fin de almacenar, procesar y transmitir información y datos en formato digital. La informática abarca desde disciplinas teóricas (como algoritmos, teoría de la computación y teoría de la información) hasta disciplinas prácticas (incluido el diseño y la implementación de hardware y software).");
$pdf->MultiCell(0,5,$texto,0,'J');


$pdf->Ln(10); // Agrega una línea en blanco

$pdf->SetFont('Montserrat-Bold','',14);

// Configura el color del texto para el título
$pdf->SetTextColor(13,13,13);

// Agrega otro título
$titulo2 = utf8_decode('Importancia de la Informática para la Humanidad');
$pdf->cell(0,7.5,$titulo2,0,1,'C');

$pdf->SetFont('Montserrat-Regular','',12);

// Configura el color del texto para el cuerpo del texto
$pdf->SetTextColor(3,94,115);

// Agrega otro cuerpo de texto
$texto2 = utf8_decode("La informática es aplicada en muchas áreas y sectores de la actividad humana, como lo son: la industria, investigación, desarrollo de juegos, gestión de negocios, comunicaciones, física, control de transportes, biología, química, meteorología, ingeniería, almacenamiento y consulta de información, medicina, monitorización y control de procesos, robots industriales, diseño computarizado, aplicaciones/herramientas multimedia, etc.");
$pdf->MultiCell(0,5,$texto2,0,'J');

$pdf->Ln(10); // Agrega una línea en blanco

// Configura el color del texto para la fecha y la firma
$pdf->SetTextColor(0,0,0);

// Agrega la fecha y hora de generación del documento
date_default_timezone_set('America/Caracas');
$fecha = date('d-m-Y H:i:s');
$generado = utf8_decode('Generado automáticamente por FPDF el '.$fecha);
$pdf->cell(0,5,$generado,0,1,'R');

// Agrega la firma
$firma = utf8_decode('Siguiendo los lineamientos de Fernando Padilla');
$pdf->cell(0,5,$firma,0,1,'R');

// Genera el PDF
$pdf->Output();
?>
