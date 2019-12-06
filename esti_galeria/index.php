<?php   
    require_once('config/init.php');
    
    printHTML("html/header.html");
        
    $menu = file_get_contents("html/menu.html");
    
    if (isLogged()) {
        $menu = str_replace('::ki_belepes', 
                '<li class="nav-item">'
                    . '<a class="nav-link text-light" href="logout.php">Kilepes</a>'
                    . '</li>',
                $menu);
    }else{
        $menu = str_replace('::ki_belepes',
                '<li class="nav-item">'
                    . '<a class="nav-link text-light" href="login.php">Bejelentkezés</a>'
                    . '</li>',
                $menu);
    }    
    echo $menu;
    
    printHTML("html/footer.html");    
    $connect -> close();
?>
