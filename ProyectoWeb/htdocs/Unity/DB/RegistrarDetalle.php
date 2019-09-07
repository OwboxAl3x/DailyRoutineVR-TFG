<?php

require "Conectar.php";

if ($db = Conectar::conexion()){

    $idPrueba = $_POST['idPrueba'];
    $tipo = TIPODETALLE[$_POST['tipo']];
    $texto = $_POST['texto'];

    $sql = "INSERT INTO pruebadetalle (idPrueba, tipo, texto) VALUES ('$idPrueba', '$tipo', '$texto');";
    $result = mysqli_query($db, $sql) or die('Error al registrar el detalle de la prueba: ' . mysqli_error($db));

    $data = array('done' => true, 'message' => "El detalle ha sido insertado");
    Header('Content-Type: application/json');
    echo json_encode($data);
    exit();

}

?>