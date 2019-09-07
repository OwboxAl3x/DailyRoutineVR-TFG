<?php

require "Conectar.php";

$objetos = "";

if ($db = Conectar::conexion()) {

    $actividad = $_POST['actividad'];

    $query = "SELECT idObjeto, nombre, tipo FROM objeto WHERE actividad='" . $actividad . "';";
    $result = mysqli_query($db, $query) or die('Query failed: ' . mysqli_error($db));

    $num_results = mysqli_num_rows($result);
    $i = 1;

    if ($num_results > 0) {

        while ($fila = mysqli_fetch_assoc($result)){
            $objetos .= $fila['idObjeto'] . "," . utf8_encode($fila['nombre']) . "," . $fila['tipo'];
            if ($num_results != $i) $objetos .= ";";
            $i++;
        }

        $data = array('done' => true, 'message' => $objetos);
        Header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

?>