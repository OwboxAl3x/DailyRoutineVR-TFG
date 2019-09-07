<?php

$_SESSION['pestania'] = 4;

include_once 'header.php';
include_once '../../DailyRoutineVR/Controllers/objeto.php';

if (isset($_POST['guardar']))
{
    if (count($_POST['from']) > 0)
    {
        foreach ($_POST['from'] as $bueno)
        {
            $result = $objeto->setTipo($bueno, 1);
        }
    }

    if (count($_POST['to']) > 0)
    {
        foreach ($_POST['to'] as $malo)
        {
            $result = $objeto->setTipo($malo, 2);
        }
    }
}

$objetos = $objeto->getObjetos();

?>

<link href="../../DailyRoutineVR/CSS/objetos.css" rel="stylesheet">

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Objetos</li>
        </ol>
    </nav>
</div>
<div class="container">
    <form method="post" action="objetos.php">
        <div class="row">
            <div class="col-sm-5">
                <h3>Buenos</h3>
                <select name="from[]" id="search" class="form-control" size="20" multiple="multiple">
                    <?php
                        $i = 1;
                        foreach ($objetos as $obj){
                            if ($obj['tipo'] == '1'){
                                echo '<option value="' . $obj['idObjeto'] . '" data-position="' . $i . '">' . $obj['nombre'] . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="col-sm-2">
                <br><br><br><br><br><br><br><br><br>
                <button type="button" id="search_rightAll" class="btn btn-outline-secondary btn-block"><i class="fas fa-angle-double-right"></i></button>
                <button type="button" id="search_rightSelected" class="btn btn-outline-info btn-block"><i class="fas fa-angle-right"></i></button>
                <button type="button" id="search_leftSelected" class="btn btn-outline-info btn-block"><i class="fas fa-angle-left"></i></button>
                <button type="button" id="search_leftAll" class="btn btn-outline-secondary btn-block"><i class="fas fa-angle-double-left"></i></button>
            </div>

            <div class="col-sm-5">
                <h3>Malos</h3>
                <select name="to[]" id="search_to" class="form-control" size="20" multiple="multiple">
                    <?php
                    foreach ($objetos as $obj){
                        if ($obj['tipo'] == '2'){
                            echo '<option value="' . $obj['idObjeto'] . '" data-position="' . $i . '">' . $obj['nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col text-aling-center">
                <button type="submit" name="guardar" class="btn btn-info btn-block">GUARDAR</button>
            </div>
        </div>
    </form>
</div>
<br>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="../JS/multiselect.min.js"></script>

<script src="../JS/objetos.js"></script>