<?php

require_once('config/init.php');

if (!isLogged()) {
    $_SESSION['loginError'] = 'Képek feltöltéséhez először jelentkezz be!';
    header('Location: login.php');
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['cim']))){
    $cim = $_POST['cim'];
}

$fid = $_SESSION['fid'];


printHTML('html/header.html');
echo printMenu();

printHTML('html/upload_form.html');
printHTML('html/footer.html');
$con->close();
