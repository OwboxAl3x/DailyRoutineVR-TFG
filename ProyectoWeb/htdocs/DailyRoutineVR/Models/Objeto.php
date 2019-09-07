<?php

include_once '../../DailyRoutineVR/DB/db.php';

class Objeto extends Conectar
{
    private $objetos;
    private $link;

    public function __construct()
    {
        $this->objetos = array();
        $this->link = self::conexion();
    }

    public function getObjetos($tipo = false)
    {
        $query = ($tipo) ? 'SELECT * FROM objeto WHERE tipo = ' . $tipo . ';' : 'SELECT * FROM objeto;';
        $resultado = mysqli_query($this->link, $query);

        while ($fila = $resultado->fetch_assoc())
        {
            $this->objetos[] = $fila;
        }

        return $this->objetos;
    }



    public function setTipo($idObjeto, $tipo)
    {
        $query = 'UPDATE objeto SET tipo = ' . $tipo . ' WHERE idObjeto = ' . $idObjeto . ';';
        $resultado = mysqli_query($this->link, $query);

        if ($resultado)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}