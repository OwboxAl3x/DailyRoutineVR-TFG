<?php

require_once "globals.php";

class Conectar
{
    public static function conexion()
    {
        try {

            $conexion = new mysqli(HOST, USER, PASS, DBNAME);
            $conexion->query("SET NAMES 'utf8'");
            return $conexion;
        } catch (\mysql_xdevapi\Exception $e) {

            print_r('Error en la conexión a la base de datos: ' . $e->getMessage());
        }
    }
}

?>