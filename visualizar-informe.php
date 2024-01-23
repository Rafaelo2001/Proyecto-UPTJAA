<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Visualización de Informes</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles_nav.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>

    <body>
        <h1>Visualizador de Informes</h1>

        <form method="post">
            <select id="informes" required>
                <option></option>
                <?php 
                    $listaInformes = $user->buscar("informe","1");
                ?>
                <?php
                    foreach($listaInformes as $informe):
                        $fechaInforme = date("d/m/Y", strtotime($informe["Fecha"]));
                        
                        $datosPaciente = $user->buscar("persona","CI = '".$informe["CIP"]."'");
                        $nombrePaciente = '';
                        foreach($datosPaciente as $p):
                            $nombrePaciente = $p["PN"]." ".$p["PA"];
                        endforeach;

                        $tipoInforme = '';
                        if($esBiop = $user->buscar("inf_biopsia","ID_Informe=".$informe["ID_Informe"])) {
                            $tipoInforme = "Biopsia";
                        }
                        elseif($esCito = $user->buscar("inf_citologia","ID_Informe=".$informe["ID_Informe"])){
                            $tipoInforme = "Citología";
                        }
                        ?>
                        <option value="<?php echo($informe["ID_Informe"]) ?>"><?php echo($nombrePaciente." - CI: ".$informe["CIP"]." - ".$tipoInforme." - ".$fechaInforme)?></option>
                <?php
                    endforeach;
                ?>
            </select>

            <input type="submit" value="Imprimir">

            <br><br>

            <section id="seccion_biopsia">
                <label for="tipo">Tipo de informe:</label>
                <input type="text" readonly id="tipo" name="tipo">
                    <br><br>

                <label for="id_inf">ID de Informe:</label>
                <input type="text" readonly id="id_inf" name="id_inf">
                    <br><br>

                <label for="id_b">ID Informe Biopsia:</label>
                <input type="text" readonly id="id_b" name="id_b">
                    <br><br>

                <label for="des_mr">Descripción Material Remitido:</label> <br>
                <textarea id="des_mr" name="des_mr" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="diag">Diagnóstico:</label> <br>
                <textarea id="diag" name="diag" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
                    <br><br>
                
                <label for="obs">Observaciones:</label> <br>
                <textarea id="obs" name="obs" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="cip">Cédula Paciente:</label>
                <input type="text" readonly id="cip" name="cip">
                    <br><br>

                <label for="medico">Médico:</label>
                <input type="text" readonly id="medico" name="medico">
                    <br><br>

                
                <label for="des_macro">Descripción Macro:</label> <br>
                <textarea id="des_macro" name="des_macro" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="des_micro">Descripción Micro:</label> <br>
                <textarea id="des_micro" name="des_micro" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
                    <br><br>
                
                <label for="fecha">Fecha de Redacción:</label> <br>
                <input type="date" readonly id="fecha" name="fecha">
            </section>

            <section id="seccion_citologia" style="display: none;">
                <label for="tipo">Tipo de informe:</label>
                <input type="text" readonly disabled id="tipo" name="tipo">
                    <br><br>

                <label for="id_inf">ID de Informe:</label>
                <input type="text" readonly disabled id="id_inf" name="id_inf">
                    <br><br>

                <label for="id_c">ID Informe Citología:</label>
                <input type="text" readonly disabled id="id_c" name="id_c">
                    <br><br>

                <label for="des_mr">Descripción Material Remitido:</label> <br>
                <textarea id="des_mr" name="des_mr" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="diag">Diagnóstico:</label> <br>
                <textarea id="diag" name="diag" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>
                
                <label for="obs">Observaciones:</label> <br>
                <textarea id="obs" name="obs" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="cip">Cédula Paciente:</label>
                <input type="text" readonly disabled id="cip" name="cip">
                    <br><br>

                <label for="medico">Médico:</label>
                <input type="text" readonly disabled id="medico" name="medico">
                    <br><br>

                
                <label for="calidad">Calidad:</label> <br>
                <textarea id="calidad" name="calidad" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="ctg_gnrl">Categoría General:</label> <br>
                <textarea id="ctg_gnrl" name="ctg_gnrl" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="hallazgos">Hallazgos:</label> <br>
                <textarea id="hallazgos" name="hallazgos" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>

                <label for="conducta">Conducta:</label> <br>
                <textarea id="conducta" name="conducta" cols="60" rows="15" readonly disabled style="resize: none;">tararararará</textarea>
                    <br><br>
                
                <label for="fecha">Fecha de Redacción:</label> <br>
                <input type="date" readonly disabled id="fecha" name="fecha">
            </section>            
        </form>
        
    </body>
    <script src="js/visualizar-informe.js"></script>
</html>