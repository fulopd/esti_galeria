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
$_SESSION['uploadError'] = "";
$fid = $_SESSION['fid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_FILES['file']))) {

    $fileType = $_FILES['file']['type'];
    $fileName = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $date = $_POST['date'];
    $size = $_FILES['file']['size'];
    //var_dump($_POST);
    //echo $fileType, $fileName, $tmp;
    if (!in_array($fileType, $imgTypes)) {
        //Nem kép
        $_SESSION['uploadError'] .= '<h3 class="text-danger">Nem engedélyezett fájltípus!</h3>';
    } else {
        //kép
        if ($size > 20000000) {
            $_SESSION['uploadError'] .= '<h3 class="text-danger">Max. 20 MB lehet a feltölthető kép mérete!</h3>';
        } else {
            if (file_exists($folder . $fileName)) {
                //Már létezik a kép
                $_SESSION['uploadError'] .= '<h3 class="text-danger">A kép már korábban feltöltésre került!</h3>';
            } else {
                //Ez a kép még nincs feltöltve
                if (strlen($title) > 64 || strlen($desc) > 1000) {
                    //Túl hosszúak a szöveges mezőben található szövegrészek
                    $title = substr($title, 0, 64);
                    $desc = substr($desc, 0, 1000);
                }
                if (strlen($title) == 0) {
                    $_SESSION['uploadError'] .= '<h3 class="text-danger">A képnek adj címet!</h3>';
                } else {
                    move_uploaded_file($tmp, $folder . $fileName);
                    $sql = "INSERT INTO kepek (fid, cim, fajlnev, utvonal, leiras, keszult, feltoltes) VALUES ($fid, ?, '$fileName', '$folder', ?, ?, CURDATE())";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("sss", $title, $desc, $date);
                    $stmt->execute();
                }
            }
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
if (!empty($_SESSION['uploadError'])) {
    echo $_SESSION['uploadError'];
    unset($_SESSION['uploadError']);
}

printHTML('html/upload_form.html');

printHTML('html/footer.html');
$con->close();
