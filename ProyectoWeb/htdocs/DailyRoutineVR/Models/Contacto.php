<?php

include_once '../../DailyRoutineVR/DB/db.php';

class Contacto extends Conectar
{
    private $contactos;
    private $link;

    public function __construct()
    {
        $this->contactos = array();
        $this->link = self::conexion();
    }

    public function obtenerContactos()
    {
        $query = 'SELECT * FROM contacto;';
        $resultado = mysqli_query($this->link, $query);

        while ($fila = $resultado->fetch_assoc())
        {
            $this->contactos[] = $fila;
        }

        return $this->contactos;
    }

    public function obtenerContactoID($id)
    {
        $query = 'SELECT * FROM contacto WHERE idContacto=' . $id . ';';
        $resultado = mysqli_query($this->link, $query);

        $fila = $resultado->fetch_assoc();

        return $fila;
    }

    public function ultimoNum()
    {
        $query = 'SELECT num FROM contacto ORDER BY num DESC LIMIT 1;';
        $resultado = mysqli_query($this->link, $query);

        $fila = $resultado->fetch_assoc()['num'];

        return $fila;
    }

    public function ultimoidContacto()
    {
        $query = 'SELECT idContacto FROM contacto ORDER BY idContacto DESC LIMIT 1;';
        $resultado = mysqli_query($this->link, $query);

        $fila = $resultado->fetch_assoc()['idContacto'];

        return $fila;
    }

    public function nuevoContacto($num, $alta, $estado, $nombre, $apellidos, $fechaNac, $nacTermino, $gestacion, $nacSemana, $sexo, $domicilio, $cp, $pobla, $provi,
                                  $tele1, $tele2, $tdah, $tdahSubtipo, $vision, $salud, $diagnostico, $medicacion, $escolar, $mochila, $rvirtual)
    {
        $query = 'INSERT INTO `contacto` (`nombre`, `apellidos`, `fechaNac`, `fechaAlta`, `tele1`, 
                                          `tele2`, `estado`, `sexo`, `num`, `nacTermino`, `nacSemana`, `domicilio`, 
                                          `pobla`, `provi`, `cp`, `gestacion`, `tdah`, `tdahSubtipo`, `vision`, `salud`, 
                                          `diagnostico`, `medicacion`, `nivelEscolar`, `mochila`, `rvirtual`) 
                  VALUES ("' .  $nombre . '", "' .  $apellidos . '", "' . $fechaNac . '", "' .  $alta . '", "' . $tele1 . '", "' .  $tele2 . '", "' . $estado . '", 
                          "' .  $sexo . '", "' . $num . '", "' .  $nacTermino . '", "' . $nacSemana . '", "' .  $domicilio . '", "' . $pobla . '", "' .  $provi . '", 
                          "' . $cp . '", "' .  $gestacion . '", "' . $tdah . '", "' .  $tdahSubtipo . '", "' . $vision . '", "' .  $salud . '", "' . $diagnostico . '", 
                          "' .  $medicacion . '", "' . $escolar . '", "' .  $mochila . '", "' . $rvirtual . '");';
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

    public function actualizarContacto($idContacto,  $estado, $nombre, $apellidos, $fechaNac, $nacTermino, $gestacion, $nacSemana, $sexo, $domicilio, $cp, $pobla, $provi,
                                       $tele1, $tele2, $tdah, $tdahSubtipo, $vision, $salud, $diagnostico, $medicacion, $escolar, $mochila, $rvirtual)
    {
        $query = 'UPDATE `contacto` SET `nombre` = "' .  $nombre . '", `apellidos` = "' . $apellidos . '", `fechaNac` = "' .  $fechaNac . '", `tele1` = "' .  $tele1 . '",
                                          `tele2` = "' . $tele2 . '", `estado` = "' .  $estado . '", `sexo` = "' . $sexo . '", `nacTermino` = "' .  $nacTermino . '",
                                          `nacSemana` =  "' . $nacSemana . '", `domicilio` = "' .  $domicilio . '", `pobla` = "' . $pobla . '", `provi` = "' .  $provi . '", `cp` = "' . $cp . '",
                                          `gestacion` = "' .  $gestacion . '", `tdah` = "' . $tdah . '", `tdahSubtipo` = "' .  $tdahSubtipo . '", `vision` = "' . $vision . '",
                                          `salud` = "' .  $salud . '", `diagnostico` = "' . $diagnostico . '", `medicacion` = "' .  $medicacion . '", `nivelEscolar` = "' . $escolar . '",
                                          `mochila` = "' .  $mochila . '", `rvirtual` = "' . $rvirtual . '" WHERE idContacto = "' .  $idContacto . '";';
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

    /**
     * @return array
     */
    public function cambiarEstado($idContacto, $accion)
    {
        $estado = ($accion == 'baja') ? 0 : 1;
        $query = 'UPDATE contacto SET estado = ' . $estado . ' WHERE idContacto = ' . $idContacto . ';';
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

?>