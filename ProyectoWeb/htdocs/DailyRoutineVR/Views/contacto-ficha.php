<?php

$_SESSION['pestania'] = 2;

include_once 'header.php';
include_once '../../DailyRoutineVR/Controllers/contacto.php';

$hoy = new DateTime();

// Guardando un contacto nuevo
if (isset($_POST['Guardar']))
{
    $result = $contacto->nuevoContacto($_POST['num'], $_POST['alta'], $_POST['estado'], $_POST['nombre'], $_POST['apellidos'], $_POST['fechaNac'], $_POST['nacTermino'], $_POST['gestacion'],
        $_POST['nacSemana'], $_POST['sexo'], $_POST['domicilio'], $_POST['cp'], $_POST['pobla'], $_POST['provi'], $_POST['tele1'], $_POST['tele2'], $_POST['tdah'],
        $_POST['tdahSubtipo'], $_POST['vision'], $_POST['salud'], $_POST['diagnostico'], $_POST['medicacion'], $_POST['escolar'], $_POST['mochila'], $_POST['rvirtual']);

    if ($result)
    {
        header("Location ../../DailyRoutineVR/Views/contacto-ficha.php?ficha=" . $_GET['ficha']);
    }
}
elseif (isset($_POST['Modificar']))
{
    $result = $contacto->actualizarContacto($_GET['ficha'], $_POST['estado'], $_POST['nombre'], $_POST['apellidos'], $_POST['fechaNac'], $_POST['nacTermino'], $_POST['gestacion'],
        $_POST['nacSemana'], $_POST['sexo'], $_POST['domicilio'], $_POST['cp'], $_POST['pobla'], $_POST['provi'], $_POST['tele1'], $_POST['tele2'], $_POST['tdah'],
        $_POST['tdahSubtipo'], $_POST['vision'], $_POST['salud'], $_POST['diagnostico'], $_POST['medicacion'], $_POST['escolar'], $_POST['mochila'], $_POST['rvirtual']);

    if ($result)
    {
        header("Location ../../DailyRoutineVR/Views/contacto-ficha.php?ficha=" . $_GET['ficha']);
    }
}

if (isset($_GET['ficha']) && $_GET['ficha'] != '')
{
    $boton = "Modificar";

    $con = $contacto->obtenerContactoID($_GET['ficha']);

    $cumpleanos = new DateTime($con['fechaNac']);
    $annos = $hoy->diff($cumpleanos)->y;

    $idContacto = $_GET['ficha'];
    $num = $con['num'];
    $alta = date('Y-m-d', strtotime($con['fechaAlta']));
    $estado = $con['estado'];
    $nombre = $con['nombre'];
    $apellidos = $con['apellidos'];
    $fechaNac = $con['fechaNac'];
    $nacTermino = $con['nacTermino'];
    $gestacion = $con['gestacion'];
    $nacSemana = $con['nacSemana'];
    $sexo = $con['sexo'];
    $domicilio = $con['domicilio'];
    $pobla = $con['pobla'];
    $provi = $con['provi'];
    $cp = $con['cp'];
    $tele1 = $con['tele1'];
    $tele2 = $con['tele2'];
    $tdah = $con['tdah'];
    $tdahSubtipo = $con['tdahSubtipo'];
    $vision = $con['vision'];
    $salud = $con['salud'];
    $diagnostico = $con['diagnostico'];
    $medicacion = $con['medicacion'];
    $escolar = $con['nivelEscolar'];
    $mochila = $con['mochila'];
    $rvirtual = $con['rvirtual'];
}
else
{
    $boton = "Guardar";
    $idContacto = $contacto->ultimoidContacto() + 1;
    $num = $contacto->ultimoNum() + 1;
    $alta = $hoy->format('Y-m-d');
    $estado = 1;
    $nombre = "";
    $apellidos = "";
    $fechaNac = "";
    $annos = "";
    $nacTermino = "2";
    $gestacion = "";
    $nacSemana = "";
    $sexo = "";
    $domicilio = "";
    $pobla = "";
    $provi = "";
    $cp = "";
    $tele1 = "";
    $tele2 = "";
    $tdah = "2";
    $tdahSubtipo = "0";
    $vision = "2";
    $salud = "";
    $diagnostico = "";
    $medicacion = "";
    $escolar = "";
    $mochila = "2";
    $rvirtual = "2";
}

?>

<link href="../../DailyRoutineVR/CSS/contacto-ficha.css" rel="stylesheet">

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="contactos.php">Pacientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Paciente</li>
        </ol>
    </nav>
</div>
<br>
<div class="container formContacto">
    <h3>Paciente</h3>
    <br>
    <div>
        <form action="contacto-ficha.php?ficha=<?php echo $idContacto; ?>" method="post">
            <div class="form-row">
                <div class="input-group mb-5 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nº Historia</span>
                    </div>
                    <input type="text" class="form-control" readonly name="num" value="<?php echo $num; ?>">
                </div>
                <div class="input-group mb-5 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Alta</span>
                    </div>
                    <input type="text" readonly class="form-control" name="alta" value="<?php echo $alta; ?>">
                </div>
                <div class="input-group mb-5 col-2 ml-auto">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Estado</span>
                    </div>
                    <select class="form-control" name="estado">
                        <option value="1" <?php if ($estado == '1'){ echo 'selected'; }?> >Activo</option>
                        <option value="0" <?php if ($estado == '0'){ echo 'selected'; }?> >Inactivo</option>
                    </select>
                </div>
            </div>

            <h5>Datos Personales</h5>
            <div class="row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nombre *</span>
                    </div>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Apellidos</span>
                    </div>
                    <input type="text" class="form-control" name="apellidos" value="<?php echo $apellidos; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nacimiento *</span>
                    </div>
                    <input type="date" class="form-control" data-date-format="mm/dd/yyyy" name="fechaNac" value="<?php echo $fechaNac; ?>" required>
                </div>
                <div class="input-group mb-3 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Edad</span>
                    </div>
                    <input type="text" disabled class="form-control" value="<?php if ($fechaNac != '') echo $annos; ?>">
                </div>
                <div class="input-group mb-3 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nacimiento a término</span>
                    </div>
                    <select class="form-control" name="nacTermino">
                        <option value="2" <?php if ($nacTermino == '2'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="0" <?php if ($nacTermino == '0'){ echo 'selected'; }?> >No</option>
                        <option value="1" <?php if ($nacTermino == '1'){ echo 'selected'; }?> >Si</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Gestación</span>
                    </div>
                    <input type="text" class="form-control" name="gestacion" value="<?php echo $gestacion; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Semana de nacimiento</span>
                    </div>
                    <input type="number" class="form-control" name="nacSemana" value="<?php echo $nacSemana; ?>">
                </div>
                <div class="input-group mb-3 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Sexo *</span>
                    </div>
                    <select class="form-control" name="sexo" required>
                        <option value="" <?php if ($sexo == ''){ echo 'selected'; }?> >Indefinido</option>
                        <option value="M" <?php if ($sexo == 'M'){ echo 'selected'; }?> >Masculino</option>
                        <option value="F" <?php if ($sexo == 'F'){ echo 'selected'; }?> >Femenino</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Domicilio</span>
                    </div>
                    <input type="text" class="form-control" name="domicilio" value="<?php echo $domicilio; ?>">
                </div>
                <div class="input-group mb-3 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Código postal</span>
                    </div>
                    <input type="text" class="form-control" name="cp" value="<?php echo $cp; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Población</span>
                    </div>
                    <input type="text" class="form-control" name="pobla" value="<?php echo $pobla; ?>">
                </div>
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Provincia</span>
                    </div>
                    <input type="text" class="form-control" name="provi" value="<?php echo $provi; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-5 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Telefono móvil *</span>
                    </div>
                    <input type="text" class="form-control" name="tele1" value="<?php echo $tele1; ?>" required>
                </div>
                <div class="input-group mb-5 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Telefono fijo</span>
                    </div>
                    <input type="text" class="form-control" name="tele2" value="<?php echo $tele2; ?>">
                </div>
            </div>

            <h5>Datos Médicos</h5>
            <div class="form-row">
                <div class="input-group mb-3 col-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">TDAH *</span>
                    </div>
                    <select class="form-control" name="tdah" required>
                        <option value="2" <?php if ($tdah == '2'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="1" <?php if ($tdah == '1'){ echo 'selected'; }?> >Si</option>
                        <option value="0" <?php if ($tdah == '0'){ echo 'selected'; }?> >No</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Subtipo de TDAH</span>
                    </div>
                    <select class="form-control" name="tdahSubtipo">
                        <option value="0" <?php if ($tdahSubtipo == '0'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="1" <?php if ($tdahSubtipo == '1'){ echo 'selected'; }?> >Inatento</option>
                        <option value="2" <?php if ($tdahSubtipo == '2'){ echo 'selected'; }?> >Hiperactivo-Impulsivo</option>
                        <option value="3" <?php if ($tdahSubtipo == '3'){ echo 'selected'; }?> >Combinado</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Problemas de visión *</span>
                    </div>
                    <select class="form-control" name="vision" required>
                        <option value="2" <?php if ($vision == '2'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="1" <?php if ($vision == '1'){ echo 'selected'; }?> >Si</option>
                        <option value="0" <?php if ($vision == '0'){ echo 'selected'; }?> >No</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Problemas de salud</span>
                    </div>
                    <input type="text" class="form-control" name="salud" value="<?php echo $salud; ?>">
                </div>
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Diagnostico</span>
                    </div>
                    <input type="text" class="form-control" name="diagnostico" value="<?php echo $diagnostico; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Medicación</span>
                    </div>
                    <textarea class="form-control" name="medicacion" rows="3"><?php echo $medicacion; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nivel escolar</span>
                    </div>
                    <input type="text" class="form-control" name="escolar" value="<?php echo $escolar; ?>">
                </div>
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Familiarizado con hacer la mochila</span>
                    </div>
                    <select class="form-control" name="mochila">
                        <option value="2" <?php if ($mochila == '2'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="1" <?php if ($mochila == '1'){ echo 'selected'; }?> >Si</option>
                        <option value="0" <?php if ($mochila == '0'){ echo 'selected'; }?> >No</option>
                    </select>
                </div>
                <div class="input-group mb-3 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Familiarizado con la r. virtual</span>
                    </div>
                    <select class="form-control" name="rvirtual">
                        <option value="2" <?php if ($rvirtual == '2'){ echo 'selected'; }?> >NS/NC</option>
                        <option value="1" <?php if ($rvirtual == '1'){ echo 'selected'; }?> >Si</option>
                        <option value="0" <?php if ($rvirtual == '0'){ echo 'selected'; }?> >No</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-info float-right" name="<?php echo $boton ?>"><?php echo $boton ?></button>
            <br>
            <br>
        </form>
    </div>
</div>
<br>