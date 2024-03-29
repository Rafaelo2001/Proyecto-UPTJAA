<?php

    // Imprime la factura requerida

    require '../fpdf/fpdf.php';
    require "../php/conexion.php";
    $user = new CodeaDB();

    $id = $_POST['id'];
    $factura = $user->buscarSINGLE("factura","ID_Factura = '$id'");

    // Crea una nueva instancia de la clase FPDF
    $pdf = new FPDF('P', 'mm', 'Letter');

    // Agrega las fuentes Montserrat-Regular y Montserrat-Bold
    $pdf->AddFont('Montserrat-Regular','','Montserrat-Regular.php');
    $pdf->AddFont('Montserrat-Bold','','Montserrat-Bold.php');

    // Agrega una nueva página al documento PDF
    $pdf->AddPage();

    // Configura los márgenes
    $pdf->SetMargins(25, 25, 25);

    // Agrega el logo del laboratorio al encabezado del documento
    $pdf->Image('../images/logo.png', 25, -3, 30);

    // Configura el tamaño de letra para la dirección, el número de teléfono y el RIF del laboratorio
    $pdf->SetFont('Montserrat-Regular','',10);

    // Agrega la dirección del local
    $direccion = utf8_decode('Av. Francisco de Miranda, C.C. Mansión Flamingo, Piso 1, Local N°5.');
    $pdf->SetX(60); // Ajusta la posición X para que la dirección aparezca al lado del logo
    $pdf->Multicell(0,4,$direccion,0,1);

    // Agrega el número de teléfono del local
    $telefono = utf8_decode('Telf.: (0283) 2356539, El Tigre - Edo. Anzoátegui');
    $pdf->SetX(60); // Ajusta la posición X para que la dirección aparezca al lado del logo
    $pdf->Multicell(0,4,$telefono,0,1);

    // Agrega el RIF del local
    $rif = utf8_decode('RIF. V-04281149-8');
    $pdf->SetX(60); // Ajusta la posición X para que el número de teléfono aparezca debajo de la dirección
    $pdf->Multicell(0,4,$rif,0,1);

    $pdf->Ln(5); // Agrega una línea en blanco

    // Configura el tamaño de letra para el título
    $pdf->SetFont('Montserrat-Bold','',14);

    // Configura el color del texto para el título
    $pdf->SetTextColor(3,94,115);


    // Configura el color de fondo para el título
    $pdf->SetFillColor(186, 236, 247); // RGB color

    // Agrega el título
    $titulo = utf8_decode('FACTURA');
    $pdf->cell(0,7.5,$titulo,0,1,'C',true); // El último parámetro 'true' habilita el relleno

    $pdf->Ln(5); // Agrega una línea en blanco

    // Configura la zona horaria a la de Venezuela
    date_default_timezone_set('America/Caracas');

    // Configura el tamaño de letra para el título de la fecha y hora
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para el título de la fecha y hora
    $pdf->SetTextColor(13,13,13);

    // Agrega la celda con el texto "Fecha y hora:"
    $pdf->Cell(57,7.5,utf8_decode('Fecha y hora de emisión:'),0,0,'L'); // 'L' para alinear a la izquierda

    // Configura el tamaño de letra para la fecha y hora
    $pdf->SetFont('Montserrat-Regular','',12);

    // Configura el color del texto para la fecha y hora
    $pdf->SetTextColor(13,13,13);

    // Agrega la fecha y hora actual de Venezuela en formato de 12 horas
    $fechaHora = date('d-m-Y h:i:s A', strtotime($factura['F_Emision']));
    $pdf->Cell(60,7.5,utf8_decode($fechaHora),0,1,'L'); // 'L' para alinear a la izquierda

    // Configura el tamaño de letra para el número de factura
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para el número de factura
    $pdf->SetTextColor(225, 22, 31);

    // Agrega la celda con el texto "FACTURA N°:"
    $pdf->Cell(30,10,utf8_decode('FACTURA N°:'),0);

    // Agrega la celda con el número de la factura proveniente de la BD
    $pdf->Cell(45,10,utf8_decode($id),0);

    $pdf->Ln(10); // Agrega una línea en blanco

    // Configura el tamaño de letra para Nombre y apellido
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para Nombre y apellido
    $pdf->SetTextColor(3,94,115);

    // Agrega la celda con el texto "Nombre y apellido:"
    $pdf->Cell(45,10,utf8_decode('Nombre y Apellido:'),);

    // Configura el tamaño de letra para los datos de la celda Nombre y apellido de la BD
    $pdf->SetFont('Montserrat-Regular','',12);

    // Configura el color del texto para los datos de la celda Nombre y apellido de la BD
    $pdf->SetTextColor(13,13,13);

    // Agrega la segunda celda con el nombre y apellido recuperado de la base de datos
    $cedula = $factura['CIP'];
    $datosPaciente = $user->buscarSINGLE("persona", "CI = '$cedula'");
    
        $nombre_completo = $datosPaciente['PN'] ." ". $datosPaciente['PA']; 

    $pdf->Cell(60,10,utf8_decode($nombre_completo),0);

    // Configura el tamaño de letra para "Teléfono:"
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para "Teléfono:"
    $pdf->SetTextColor(3,94,115);

    // Agrega la tercera celda con el texto "Teléfono:"
    $pdf->Cell(25,10,utf8_decode('Teléfono:'),0);

    // Configura el tamaño de letra para el telefono almacenado en la BD
    $pdf->SetFont('Montserrat-Regular','',12);

    // Configura el color del texto para el telefono almacenado en la BD
    $pdf->SetTextColor(13,13,13);

    // Agrega la cuarta celda con el teléfono recuperado de la base de datos
    $numero = $user->buscarONE("telefono","CI = '$cedula'","Nro_Telf");
    $pdf->Cell(35,10,utf8_decode($numero),0);

    // Agrega una nueva línea para la siguiente fila de la tabla
    $pdf->Ln();

    // Configura el tamaño de letra para "C.I./RIF/Pasaporte:"
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para "C.I./RIF/Pasaporte:"
    $pdf->SetTextColor(3,94,115);

    // Agrega la celda con el texto "C.I./RIF/Pasaporte:"
    $pdf->Cell(47,10,utf8_decode('C.I./E/Pasaporte/RIF:'),0);

    // Configura el tamaño de letra para los datos de "C.I./RIF/Pasaporte:" almacenados en la BD
    $pdf->SetFont('Montserrat-Regular','',12);

    // Configura el color del texto para los datos de "C.I./RIF/Pasaporte:" almacenados en la BD
    $pdf->SetTextColor(13,13,13);

    // Agrega la segunda celda con el número de C.I./RIF/Pasaporte recuperado de la base de datos
            list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
            $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
            $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

    $pdf->Cell(60,10,utf8_decode($cedula_formateada),0);

    $pdf->Ln(20); // Agrega una línea en blanco

    // Configura el tamaño de letra para CANTIDAD, CONCEPTO O DESCRIPCIÓN y TOTAL
    $pdf->SetFont('Montserrat-Bold','',14);

    // Configura el color del texto para CANTIDAD, CONCEPTO O DESCRIPCIÓN y TOTAL
    $pdf->SetTextColor(3,94,115);

    // Configura el color de fondo para CANTIDAD, CONCEPTO O DESCRIPCIÓN y TOTAL
    $pdf->SetFillColor(186,236,247);

    // Agrega la primera celda con el texto "CANTIDAD"
    $pdf->Cell(30,10,utf8_decode('CANTIDAD'),0,0,'C',true);

    // Agrega la segunda celda con el texto "CONCEPTO O DESCRIPCIÓN"
    $pdf->Cell(110,10,utf8_decode('CONCEPTO O DESCRIPCIÓN'),0,0,'C',true);

    // Agrega la tercera celda con el texto "TOTAL"
    $pdf->Cell(25,10,utf8_decode('TOTAL'),0,0,'C',true);

    // Agrega un salto de línea para comenzar una nueva fila
    $pdf->Ln();

    // Configura el tamaño de letra para el relleno de la celda CANTIDAD
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para las celdas de relleno
    $pdf->SetTextColor(13,13,13);

    // Configura el color de fondo para las celdas de relleno
    $pdf->SetFillColor(255,255,255);

    // Agrega una celda para cada columna en la fila
    $pdf->Cell(30,10,utf8_decode('01'),0,0,'C',true);

    // Configura el tamaño de letra para las demás celdas de relleno
    $pdf->SetFont('Montserrat-Regular','',12);

    // Guarda la posición actual
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Agrega la celda de descripción con MultiCell
    $pdf->MultiCell(105,10,utf8_decode($factura['Descripcion']),0,'L',true);

    $newY = $pdf->GetY();

    // Restaura la posición a la derecha de la celda de descripción
    $pdf->SetXY($x + 105, $y);

    $neoMonto = number_format($factura['Monto'], 2, ',', '.');

    $pdf->Cell(30,10,utf8_decode('Bs.D '.$neoMonto),0,0,'R',true);

    $pdf->Ln(30); // Agrega una línea en blanco

    // Configura el tamaño de letra para TOTAL
    $pdf->SetFont('Montserrat-Bold','',14);

    // Configura el color del texto para TOTAL
    $pdf->SetTextColor(3,94,115);

    // Configura el color de fondo para TOTAL
    $pdf->SetFillColor(186,236,247);

    $pdf->SetY($newY + 10);

    // Agrega la celda con el texto "TOTAL:"
    $pdf->Cell(80,10,utf8_decode('TOTAL:'),0,0,'L',true);

    // Agrega la segunda celda con el monto recuperado de la base de datos
    $pdf->Cell(85,10,utf8_decode('Bs.D '.$neoMonto),0,0,'R',true);

    $pdf->Ln(10); // Agrega una línea en blanco

    // Configura el tamaño de letra para MÉTODO DE PAGO UTILIZADO
    $pdf->SetFont('Montserrat-Bold','',12);

    // Configura el color del texto para MÉTODO DE PAGO UTILIZADO
    $pdf->SetTextColor(13,13,13);

    // Configura el color de fondo para MÉTODO DE PAGO UTILIZADO
    $pdf->SetFillColor(255,255,255);

    // Agrega la celda con el texto "MÉTODO DE PAGO UTILIZADO:"
    $pdf->Cell(80,10,utf8_decode('MÉTODO DE PAGO UTILIZADO:'),0,0,'L',true);

    // Agrega la celda con el método de pago utilizado guardado en la base de datos
    $tipo_pago = $user->buscarONE("pago","ID_Pago = '".$factura['Nro_Control']."'","Tipo_Pago");
    $pdf->Cell(85,10,utf8_decode($tipo_pago),0,0,'R',true);

    // Agrega un salto de línea para comenzar una nueva fila
    $pdf->Ln();

    // Genera el PDF, se utiliza el parámetro I para visualizar el PDF en el navegador sin descargar, el segundo parámetro es el nombre del archivo al descargarlo
    $pdf->Output('I', 'FACTURA NRO.'.$id.'.pdf');
