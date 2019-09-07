<?php

include_once 'DB/db.php';

class Usuario extends Conectar
{
    private $nombre;
    private $email;

    public function userExists($email, $pass)
    {
        $md5pass = md5($pass);

        $link = self::conexion();
        $query = 'SELECT * FROM usuario WHERE email = "' . $email . '" AND pass = "' . $md5pass .'";';
        $resultado = mysqli_query($link, $query);

        if ($resultado->num_rows > 0)
        {
            $link->close();
            return true;
        }
        else
        {
            $link->close();
            return false;
        }
    }

    public function setUser($email)
    {
        $link = self::conexion();
        $query = 'SELECT * FROM usuario WHERE email = "' . $email . '";';
        $resultado = mysqli_query($link, $query);

        $user = $resultado->fetch_assoc();

        $this->nombre = $user['nombre'];
        $this->email = $user['email'];
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }
}

?>