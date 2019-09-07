<?php

require "Conectar.php";

if ($db = Conectar::conexion()){

    $idContacto = $_POST['idContacto'];
    $actividad = $_POST['actividad'];
    $tiempoMax = $_POST['tiempoMax'];

    $sql = "INSERT INTO prueba (idContacto, idActividad, tiempoMax) VALUES ('$idContacto', '$actividad', '$tiempoMax');";
    $result = mysqli_query($db, $sql) or die('Error al registrar la prueba: ' . mysqli_error($db));

    $ultimo_id = mysqli_insert_id($db);

    $data = array('done' => true, 'message' => $ultimo_id);
    Header('Content-Type: application/json');
    echo json_encode($data);
    exit();

}

?>