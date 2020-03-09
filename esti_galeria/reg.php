<?php

require_once('config/init.php');

$content = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['user'])) && (!empty($_POST['pass']))) {
    
}

printHTML('html/header.html');
echo printMenu();
printHTML('html/reg.html');
echo $content;
printHTML('html/footer.html');

$con->close();
