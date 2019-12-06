<?php

    //tesztelésre
    function dd($var){
        var_dump($var);
        die();
    }

    //eldönti hogy be van e jelentkezve
    function isLogged(){
        if(!empty($_SESSION['fid'])){
            return true;
        }else{
            return false;
        }
    }
    
    //html file kiíratása
    function printHTML($html){
        echo file_get_contents($html);
    }

?>