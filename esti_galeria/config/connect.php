<?php

$con = new mysqli('localhost','root','','esti_galeria','3306');

if ($con -> errno){
    die('Nem sikerült csatlakozi az adatbázishoz!');
}
if (!$con ->set_charset('utf8')){
    echo 'A karakterkódolás beállísa sikertelen!';
}
