<?php
require_once('config/init.php');
if (!isLogged()){
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['cim'])) &&(!empty($_POST['id']))){
    $cim = $_POST['cim'];
    $cim = strlen($cim) < 6 ? $cim : substr($cim, 0, 6); 
    $id = $_POST['id'];
    $sql = "UPDATE kepek SET cim = '$cim' WHERE id = $id";
    $con -> query($sql);
    if ($con -> errno){
        //Van hiba
        http_response_code(503);
    }
    echo $cim;
}

$con -> close();