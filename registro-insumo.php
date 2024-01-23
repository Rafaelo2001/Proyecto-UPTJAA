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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Insumos</title>
        <link rel="stylesheet" href="css/styles_higea.css">
        <link rel="stylesheet" type="text/css" href="css/styles_higea.css?v=1.2">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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

    <section class="home-section">
        <div class="home-content">
            <i class="fi fi-rr-menu-burger bx-menu"></i>
        </div>

        <div class="register-box-supplies">
            <h1>REGISTRO DE INSUMOS</h1>
            <form action="php/insert-insumo.php" method="post" class="form" id="form">

            <!-- Se usan para el procesamiento 6 envases de alcohol cada uno con 400cc, 
            Tres envases con xilol cada uno de 400 cc
            Y dos envases con parafina líquida cada uno con 400 cc. 
            Estas cantidades se reponen una vez al mes. -->
    
                <div class="grid">
    
                    <!--group: material-->
                    <div class="form-group" id="group_material">
                        <div class="form-group-input">
                            <label for="material">Material</label>
                            <input   type="text" name="material" id="material" required placeholder="Nombre del material">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>

                    <!--group: unidades-->
                    <div class="form-group" id="group_duration">
                        <div class="form-group-input">
                            <label for="unidades">Unidades</label>
                            <input   type="text" name="unidades" id="unidades" required placeholder="Unidad de medida del material">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>

                    <!--group: cant minima-->
                    <div class="form-group" id="group_top">
                        <div class="form-group-input">
                            <label for="cant_minima">Cantidad Minima</label>
                            <input   type="number" min="0" name="cant_minima" required id="cant_minima" placeholder="Establesca una cantidad minima">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>
    
                    <!--group: stock-->
                    <div class="form-group" id="group_stock">
                        <div class="form-group-input">
                            <label for="existencia">Existencia (opcional)</label>
                            <input   type="number" name="existencia" id="existencia" placeholder="Indique la existencia">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>

    
                    <!--group: duracion-->
                    <div class="form-group" id="group_supplier">
                        <div class="form-group-input">
                            <label for="duracion">Duracion</label>
                            <input   type="text" name="duracion" id="duracion" placeholder="Indique la duracion">
                            <i class="formulario_validacion_estado fi fi-rr-cross"></i>
                        </div>
                        <p class="form-input-error">Rellene este campo correctamente</p>
                    </div>
                </div>
    
                    <div class="form-mess" id="form-mess">
                        <p><i class="fi fi-rr-triangle-warning"></i><b>Error:</b> ¡Revise los campos!</p>
                    </div>
    
                    <div class="button-container">
                        <div class="form__group form__group-btn-submit">
                            <input class="button-submit" type="submit" id="registrar" value="Registrar">
                        </div>
                        <p class="form-mess-good" id="form-mess-good">¡Formulario enviado!</p>
                    </div>
            </form>
        </div>
    </section>

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

    <script src="js/form-inventory.js"></script>

</body>
</html>