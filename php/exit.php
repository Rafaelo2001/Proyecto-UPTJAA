<?php
    // Cierre de Seccion del sistema
    session_start();
    if(isset($_SESSION['username'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('Location: ../index.php');
    }else{
        echo "falló la conexión!";
    }

