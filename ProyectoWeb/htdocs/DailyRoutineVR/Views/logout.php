<?php

include_once '../Models/UserSession.php';

$userSession = new UserSession();
$userSession->closeSession();

header('location: ../index.php');

?>