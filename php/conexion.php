<?php
    
    // Declaracion de la clase CodeDB para el manejo de la conexion con la BDD e inclusion de varias funciones utilitarias
    class CodeaDB{    

        // Declaracion de variables para la coneccion de datos
        private $host   ="localhost";
        private $usuario="root";
        private $clave  ="";
        private $db     ="higea_db";
        public $conexion;

        // Constructor de esta clase, conecta con la BDD cada vez que se crea una nueva instacia de ella
        public function __construct(){
            $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db) or die("error");
            $this->conexion->set_charset("utf8");
        }


        //BUSCAR
        // Una funcion que busca datos en la BDD, sin restricciones adicionales
        public function buscar($tabla, $condicion){
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }


        // BUSCAR x BY
        // Esta funcion retorna el ultimo valor registrado en una tabla $tabla, ordenado segun una columna $columna
        public function buscarBY($tabla, $columna)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
            if($resultado)
                return $resultado->fetch_all(MYSQLI_ASSOC);
            return false;
        }


        // BUSCAR SINGLE ROW
        // Esta funcion extrae una sola fila de la BDD
        public function buscarSINGLE($tabla, $condicion)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
            if($resultado){
                $data = $resultado->fetch_all(MYSQLI_ASSOC);
                return $data[0];
            }
            return false;
        }


        // BUSCAR ONE CELL
        // Esta funcion extrae un solo valor de una casilla en especifica de la BDD, siendo el ultimo registro guardado si no hay mas condiciones
        public function buscarONE($tabla, $condicion, $columna)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $condicion DESC LIMIT 1") or die($this->conexion->error);
            if($resultado){
                $data = $resultado->fetch_all(MYSQLI_ASSOC);
                return $data[0][$columna];
            }
            return false;
        }

        
        // BUSCAR EXISTENCIA
        // Esta funcion determina si existe o no un registro
        // Esta funcion retorna verdaro si existe o falso si no existe
        public function buscarExistencia($tabla, $condicion)
        {
            $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion");
            if($resultado === false){
                die($this->conexion->error);
            }
            return ($resultado->num_rows == 0) ? false : true;
        }
    }