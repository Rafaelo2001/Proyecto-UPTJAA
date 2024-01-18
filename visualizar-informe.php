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

        <form>
            <select id="informes">
                <option></option>
                <?php 
                    $listaInformes = $user->buscar("informe","1");
                ?>
                <?php
                    foreach($listaInformes as $informe):
                        $fechaInforme = date("d/m/Y", strtotime($informe["Fecha"]));
                        
                        $datosPaciente = $user->buscar("persona","CI = ".$informe["CIP"]);

                        $nombrePaciente = '';
                        foreach($datosPaciente as $p):
                            $nombrePaciente = $p["PN"]." ".$p["PA"];
                        endforeach;
                        ?>
                        <option value="<?php echo($informe["ID_Informe"]) ?>"><?php echo($nombrePaciente." - CI: ".$informe["CIP"]." - ".$fechaInforme)?></option>
                <?php
                    endforeach;
                ?>
            </select>

            <br><br>

            <textarea id="descripcion" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
            <textarea id="des_mr" cols="60" rows="15" readonly style="resize: none;">tararararará</textarea>
            <br><br>

            <input type="date" readonly id="fecha">

            <br><br>

            
            
        </form>
        
    </body>
    <script src="js/visualizar-informe.js"></script>
</html>