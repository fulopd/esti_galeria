<?php
require_once('config/init.php');

if(!isLogged()){
    $_SESSION['loginError'] = "Képek feltöltéséhez be kell jelentkezni";
    header('Location: login.php');
    die();
}



printHTML('html/header.html');
echo printMenu();
printHTML('html/upload_form.html');
printHTML('html/footer.html');

$con -> close();