<?php

require_once('config/init.php');
$folder = 'images/';
$content = "";
$imgTypes = array("image/png", "image/jpeg", "image/jpg", "image/bmp");
if (!isLogged()) {
    $_SESSION['loginError'] = 'Képek feltöltéséhez először jelentkezz be!';
    header('Location: login.php');
    die();
}
$_SESSION['uploadError'] = '';
$fid = $_SESSION['fid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_FILES['file']))) {

    $fileType = $_FILES['file']['type'];
    $fileName = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    //var_dump($_POST);
    //echo $fileType, $fileName, $tmp;
    if (!in_array($fileType, $imgTypes)) {
        //Nem kép
        $_SESSION['upload'] .= '<h3 class="text-danger">Nem engedélyezett fájltípus!</h3>';
        header('Location: upload.php');
    } else {
        if (file_exists($folder . $fileName)) {
            //Már létezik a kép
            $_SESSION['uploadError'] .= '<h3 class="text-danger">A kép már korábban feltöltésre került!</h3>';            
                        
        } else {
            move_uploaded_file($tmp, $folder . $fileName);
            $sql = "INSERT INTO kepek (fid, cim, fajlnev, utvonal, leiras, keszult, feltoltes) VALUES ($fid, ?, '$fileName', '$folder', ?, ?, CURDATE())";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $title, $desc, $date);
            $stmt->execute();
        }
    }
} else {
    //Nem kattintott a feltöltsére
    if (isset($_POST['submit'])) {
        $_SESSION['uploadError'] .= '<h3 class="text-danger">Nem kattintottál a feltöltés gombra!</h3>';   
    }
}

printHTML('html/header.html');
echo printMenu();
if (!empty($_SESSION['uploadError'])){
    echo $_SESSION['uploadError'];
    unset($_SESSION['uploadError']);
}
printHTML('html/upload_form.html');
printHTML('html/footer.html');
$con->close();
