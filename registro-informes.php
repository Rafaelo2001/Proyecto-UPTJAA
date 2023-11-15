<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Modulo de generacion de Informes</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="js/jquery-3.7.1.js"></script>
    </head>
    <body style="text-align: center;">
        
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
            

                    <br><br><br>           

                
                <input class="tipo_informe" id="citologia" name="tipo_informe" value="citologia" type="radio"> 
                    <label for="citologia">Citologia</label>
                        
                    -----
                    
                <label for="biopsia">Biopsia</label>        
                    <input class="tipo_informe" id="biopsia" name="tipo_informe" value="biopsia" type="radio">

                   
                    <br><br>


                <h2>Informacion material remitido</h2>
                <textarea name="Informacion" id="Información" cols="100" rows="5"></textarea>

                    <br><br>
                    <hr>
                    <br><br>

                <!--Recordar colocar en el php, determinar cual info enviar de acuerdo al Radio-->
                
                <section id="informe_biopsia" style="display:none">
                    Biopsia!

                    <h1>Informe Biopsia</h1>

                    <h2>Descripción Micro</h2>
                    <textarea name="Categoría" id="Categoría" cols="30" rows="10"></textarea>
                    
                    
                        <br><br>
                    
                
                    <h2>Descripción Macro</h2>
                    <textarea name="Categoría" id="Categoría" cols="30" rows="10"></textarea>
                    
                    
                        <br><br>

                    
                    Diagnosticos
                            <textarea name="Diagnosticos" id="Diagnosticos" cols="30" rows="10"></textarea>     
                                <br><br>
                                
                    Obsevaciones/Comentarios <br> <br>
                                <textarea name="Observaciones" id="Observaciones" cols="30" rows="10"></textarea>
                                <br>
                </section>

                <section id="informe_citologia" style="display:none">
                    Citology!

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

                        
                    Consulta
                        <br><br>
                    <textarea name="Consulta" id="Consulta" cols="30" rows="10"></textarea>
                    

                        <br><br>


                    Obsevaciones/Comentarios
                        <br><br>
                    <textarea name="Observaciones" id="Observaciones" cols="30" rows="10"></textarea>
                </section>

                <button>Enviar</button>
            </form>
        <script src="js/form-informe.js"></script>
    </body>
</html>