<?php

$_SESSION['pestania'] = 2;

include_once 'header.php';
include_once '../../DailyRoutineVR/Controllers/contacto.php';

if (isset($_POST['accion']) && isset($_POST['idContacto']) && $_POST['idContacto'] != "")
{
    $result = $contacto->cambiarEstado($_POST['idContacto'], $_POST['accion']);
}

$contactos = $contacto->obtenerContactos();

?>

<link href="../../DailyRoutineVR/CSS/contactos.css" rel="stylesheet">

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Pacientes</li>
        </ol>
    </nav>
</div>

<br>
<div class="container">
    <div class="botonera">
        <div class="input-group mb-3">
            <input type="submit" class="btn btn-info" value="Nuevo Contacto" id="nuevo_contacto_ficha" name="contactoNuevo">
        </div>
    </div>
    <br>
    <br>
    <div class="table-responsive">
        <table id="contactos" data-exportar class="table table-striped table-bordered" width="100%">
            <thead>
            <tr>
                <th>NUM</th>
                <th>NOMBRE</th>
                <th>TELEFONO</th>
                <th>FECHA DE NACIMIENTO</th>
                <th>ACCIONES</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($contactos as $con)
            {
                $estado = ($con['estado'] == 1) ? '<a onclick="bajaContacto(' . $con["idContacto"] . ');" class="btn btn-danger fas fa-arrow-down" title="Dar de baja al contacto"></a>'
                                           : '<a onclick="altaContacto(' . $con["idContacto"] . ');" class="btn btn-success fas fa-arrow-up" title="Dar de alta al contacto"></a>';
                $fechaNac = ($con['fechaNac'] == '0000-00-00') ? '' : date("d/m/Y", strtotime($con['fechaNac']));

                echo '<tr>
                            <td>' . $con['num'] . '</td>
                            <td>' . $con['nombre'] . '</td>
                            <td>' . $con['tele1'] . '</td>
                            <td>' . $fechaNac . '</td>
                            <td width="100px" style="text-align: center;"><a href="contacto-ficha.php?ficha=' . $con['idContacto'] . '" class="btn btn-info fas fa-user-edit" title="Editar contacto"></a>' . $estado . ' </td>
                      </tr>';
            }

            ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="../JS/contactos.js"></script>