<?php
    // session_start();
    // header('Cache-Control: no-cache, no-store, must-revalidate');
    // header('Pragma: no-cache');
    // header('Expires: 0');

    // if(!isset($_SESSION['username'])) {
    //     header('Location: index.php');
    //     exit;
    // }

    include "php/conexion.php";
    $user = new CodeaDB();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de informacion sobre pagos</title>

        <link href="css/select2.min.css" rel="stylesheet" />
        <script src="js/jquery-3.7.1.js"></script>
        <script src="js/select2.min.js"></script>
    </head>
    <body>
        <h1>REGISTRO DE PAGOS</h1>

        <form action="php/insert-pago.php" method="post"> 
        
        <!-- Pago -> Factura -> Pac-Paga-Fac -->

            <label for="paciente">Paciente:</label>
            <select id="paciente" name="paciente" style="min-width: 200px;" required>
                <option></option>

                <?php $listaPacientes = $user->buscar("paciente","1"); ?>

                <?php foreach($listaPacientes as $cedula_paciente): ?>

                        <option value="<?php echo $cedula_paciente['CIP'] ?>">
                        <?php
                                $cedula = $cedula_paciente['CIP'];
                                $ci_sql = "CI = '$cedula';";
                                
                                $pacientes = $user->buscar("persona", $ci_sql); 
                                foreach($pacientes as $paciente): 
                                
                                $nombre_completo = $paciente['PN'] ." ". $paciente['SN'] ." ". $paciente['TN'] ." ". $paciente['PA'] ." ". $paciente['SA']; 
                                
                                $cedula_formateada = number_format($cedula, 0, ',', '.');
                                $cedula_a_mostrar = " - C.I.: $cedula_formateada";
                                
                                echo $nombre_completo, $cedula_a_mostrar;

                                endforeach; 
                        ?>
                        </option>

                <?php endforeach; ?>
            </select>

                <br><br>

            <label for="fecha">Fecha de pago:</label>
            <input type="datetime-local" placeholder="dd/mm/aaaa" name="fecha" id="fecha">
                
                <br><br>

            <label for="monto">Ingrese monto:</label>
            <input type="number" placeholder="Monto a pagar" name="monto" id="monto"> 
            
                <br>
        
            <label>Tipo de Pago:</label>
                <input type="radio" name="tipo_pago" id="tipo_pago1" value="bss"><label for="tipo_pago1">Bs.S</label>
                <input type="radio" name="tipo_pago" id="tipo_pago2" value="divisa"><label for="tipo_pago2">Divisas</label>
                <input type="radio" name="tipo_pago" id="tipo_pago3" value="pagomovil"><label for="tipo_pago3">Pagomovil</label> 
                <input type="radio" name="tipo_pago" id="tipo_pago4" value="transferencia"><label for="tipo_pago4">Transferencia</label>
            
                <br><br>
            
            <label for="nro_pago">Referencia:</label>
            <input type="text" id="nro_pago" name="nro_pago">

                <br><br>
            
            <label for="obs">Observaciones: </label>
            <input type="text" id="obs" name="obs">

                <br><br>

            <input type="submit" value="Registrar Pago">
        </form>



    </body>
    <script src="js/form-pago.js"></script>
</html>