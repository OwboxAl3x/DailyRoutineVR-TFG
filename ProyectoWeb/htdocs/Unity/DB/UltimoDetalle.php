<?php

require "Conectar.php";

if ($db = Conectar::conexion()) {

    $idPrueba = $_POST['idPrueba'];
    $veces = $_POST['veces'];

    $query = "SELECT idPruebaDetalle, tipo FROM pruebadetalle WHERE idPrueba = '" . $idPrueba . "' ORDER BY idPruebaDetalle DESC LIMIT 1;";
    $result = mysqli_query($db, $query) or die('Query failed: ' . mysqli_error($db));

    $num_results = mysqli_num_rows($result);

    $fila = mysqli_fetch_assoc($result);

    if ($num_results > 0)
    {
        if ($fila['tipo'] == 8)
        {
            $query = "UPDATE pruebadetalle SET texto = 'Se ha querido/conseguido teleportar $veces veces sin coger objetos' WHERE idPruebaDetalle = " . $fila['idPruebaDetalle'] . ";";
            $result = mysqli_query($db, $query) or die('Query failed: ' . mysqli_error($db));

            $data = array('done' => true, 'message' => "Detalle actualizado");
            Header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        }
        else
        {
            $data = array('done' => false, 'message' => 'El último detalle no es de desplazamiento');
            Header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        }
    }
    else
    {
        $data = array('done' => false, 'message' => 'Aún no hay detalles');
        Header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

?>
