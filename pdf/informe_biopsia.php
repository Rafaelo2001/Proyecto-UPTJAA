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

    // Solicita la libreria FPDF para la creacion de PDF
    require('../fpdf/fpdf.php');

    // Declara una clase extendida del tipo FPDF
    class PDF extends FPDF
    {
        // Declaracion del Encabezado
        function Header()
        {
            // Si es la primera pagina del documento, muestra el encabezado completo
            // Despues muestra el ID del insumo la esquina superior
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
                $n_biopsia = mb_convert_encoding("BIOPSIA N°: " . $_POST["id_b"], "ISO-8859-1");
                $this->Cell(70, 10, $n_biopsia, 0, 0, "C");

                $this->Ln(25);
            }
            else
            {
                $this->SetXY(130, 10);
                $this->SetFont('Montserrat-Bold', '', 10);
                $n_biopsia = mb_convert_encoding("B-" . $_POST["id_b"], "ISO-8859-1");
                $this->Cell(67, 10, $n_biopsia, 0, 0, "R");

                $this->Ln(15);
            }
        }

        // Declaracion del Pie de Pagina
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
        $b = new PDF();

        $b->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');
        $b->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');

        $b->AddPage('P', 'Letter');

        $b->SetFont('Arial', '', 10);


    // Cabecera Datos Paciente
    // Datos para cabecera
        $fecha = date("d/m/Y", strtotime($_POST["fecha"]));

        $datosPaciente = $user->buscar("persona", "CI='" . $_POST["cip"] . "'");
        $nombrePaciente = strtoupper($datosPaciente[0]["PN"] . ' ' . $datosPaciente[0]["PA"]);
        $edadPaciente = $datosPaciente[0]["Edad"] . mb_convert_encoding(" años", "ISO-8859-1");
        $sexoPaciente = $datosPaciente[0]["Sexo"];

        $nombreMedico = mb_convert_encoding(strtoupper($_POST["medico"]), "ISO-8859-1");


    // Primera Fila de Datos del Paciente
        $b->SetTextColor(3, 94, 115);
        $fechaLargo = $b->GetStringWidth("Fecha: ");
        $b->Cell($fechaLargo, 10, "Fecha: ", 0, 0);
        $b->SetTextColor(13, 13, 13);
        $b->Cell(35 - $fechaLargo, 10, $fecha, 0, 0);

        $b->setX(50);

        $b->SetTextColor(3, 94, 115);
        $nombreLargo = $b->GetStringWidth("Nombre:   ");
        $b->Cell($nombreLargo, 10, "Nombre:   ", 0, 0);
        $b->SetTextColor(13, 13, 13);
        $b->Cell(80 - $nombreLargo, 10, $nombrePaciente, 0, 0);

        $b->setX(140);

        $b->SetTextColor(3, 94, 115);
        $edadLargo = $b->GetStringWidth("Edad: ");
        $b->Cell($edadLargo, 10, "Edad: ", 0, 0);
        $b->SetTextColor(13, 13, 13);
        $b->Cell(40 - $edadLargo, 10, $edadPaciente, 0, 0);

        $b->setX(185);

        $b->SetTextColor(3, 94, 115);
        $sexoLargo = $b->GetStringWidth("Sexo: ");
        $b->Cell($sexoLargo, 10, "Sexo: ", 0, 0);
        $b->SetTextColor(13, 13, 13);
        $b->Cell(35 - $sexoLargo, 10, $sexoPaciente, 0, 1);

    // Linea Horinzontal
        $b->Cell(35, 2, '', 0, 2);
        $b->Cell(0, 0, '', 1, 2);
        $b->Cell(35, 4, '', 0, 2);


    // Segunda Fila de Datos del Paciente
        $b->SetTextColor(3, 94, 115);
        $ciLargo = $b->GetStringWidth("C.I.:   ");
        $b->Cell($ciLargo, 10, "C.I.:   ", 0, 0);
        $b->SetTextColor(13, 13, 13);
        list($tipo_identidad, $ci_numerica) = explode('-', $_POST["cip"]);
        $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
        $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;
        $b->Cell(35 - $ciLargo, 10, $cedula_formateada, 0, 0);

        $b->setX(50);

        $b->SetTextColor(3, 94, 115);
        $medicoLargo = $b->GetStringWidth("Médico:   DR(A).");
        $b->Cell($medicoLargo, 10, mb_convert_encoding('Médico:   DR(A).', 'ISO-8859-1'), 0, 0);
        $b->SetTextColor(13, 13, 13);
        $b->Cell(80 - $medicoLargo, 10, $nombreMedico, 0, 1);

    // Linea Horinzontal
        $b->Cell(35, 2, '', 0, 2);
        $b->Cell(0, 0, '', 1, 2);
        $b->Cell(35, 8, '', 0, 2);


    // Informacion de Planilla
    // Linea Titulo
        $b->SetFont('Arial', 'U', 14);
        $b->SetFillColor(186, 236, 247);
        $b->SetTextColor(3, 94, 115);
        $b->Cell(5, 8, "", 0, 0, "", true);
        $b->Cell(0, 8, "MATERIAL REMITIDO", 0, 1, "L", true);

    // Standar Font
        $b->SetFont('Arial', '', 12);
        $b->SetTextColor(13, 13, 13);
        $b->cell(0, 3, "", 0, 1);
        $b->MultiCell(0, 10, mb_convert_encoding($_POST["des_mr"], 'ISO-8859-1'), 0, 1);
        $b->cell(0, 3, "", 0, 1);

    // Linea Titulo
        $b->SetFont('Arial', 'U', 14);
        $b->SetFillColor(186, 236, 247);
        $b->SetTextColor(3, 94, 115);
        $b->Cell(5, 8, "", 0, 0, "", true);
        $b->Cell(0, 8, mb_convert_encoding("DESCRIPCIÓN MACROSCÓPICA", 'ISO-8859-1'), 0, 1, "L", true);

    // Descripcion Macro
        $b->SetFont('Arial', '', 10);
        $b->SetTextColor(13, 13, 13);
        $b->cell(0, 3, "", 0, 1);
        $b->MultiCell(0, 6, mb_convert_encoding($_POST["des_macro"], 'ISO-8859-1'), 0, 1);
        $b->cell(0, 3, "", 0, 1);

    // Linea Titulo
        $b->SetFont('Arial', 'U', 14);
        $b->SetFillColor(186, 236, 247);
        $b->SetTextColor(3, 94, 115);
        $b->Cell(5, 8, "", 0, 0, "", true);
        $b->Cell(0, 8, mb_convert_encoding("DESCRIPCIÓN MICROSCÓPICA", 'ISO-8859-1'), 0, 1, "L", true);

    // Descripcion Micro
        $b->SetFont('Arial', '', 10);
        $b->SetTextColor(13, 13, 13);
        $b->cell(0, 3, "", 0, 1);
        $b->MultiCell(0, 6, mb_convert_encoding($_POST["des_micro"], 'ISO-8859-1'), 0, 1);
        $b->cell(0, 3, "", 0, 1);

    // Linea Titulo
        $b->SetFont('Arial', 'U', 14);
        $b->SetFillColor(186, 236, 247);
        $b->SetTextColor(3, 94, 115);
        $b->Cell(5, 8, "", 0, 0, "", true);
        $b->Cell(0, 8, mb_convert_encoding("BIOPSIA", 'ISO-8859-1'), 0, 1, "C", true);

    // Diagnostico
        $b->SetFont('Arial', 'U', 10);
        $b->SetTextColor(13, 13, 13);
        $b->cell($b->GetStringWidth("DIAGNOSTICO"), 10, "DIAGNOSTICO", 0, 0);
        $b->SetFont('Arial', '', 10);
        $b->cell(3, 10, ": ", 0, 1);
        $b->MultiCell(0, 6, mb_convert_encoding($_POST["diag"], 'ISO-8859-1'), 0, 1);
        $b->cell(0, 8, "", 0, 1);

    // Comentario/Observacion
        $b->SetFont('Arial', 'U', 8);
        $b->SetTextColor(13, 13, 13);
        $b->cell($b->GetStringWidth("NOTA"), 5, "NOTA", 0, 0);
        $b->SetFont('Arial', '', 8);
        $b->cell(3, 5, ": ", 0, 0);
        $b->MultiCell(0, 5, mb_convert_encoding($_POST["obs"], 'ISO-8859-1'), 0, 1);
        $b->cell(0, 5, "", 0, 1);

    $b->Output();
