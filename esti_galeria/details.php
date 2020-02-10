<?php

require_once('config/init.php');

if (!isLogged()) {
    $_SESSION['loginError'] = "Információ megtekintéséhez be kell jelentkezni";
    header('Location: login.php');
    die();
}
$html = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && (!empty($_GET['kep']))) {
    $kep = $_GET['kep'];
    $sql = "SELECT * FROM kepek WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $kep);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $fid, $cim, $file, $utvonal, $leiras, $keszult, $feltolt);
    $stmt->fetch();
    $stmt->close();
    //dd($file);

    $html = '<div class="card">'
            . '<div class="card-header">'
            . '<h2 class="cim card-text" data-id="' . $id . '" contenteditable>' . $cim . '</h2>'
            . '</div>'
            . '<div class="card-body">'
            . '<img class="w-25 rounded" src="' . $utvonal . $file . '" alt="kávé" title="' . $cim . '"></img>'
            . '<p class="card-text">' . $leiras . '</p>'
            . '<p class="card-text">Készült: ' . $keszult . '</p>'
            . '<p class="card-text">Feltöltés dátuma: ' . $feltolt . '</p>'
            . '</div>'
            . '</div>';

    printHTML('html/header.html');
    echo printMenu();
    echo $html;

    //------------------------------------------------------------------------
    //lekérem a képek számát
    $sql = "SELECT * FROM kepek";
    $result = $con->query($sql);
    if ($result) {
        $maxKepekSzama = $result->num_rows;
    }
    //Előző kép gomb megjelenítés ha kell
    if ($id > 1) {
        $idElozo = $id - 1;
        echo '<p data-azonosito="' . $idElozo . '" class="reszletek btn btn-primary">Előző kép</p>';
    } else {
        echo '<p class="btn btn-secondary">Előző kép</p>';
    }
    //Következő kép gomb megjelenítés ha kell
    if ($id < $maxKepekSzama) {
        $idKovetkezo = $id + 1;
        echo ' <p data-azonosito="' . $idKovetkezo . '" class="reszletek btn btn-primary">Következő kép</p>';
    } else {
        echo ' <p class="btn btn-secondary">Következő kép</p>';
    }
    //------------------------------------------------------------------------


    printHTML('html/footer.html');
}