<?php
require_once('config/init.php');

$folder = 'images/';
$content = '';
$imgTypes = array('image/jpg','image/png','image/jpeg');


if(!isLogged()){
    $_SESSION['loginError'] = "Képek feltöltéséhez be kell jelentkezni";
    header('Location: login.php');
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_FILES['file']))){
    //var_dump($_FILES['file']);
    $sql = "";
    $fid = $_SESSION['fid'];
    $fileType = $_FILES['file']['type'];
    $fileName = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    
    var_dump($_POST);
    
    if (!in_array($fileType, $imgTypes)) {
        echo "Nem kép";
    }else{
        
        
        move_uploaded_file($tmp, $folder.$fileName); 

        $sql = "INSERT INTO kepek (fid, cim, fajlnev, utvonal, leiras, keszult, feltoltes) "
                        . "VALUES ($fid, ?, $fileName, $folder, ?, ?, CURDATE())";
        $stmt = $con -> prepare($sql);
        $stmt -> bind_param('sss',$title,$description,$date);
        $stmt -> execute();

            
       
        
    }
            
}else{
    //TODO: nem volt POST
}

printHTML('html/header.html');
echo printMenu();
printHTML('html/upload_form.html');
printHTML('html/footer.html');

$con -> close();