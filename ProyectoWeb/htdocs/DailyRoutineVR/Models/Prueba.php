<?php

include_once '../../DailyRoutineVR/DB/db.php';

class Prueba extends Conectar
{
    private $pruebas;
    private $pruebaDetalles;
    private $link;

    public function __construct()
    {
        $this->pruebas = array();
        $this->pruebaDetalles = array();
        $this->link = self::conexion();
    }

    public function obtenerPruebas()
    {
        $query = 'SELECT a.nombre AS nombreActividad, p.*, CONCAT(c.nombre, " ", c.apellidos) AS nombre 
                  FROM prueba AS p
                  INNER JOIN contacto AS c ON c.idContacto=p.idContacto
                  INNER JOIN actividad AS a ON a.idActividad=p.idActividad;';
        $resultado = mysqli_query($this->link, $query);

        while ($fila = $resultado->fetch_assoc())
        {
            $this->pruebas[] = $fila;
        }

        return $this->pruebas;
    }

    public function obtenerPrueba($idPrueba)
    {
        $query = 'SELECT p.*, CONCAT(c.nombre, " ", c.apellidos) AS nombre 
                  FROM prueba AS p
                  INNER JOIN contacto AS c ON c.idContacto=p.idContacto
                  WHERE idPrueba = ' . $idPrueba . ';';
        $resultado = mysqli_query($this->link, $query);

        $this->pruebas[] = $resultado->fetch_assoc();

        return $this->pruebas;
    }

    public function obtenerDetalles($idPrueba, $tipo = false)
    {
        $query = ($tipo) ? 'SELECT * FROM pruebadetalle WHERE idPrueba = ' . $idPrueba . ' AND tipo = ' . $tipo . ';'
                         : 'SELECT * FROM pruebadetalle WHERE idPrueba = ' . $idPrueba . ';';

        $resultado = mysqli_query($this->link, $query);

        while ($fila = $resultado->fetch_assoc())
        {
            $this->pruebaDetalles[] = $fila;
        }

        return $this->pruebaDetalles;
    }

    public function procesar($omisiones, $orden, $idPrueba, $hora)
    {
        if (!$orden)
        {
            $query = 'INSERT INTO pruebadetalle(idPrueba, tipo, texto, tiempo) 
                      VALUES ("'.$idPrueba.'", "3", "No ha seguido el orden de la lista", "'.$hora.'");';
            $resultado = mysqli_query($this->link, $query);
        }

        $query = 'INSERT INTO pruebadetalle(idPrueba, tipo, texto, tiempo) 
                  VALUES ';

        $i = 1;
        foreach ($omisiones as $omision)
        {
            $query .= '("'.$idPrueba.'", "1", "'.$omision.'", "'.$hora.'")';
            $query .= ($i == count($omisiones)) ? ';' : ',';
            $i++;
        }
        $query .=

        $resultado = mysqli_query($this->link, $query);

        $query = 'UPDATE prueba SET procesada = 1 WHERE idPrueba = '.$idPrueba.';';

        $resultado = mysqli_query($this->link, $query);

        return $resultado;
    }
}