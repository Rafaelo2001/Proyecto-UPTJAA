<!DOCTYPE html>

<html lang="en">
<head>    
    <title>Informes: Citologia</title>
</head>
    <body>
        <center>
            <h1>Informes</h1>

            <form>
                Pacientes
                <select>
                    <option></option>
                    <option>Ramon</option>
                    <option>Fernando</option>
                    <option>Carlos</option>

                </select>
                Medico
                <select>
                    <option></option>
                    <option>Miguel Blanco</option>
                </select>
            </form>
        </center>

        <br>

        <center>
            <h2>Informacion material remitido</h2> <br>
            <textarea name="Informacion" id="Información" cols="100" rows="5"></textarea>
            
            <h1> Informe Citologia</h1>

            <h2>Cantidad de muestras</h2> <br> 
            <textarea name="muestras" id="muestras" cols="30" rows="10"></textarea>

            <h2>Categoría general</h2>
            <textarea name="Categoría" id="Categoría" cols="30" rows="10"></textarea>
            
                <br> <br>
            
            Hallazgos
            <button>+</button> 
                <br> <br>
            <form> <input type="text"> <br>
                <input type="text"> <br>
                <input type="text"> <br>
                <input type="text"> <br>
            </form>
                <br> <br>

            Diagnosticos
            <button>+</button>
                <br> <br> 
            <textarea name="Diagnosticos" id="Diagnosticos" cols="30" rows="10"></textarea>     
                <br><br>

            Consulta <br> <br>
                <textarea name="Consulta" id="Consulta" cols="30" rows="10"></textarea> <br> <br>

            Obsevaciones/Comentarios <br> <br>
                <textarea name="Observaciones" id="Observaciones" cols="30" rows="10"></textarea>
        </center> 
    </body>
</html>