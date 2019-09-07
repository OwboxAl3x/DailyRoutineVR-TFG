<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyRoutineVR</title>

    <!-- CSS -->
    <link href="../../DailyRoutineVR/CSS/main.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>
<body>
<header class="container">
    <nav class="navbar navbar-expand-lg navbar-light row">
        <div class="logo col">
            <a class="navbar-brand" href="inicio.php">
                <img src="../../DailyRoutineVR/IMG/logo.png" class="d-inline-block align-top" alt="Logo">
            </a>
        </div>
        <div class="menusito text-right col">
            <a class="material-icons" title="Perfil" href="#">perm_identity</a>
            <a class="material-icons" title="Desconectar" href="logout.php">power_settings_new</a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light text-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?php if ($_SESSION['pestania'] == 1) echo 'active'; ?>">
                    <a class="nav-link" href="inicio.php"><h5>Inicio</h5></a>
                </li>
                <li class="nav-item <?php if ($_SESSION['pestania'] == 2) echo 'active';?>">
                    <a class="nav-link" href="contactos.php"><h5>Pacientes</h5></a>
                </li>
                <li class="nav-item <?php if ($_SESSION['pestania'] == 3) echo 'active'; ?>">
                    <a class="nav-link" href="pruebas.php"><h5>Pruebas</h5></a>
                </li>
                <li class="nav-item <?php if ($_SESSION['pestania'] == 4) echo 'active'; ?>">
                    <a class="nav-link" href="objetos.php"><h5>Objetos</h5></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
