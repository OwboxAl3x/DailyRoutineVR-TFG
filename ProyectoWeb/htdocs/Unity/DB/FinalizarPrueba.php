<?php

require "Conectar.php";

if ($db = Conectar::conexion()) {

    $idPrueba = $_POST['idPrueba'];
    $objetos = $_POST['objetos'];

    $horaFin = new DateTime();
    $horaFin = $horaFin->format('Y-m-d H:i:s');

    $sql = "UPDATE prueba SET objetos = '" . $objetos . "', horaFin = '" . $horaFin . "' WHERE idPrueba = '" . $idPrueba . "';";
    $result = mysqli_query($db, $sql) or die('Error al registrar la prueba: ' . mysqli_error($db));

    $data = array('done' => true, 'message' => "Prueba finalizada");
    Header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

?>