<?php

require_once "config.php";

class Conectar
{
    public static function conexion(){
        $conexion = new mysqli(HOST, USER, PASS, DBNAME);
        if (!$conexion) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysqli_error());

        return $conexion;
    }

}