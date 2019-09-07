<?php

require "Conectar.php";

if ($db = Conectar::conexion()){

    $num = $_POST['num'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];

    $sql = "select * from contacto where num='$num';";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0){
        $data = array('done' => false, 'message' => 'Ya existe un usuario con ese número');
        Header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    $query = "insert into contacto (num, nombre, apellidos) values ('$num', '$nombre', '$apellidos');";
    $result = mysqli_query($db, $query) or die('Error al registrar el nuevo usuario: ' . mysqli_error($db));

    $data = array('done' => true, 'message' => "El usuario ha sido registrado con número: $num");
    Header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

?>