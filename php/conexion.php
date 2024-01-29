<?php
class CodeaDB{    
    private $host   ="localhost";
    private $usuario="root";
    private $clave  ="";
    private $db     ="higea_db";
    public $conexion;
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db) or die("error");
        $this->conexion->set_charset("utf8");
    }
    //BUSCAR
    public function buscar($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }

    // BUSCAR x BY
    // Utilizar esta funcion para extraer un valor de la BDD y utilizar en otras funciones
    // Esta funcion retorna el ultimo valor registrado en la tabla
    public function buscarBY($tabla, $columna)
    {
        $resultado = $this->conexion->query("SELECT * FROM $tabla ORDER BY $columna DESC LIMIT 1") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }


    // BUSCAR ONE CELL
    // Utilizar esta funcion para extraer un solo valor de una casilla en especifico de la BDD
    // Esta funcion retorna el ultimo valor registrado en la tabla
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
    // Utilizar esta funcion para determinar si existe o no un registro
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