<?php

require "Conectar.php";

if ($db = Conectar::conexion()) {

    $num = $_POST['num'];

    $query = "SELECT idContacto, nombre, apellidos FROM contacto WHERE num='" . $num . "';";
    $result = mysqli_query($db, $query) or die('Query failed: ' . mysqli_error($db));

    $num_results = mysqli_num_rows($result);

    $fila = mysqli_fetch_assoc($result);

    if ($num_results > 0) {
        $data = array('done' => true, 'message' => "Elegido el contacto: " . $fila['idContacto'] . ", " . utf8_encode($fila['nombre']) . " " . utf8_encode($fila['apellidos']));
        Header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    } else {
        $data = array('done' => false, 'message' => 'No existe ningun contacto con ese número');
        Header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

?>