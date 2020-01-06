<?php
require_once('config/init.php');

printHTML('html/header.html');

echo printMenu();

if (!isLogged()){
    echo 'Képek megtekintéshez először jelentkezz be!';
    //dd($_SESSION);
} else {
    
    $fid = $_SESSION['fid'];
    $sql = "SELECT * FROM kepek WHERE fid = $fid";
    $res = $con -> query($sql);
    if (!$res){
        die('Hiba a lekérdezés végrehajtásában!');
    }
    $content = '';
    while ($row = $res -> fetch_assoc()){
        $content .= '<div class="card col-3">'
                . '<img class="w-100 card-image-top " src="'.$row['utvonal'].$row['fajlnev'].'"'
                . '<div class="card-body">'
                . '<p class="card-text">'.$row['cim'].'</p>'
                . '<p class="btn btn-primary">Részletek</p>'
                . '</div>'                
                . '</div>';
    }
    echo $content;
}

printHTML('html/footer.html');

$con -> close();