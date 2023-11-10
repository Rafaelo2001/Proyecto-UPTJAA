<?php
    session_start();
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    if(!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Homeee</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css/styles_nav.css">
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
            <li class="fs-sm">
                <a href="#">
                    <i class="fi fi-rr-apps"></i>
                    <span class="link_name">Panel Principal</span>
                </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Panel Principal</a></li>
                    </ul>
            </li>
            <li>
                <a href="patient_register.php">
                    <i class="fi fi-rr-procedures"></i>
                    <span class="link_name">Pacientes</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="patient_register.php">Pacientes</a></li>
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
                    <li><a href="#">Citología</a></li>
                    <li><a href="#">Biopsia</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fi fi-rr-box-open-full"></i>
                    <span class="link_name">Insumos</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Insumos</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fi fi-rr-file-circle-info"></i>
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
                    <a href="#">
                        <i class="fi fi-rr-exit"></i>
                        <span class="link_name">Salir</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Salir</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class="fi fi-rr-menu-burger bx-menu"></i>
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

    
    <div class="register-box-biopsia">
        <h1>DETALLES</h1>
        <form action="#" method="post" class="form" id="form">

            
        </form>
    </div>
    
</body>
</html>