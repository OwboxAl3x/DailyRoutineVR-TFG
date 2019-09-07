<?php

$_SESSION['pestania'] = 3;

include_once 'header.php';
include_once '../../DailyRoutineVR/Controllers/prueba.php';

$pruebas = $prueba->obtenerPruebas();

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Pruebas</li>
        </ol>
    </nav>
</div>
<br>
<div class="container">
    <div class="table-responsive">
        <table id="contactos" data-exportar class="table table-striped table-bordered" width="100%">
            <thead>
            <tr>
                <th>PRUEBA</th>
                <th>PACIENTE</th>
                <th>ACTIVIDAD</th>
                <th>FECHA DE REALIZACIÓN</th>
                <th>ACCIONES</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($pruebas as $pru)
            {
                echo '<tr>
                        <td>' . $pru['idPrueba'] . '</td>
                        <td>' . $pru['nombre'] . '</td>
                        <td>' . $pru['nombreActividad'] . '</td>
                        <td>' . date('d/m/Y H:i:s', strtotime($pru['fechaRealizada'])) . '</td>
                        <td width="100px" style="text-align: center;"><a href="prueba-ficha.php?ficha=' . $pru['idPrueba'] . '" class="btn btn-info fas fa-eye" title="Editar contacto"></a></td>
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