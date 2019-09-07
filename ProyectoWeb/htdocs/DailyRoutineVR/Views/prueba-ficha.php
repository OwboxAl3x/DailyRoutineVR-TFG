<?php

$_SESSION['pestania'] = 3;

include_once 'header.php';
include_once '../../DailyRoutineVR/DB/globals.php';
include_once '../../DailyRoutineVR/Controllers/prueba.php';
include_once '../../DailyRoutineVR/Controllers/objeto.php';

$tipos = array();
$omisiones = array();
$orden = true;

foreach (TIPODETALLE as $tipo)
{
    $tipos += [$tipo => 0];
}

if (isset($_GET['ficha']) && $_GET['ficha'] != '')
{
    $pru = $prueba->obtenerPrueba($_GET['ficha']);
    $detalles = $prueba->obtenerDetalles($pru[0]['idPrueba']);

    $horaIni = new DateTime($pru[0]['horaInicio']);
    $horaFin = new DateTime($pru[0]['horaFin']);
    $diferenciaMinutos = $horaFin->diff($horaIni)->i;

    $termina = ($diferenciaMinutos < $pru[0]['tiempoMax']) ? 'Si' : 'No';

    foreach ($detalles as $deta)
    {
        foreach (TIPODETALLE as $tipo)
        {
            $tipos[$tipo] = ($deta['tipo'] == $tipo) ? $tipos[$tipo] + 1 : $tipos[$tipo];
        }
    }

    foreach (TIPODETALLE as $tipo)
    {
        $tipos[$tipo] = ($tipos[$tipo] == 0) ? '' : $tipos[$tipo];
    }

    if (!$pru[0]['procesada'])
    {
        $aciertos = $pruebaAciertos->obtenerDetalles($pru[0]['idPrueba'], 9);

        $objetos = explode(', ', $pru[0]['objetos']);

        foreach ($objetos as $obj)
        {
            $encontrado = false;

            foreach ($aciertos as $detal)
            {
                if ($detal['texto'] == 'Guarda ' . $obj)
                {
                    $encontrado = true;
                    break 1;
                }
            }

            if (!$encontrado)
            {
                array_push($omisiones, 'Ha olvidado guardar ' . $obj);
            }
        }

        for ($i = 0; $i<count($objetos);$i++)
        {
            if (('Guarda ' . $objetos[$i]) != $aciertos[$i]['texto'])
            {
                $orden = false;
                break 1;
            }
        }

        $result = $prueba->procesar($omisiones, $orden, $pru[0]['idPrueba'], $pru[0]['horaFin']);

        if ($result)
        {
            header('location: ../../DailyRoutineVR/Views/prueba-ficha.php?ficha='.$_GET['ficha']);
        }
    }
}

?>

<link href="../../DailyRoutineVR/CSS/prueba-ficha.css" rel="stylesheet">

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="pruebas.php">Pruebas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informe</li>
        </ol>
    </nav>
</div>
<br>
<div class="container informe">
    <h3>Informe</h3>
    <br>
    <div class="row">
        <div class="col-2">
            <p>Fecha: <?php echo date('d/m/Y', strtotime($pru[0]['fechaRealizada'])); ?></p>
        </div>
        <div class="col-2">
            <p>Hora inicio: <?php echo date('H:i:s', strtotime($pru[0]['horaInicio'])); ?></p>
        </div>
        <div class="col-3">
            <p>Hora de fin: <?php echo date('H:i:s', strtotime($pru[0]['horaFin'])); ?></p>
        </div>
        <div class="col-3">
            <p>Tiempo establecido: <?php echo $pru[0]['tiempoMax'] . ' Minutos'; ?></p>
        </div>
        <div class="col-2">
            <p>Termina antes: <?php echo $termina; ?></p>
        </div>
    </div>
    <br>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-block btn-outline-info" data-toggle="collapse" data-parent="#accordion" href="#collapse11">CRONOGRAMA</button>
            </div>
            <div id="collapse11" class="panel-collapse collapse in">
                <br>
                <div class="panel-body text-center">
                    <?php
                        foreach ($detalles as $deta)
                        {
                            echo '<p>' . date('H:i:s',strtotime($deta['tiempo'])) . ' -> ' . $deta['texto'] . '</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <br>
        <h4 class="text-center">Errores cometidos</h4>
        <br>
        <?php
            foreach ($tipos as $key => $value)
            {
                if ($key != 9)
                {
                    echo
                        '<div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-block btn-outline-info" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $key . '">' . array_search($key, TIPODETALLECOMPLETO) . ' <span class="badge badge-pill badge-danger">' . $tipos[$key] . '</span></button>
                        </div>
                        <div id="collapse' . $key . '" class="panel-collapse collapse in">
                            <br>
                            <div class="panel-body text-center">';

                        foreach ($detalles as $deta)
                        {
                            if ($deta['tipo'] == $key) echo '<p>' . date('H:i:s',strtotime($deta['tiempo'])) . ' -> ' . $deta['texto'] . '</p>';
                        }

                        echo'
                            </div>
                        </div>
                    </div>';
                }
            }
        ?>
        <br>
        <h4 class="text-center">Aciertos</h4>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <button class="btn btn-block btn-outline-info" data-toggle="collapse" data-parent="#accordion" href="#collapse12">OBJETOS GUARDADOS CORRECTAMENTE <span class="badge badge-pill badge-danger"><?php echo $tipos[$key]; ?></span></button>
            </div>
            <div id="collapse12" class="panel-collapse collapse in">
                <br>
                <div class="panel-body text-center">
                    <?php
                    foreach ($detalles as $deta)
                    {
                        if ($deta['tipo'] == '9') echo '<p>' . date('H:i:s',strtotime($deta['tiempo'])) . ' -> ' . $deta['texto'] . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>