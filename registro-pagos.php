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
        <title>Registro de Pagos</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles_higea.css">
        <link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <script src="js/jquery-3.7.1.js"></script>
    </head>
    <body class="login-register">

        <div class="sidebar close">
                <div class="logo-details">
                <img class="logo" src="images/Logo con contorno.png" alt="Logo de Higea" width="60" height="60">
                <img class="logo_name" src="images/Letras.png" alt="HIGEA" width="135" height="40">
                </div>
                <ul class="nav-links">
                <li>
                        <a href="home.php">
                        <i class="fi fi-rr-apps"></i>
                        <span class="link_name">Panel Principal</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="home.php">Panel Principal</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-paciente.php">
                        <i class="fi fi-rr-procedures"></i>
                        <span class="link_name">Pacientes</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-paciente.php">Pacientes</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-microscope"></i>
                                <span class="link_name">Muestras</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Muestras</a></li>
                        <li><a href="registro-citologia.php">Citología</a></li>
                        <li><a href="registro-biopsia.php">Biopsia</a></li>
                        </ul>
                </li>
                <li>
                        <a href="supplies_register.html">
                        <i class="fi fi-rr-box-open-full"></i>
                        <span class="link_name">Insumos</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="supplies_register.html">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-informes.php">
                        <i class="fi fi-rr-document-signed"></i>
                        <span class="link_name">Informes médicos</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-informes.php">Informes médicos</a></li>
                        </ul>
                </li>
                <li>
                        <a href="registro-pagos.php">
                        <i class="fi fi-rr-file-invoice-dollar"></i>
                        <span class="link_name">Facturación</span>
                        </a>
                        <ul class="sub-menu blank">
                        <li><a class="link_name" href="registro-pagos.php">Facturación</a></li>
                        </ul>
                </li>
                <li>
                        <div class="iocn-link">
                        <a href="#">
                                <i class="fi fi-rr-eye"></i>
                                <span class="link_name">Detalles</span>
                        </a>
                        <i class="fi fi-rr-angle-small-down arrow"></i>
                        </div>
                        <ul class="sub-menu">
                        <li><a class="link_name" href="#">Detalles</a></li>
                        <li><a href="#">Pacientes</a></li>
                        <li><a href="#">Muestras</a></li>
                        <li><a href="#">Insumos</a></li>
                        </ul>
                </li>
                <li>
                        <div class="profile-details">
                        <a href="php/exit.php">
                                <i class="fi fi-rr-exit"></i>
                                <span class="link_name">Salir</span>
                        </a>
                        <ul class="sub-menu blank">
                                <li><a class="link_name" href="php/exit.php">Salir</a></li>
                        </ul>
                        </div>
                </li>
                </ul>
        </div>

        <main class="home-section">
                <div class="home-content">
                        <i class="fi fi-rr-menu-burger bx-menu"></i>
                </div>

                <section class="form-register">
                        <h1>REGISTRO DE PAGOS</h1>
                        <form action="php/generador-factura.php" method="post" class="form" id="form" autocomplete="off">

                        <label for="paciente">Paciente</label>
                            <select id="paciente" name="paciente" style="min-width: 100px;" required>
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
                                                                                
                                                        list($tipo_identidad, $ci_numerica) = explode('-', $cedula);
                                                        $ci_numerica_formateada = number_format($ci_numerica, 0, ',', '.');
                                                        $cedula_formateada = $tipo_identidad . '-' . $ci_numerica_formateada;

                                                        $cedula_a_mostrar = " - C.I.: $cedula_formateada";
                                                                                
                                                        echo $nombre_completo, $cedula_a_mostrar;

                                            endforeach; 
                                            ?>
                                    </option>

                                    <?php endforeach; ?>
                            </select>

                                <div class="grid">
                                       
                                        <!--group: datebirth-->
                                        <div class="form-group" id="group_date_birth">
                                        <div class="form-group-input">
                                        <label for="fecha">Fecha de pago</label>
                                        <input type="datetime-local" placeholder="dd/mm/aaaa" name="fecha" id="fecha" class="fecha" required>
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                        </div>
                                        <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                                        </div>

                                        <!--group: datebirth-->
                                        <div class="form-group" id="group_date_birth">
                                        <div class="form-group-input">
                                        <label for="monto">Ingrese monto</label>
                                        <input type="number" step="0.01" placeholder="Monto a pagar" name="monto" id="monto" class="monto" required> 
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                        </div>
                                        <p class="form-input-error">Rellene este campo correctamente. Ej: 2000</p>
                                        </div>

                                        <!--group: datebirth-->
                                        <div class="form-group" id="group_date_birth">
                                        <div class="form-group-input">
                                        <label for="monto">Descripción de la factura</label>
                                        <input type="text" placeholder="Indique la descripción" name="desc" id="desc" class="desc" required> 
                                                <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                        </div>
                                        <p class="form-input-error">Rellene este campo correctamente. Ej: 2000</p>
                                        </div>
                                </div>

                                <div>
                                        <label>Método de pago</label>
                                        <div class="radio" id="tipo-pago">
                                            <input type="radio" name="tipo_pago" id="tipo_pago1" value="Bs.D">
                                            <label for="tipo_pago1">Bs.D</label>
                                            
                                            <input type="radio" name="tipo_pago" id="tipo_pago2" value="Divisa">
                                            <label for="tipo_pago2">Divisas</label>

                                            <input type="radio" name="tipo_pago" id="tipo_pago3" value="Pago móvil">
                                            <label for="tipo_pago3">Pago móvil</label>

                                            <input type="radio" name="tipo_pago" id="tipo_pago4" value="Transferencia">
                                            <label for="tipo_pago4">Transferencia</label>
                                        </div>
                                </div>

                                <div class="grid">
                                       
                                       <!--group: datebirth-->
                                       <div class="form-group" id="group_date_birth">
                                       <div class="form-group-input">
                                       <label for="referencia">Referencia (si aplica)</label>
                                       <input type="text" id="referencia" name="referencia" class="referencia" placeholder="Indique la referencia">
                                               <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                       </div>
                                       <p class="form-input-error">Rellene este campo correctamente. Ej: 31/01/2023</p>
                                       </div>

                                       <!--group: datebirth-->
                                       <div class="form-group" id="group_date_birth">
                                       <div class="form-group-input">
                                       <label for="obs">Observaciones del pago</label>
                                       <input type="text" id="obs" name="obs" class="obs" placeholder="Observación">
                                               <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                                       </div>
                                       <p class="form-input-error">Rellene este campo correctamente. Ej: 2000</p>
                                       </div>
                               </div>
                                
                                        
                                <!--<div class="form-mess" id="form-mess">
                                <p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
                                </div>-->

                                <div class="button-container">
                                <div class="form__group form__group-btn-submit">
                                        <input class="button-submit" type="submit" name="registrar" id="registrar" value="Generar factura">
                                </div>
                                <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                                </div>
                        </form>
                </section>
        </main>

        <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
          arrow[i].addEventListener("click", (e)=>{
         let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
         arrowParent.classList.toggle("showMenu");
          });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("close");
        });
        </script>

    </body>
    <!--<script src="js/form-pago.js"></script>-->
</html>