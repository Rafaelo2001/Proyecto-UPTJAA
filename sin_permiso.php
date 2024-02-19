<?php
    require "./php/sweet.php";

    $alert = new SweetForInsert();

    echo($alert->sweetHead("Sin Permiso","./"));

    die($alert->sweetWar("./home.php","No tienes permiso para acceder a esta página"));
