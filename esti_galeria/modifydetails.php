<?php

require_once('config/init.php');
if (!isLogged()) {
    header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['id']))) {
    $id = $_POST['id'];
    
    if ((!empty($_POST['cim']))) {
        $cim = $_POST['cim'];
        $cim = mb_strlen($cim) < 64 ? $cim : mb_substr($cim, 0, 64);

        $sql = "UPDATE kepek SET cim = '$cim' WHERE id = $id";
        $con->query($sql);
        if ($con->errno) {
            //Van hiba
            http_response_code(503);
        }
        echo $cim;
        unset($_POST['cim']);
    }

    if (!empty($_POST['desc'])) {
        $desc = $_POST['desc'];
        $desc = mb_strlen($desc) < 1001 ? $desc : mb_substr($desc, 0, 1000);

        $sql = "UPDATE kepek SET leiras = '$desc' WHERE id = $id";
        $con->query($sql);
        if ($con->errno) {
            //Van hiba
            http_response_code(503);
        }
        echo $desc;
        unset($_POST['desc']);
    }
}

$con->close();
