<?php

include_once 'Models/Usuario.php';
include_once 'Models/UserSession.php';

$userSession = new UserSession();
$user = new Usuario();

if (isset($_POST['email']) && isset($_POST['pass']))
{
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if ($user->userExists($email, $pass))
    {
        $userSession->setCurrentUser($email);
        $user->setUser($email);
        header('location: ../DailyRoutineVR/Views/inicio.php');
    }
    else
    {
        $errorLogin = 'Email/Password incorrecto';
        include_once 'Views/login.php';
    }
}
elseif (isset($_SESSION['email']))
{
    header('location: ../DailyRoutineVR/Views/inicio.php');
}
else
{
    include_once 'Views/login.php';
}

?>
