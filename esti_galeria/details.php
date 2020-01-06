<?php
require_once('config/init.php');
if(!isLogged()){
    $_SESSION['loginError'] = "Információ megtekintéséhez be kell jelentkezni";
    header('Location: login.php');
    die();
}
if(!empty($_GET['kep'])){
    $kep = $_GET['kep'];
    $sql = "SELECT * FROM kepek WHERE id = ?";
    $stmt = $con -> prepare($sql);
    $stmt -> bind_param('i',$kep);
}

