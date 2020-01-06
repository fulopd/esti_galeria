<?php

function dd($var) {
    var_dump($var);
    die();
}

function isLogged() {
    if (!empty($_SESSION['fid'])) {
        return true;
    } else {
        return false;
    }
}

function printHTML($html) {
    echo file_get_contents($html);
}

function printMenu() {
    $menu = file_get_contents('html/menu.html');
    if (isLogged()) {
        $menu = str_replace('::ki_belepes', '<li class="nav-item">  <a class="nav-link text-light" href="logout.php">Kilép</a> </li>', $menu);
    } else {
        $menu = str_replace('::ki_belepes', '<li class="nav-item">  <a class="nav-link text-light" href="login.php">Belép</a> </li>', $menu);
    }
    return $menu;
}
