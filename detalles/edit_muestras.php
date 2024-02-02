<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['id_m'] == "" || $_POST['tipo_m'] == ""){
        header('Location: ./detalles_muestras.php', true, 303);
        exit;
    }

    require "../php/conexion.php";
    $user = new CodeaDB();

    $datosMuestra = $user->buscarSINGLE("m_remitido","ID_M_Remitido='".$_POST['id_m']."'");   
    
    if($_POST['tipo_m'] == "Biopsia"){
        $datosBiop = $user->buscarSINGLE("m_biopsia","ID_M_Remitido=".$_POST['id_m']);
    }
    elseif($_POST['tipo_m'] == "Citología"){
        $datosCito = $user->buscarSINGLE("m_citologia","ID_M_Remitido=".$_POST['id_m']);
    }

    $examen_si = "";
    $examen_no = "";

    if ($datosMuestra["Examinado"]){
        $examen_si = "checked";
        $examen_no = "";
    }
    else{
        $examen_si = "";
        $examen_no = "checked";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Edición de Muestra <?php echo ($_POST["tipo_m"]); ?></title>
        <script src="../js/jquery-3.7.1.js"></script>
    </head>
    <body>
        <h1>Edición de Muestra de <?php echo( $_POST['tipo_m'] ) ?></h1>
        <main>
            <form action="./insert_edit_muestras.php" method="post">
                <label for="des_m">Descripción Material:</label>
                    <br>
                    <textarea id="des_m" name="des_m" cols="100" rows="8"><?php echo($datosMuestra['Descripcion_material']) ?></textarea>

                    <br><br>

                <label for="diag">Diagnóstico:</label>
                    <br>
                    <textarea id="diag" name="diag" cols="100" rows="8"><?php echo($datosMuestra["Diagnostico"]) ?></textarea>

                    <br><br>

                <label for="resumen">Resumen:</label>
                    <br>
                    <textarea id="resumen" name="resumen" cols="100" rows="8"><?php echo($datosMuestra["Resumen"]) ?></textarea>

                    <br><br>

                <label>Examinado:</label>
                    <br>
                    <label for="E_si">Si:</label>
                    <input id="E_si" name="examinado" type="radio" value="1" <?php echo($examen_si) ?>>
                        <br>
                    <label for="E_no">No:</label>
                    <input id="E_no" name="examinado" type="radio" value="0" <?php echo($examen_no) ?>>

                    <br><br>
                
                <label for="f_ent">Fecha de Entrada:</label>
                    <input id="f_ent" name="f_ent" type="datetime-local" value="<?php echo($datosMuestra["F_Entrada"]) ?>">

                    <br><br>

                <?php if($_POST['tipo_m'] == "Biopsia"): ?>
                
                    <label for="sitio">Sitio de Lesión:</label>
                    <textarea id="sitio" name="sitio"><?php echo($datosBiop["Sitio_lesion"]) ?></textarea>

                <?php elseif($_POST['tipo_m'] == "Citología"): ?>

                    <label for="FUR">Fecha Ultima Regla:</label>
                    <input id="FUR" name="FUR" type="date" value="<?php echo($datosCito["FUR"]) ?>">

                        <br><br>

                    <label>Frotis:</label>
                    <input type="checkbox" name="endocervix" id="endocervix" value="1" <?php echo ($datosCito['Endocervix']) ? "checked" : "" ?>>
                    <label for="endocervix">Endocervix</label>
        
                    <input type="checkbox" name="exocervix" id="exocervix" value="1" <?php echo ($datosCito['Exocervix']) ? "checked" : "" ?>>
                    <label for="exocervix">Exocervix</label>
        
                    <input type="checkbox" name="vagina" id="vagina" value="1" <?php echo ($datosCito['Vagina']) ? "checked" : "" ?>>
                    <label for="vagina">Vagina</label>

                    <br>

                    <input type="checkbox" name="otro_check" id="otro_check" value="1" <?php echo ($datosCito['Otros']) ? "checked" : "" ?>>
                    <label for="otro_check">Otro:</label>
                    <input type="text" name="otro" id="otro" value="<?php echo ($datosCito['Otros']) ? $datosCito['Otros'] : "" ?>">

                <?php endif; ?>

                    <br><br><br>
                    
                    <input type="hidden" name="id_m" value="<?php echo $_POST['id_m']; ?>">
                    <input type="hidden" name="tipo_m" value="<?php echo $_POST['tipo_m']; ?>">
                    <input type="submit" id="enviar" value="Aplicar Cambios" disabled>
                
                </form>
        </main> 
    </body>
    <script>
        $(":input").change(function(){
            $("#enviar").prop("disabled", false);
        })
        $(":input").keypress(function(){
            $("#enviar").prop("disabled", false);
        })
    </script>
</html>