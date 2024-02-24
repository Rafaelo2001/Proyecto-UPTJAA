<?php
    // Esta venta se muestra si se accede a una pagina a la cual el usuario actual no tiene permiso de ingresar
    
    require "./php/sweet.php";

    $alert = new SweetForInsert();

    echo($alert->sweetHead("Sin Permiso","./"));

    die($alert->sweetWar("./home.php","No tienes permiso para acceder a esta página"));
