<?php
    require_once('config/init.php');
    
    printHTML("html/header.html");
    echo printMenu();
    
?>

<br>
<div class="centerForm">
    <form action="#">
        <div class="form-group col-md-3">
        Email cím: <input class="form-control" type="text" name="email" value="">
        <br>
        Jelszó: <input class="form-control" type="password" name="password" value="">  
        <br>
        <input class="btn btn-primary" type="submit" value="Belépés">
        </<div>
    </form> 
</div>
<?php
    printHTML("html/footer.html");    
    $connect -> close();
?>