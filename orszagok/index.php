<?php
    //$connect objektum elérése (sql kapcsolat) több lehetőség is van:
    //include, include_once, required, required_once
    require_once('Connect.php');
    $sql = "SELECT * FROM foldreszek;";
    $result = $connect -> query($sql);
    if (!$result) {
        die("Eredménytelen a lekérdezés!");
    }
    $numRows = 0;
    $pages = 0;
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <script src="jquery-3.3.1.min.js"></script>
<!--    <script src="orszag.js"></script>-->
    <title>Országok</title>
</head>
<body>
    <br>    
    <form action="#" method="get">
        <select name="continent">
            <option value="0">Mind</option>
        <?php
            while($row = $result->fetch_array()) {                
                echo '<option value='.$row[0].'>' . $row[1] . '</option>';
            }

        ?>
        </select>
        <select name="limit">
            <option>Mind</option>
            <option>10</option>
            <option>20</option>
            <option>30</option>
        </select>
        <p>
        <p>
            Növekvő <input type="radio" name="rendezes" value="ASC" checked="true">
            Csökkenő <input type="radio" name="rendezes" value="DESC">
        </p>
        <p>
            Ország <input type="checkbox" name="category[]" value="o">
            Főváros <input type="checkbox" name="category[]" value="f">
            Népesség <input type="checkbox" name="category[]" value="n">
        </p>
        <input type="submit" value="Szűrés" class="btn btn-outline-primary">
    </form>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">    
            <tr>
                <th>Ország kód</th>
                <th>Ország név</th>
                <th>Főváros</th>
                <th>Népesség</th>
            </tr>
        </thead>

    <?php    
        $sql = "SELECT * FROM orszagok";

        if(isset($_GET['continent'])){
            $sql .= $_GET['continent'] != 0 ? " WHERE foldreszkod=".$_GET['continent'] : "";
        }    
        
        $result = $connect -> query($sql);
        if($result){
            $numRows = $result -> num_rows;
        }
        
        if (!empty($_GET['category'])){
            $order = " ORDER BY";
            foreach ($_GET['category'] as $cat) {
                switch ($cat) {
                    case "o":
                        $order .= " onev,";
                        break;
                    case "f":
                        $order .= " fovaros,";
                        break;
                    case "n":
                        $order .= " nepesseg,";
                        break;
                    default:
                        break;
                }
            }
            $order = substr($order, 0, -1);
            $sql .= $order;
            
            $sql .= " ".$_GET['rendezes'];
        }
        
        if(!empty($_GET['limit'])&& $_GET['limit'] != "Mind"){
            
            $limit = $_GET['limit'];
            if(!empty($_GET['page'])){
                
                $page = $_GET['page'] - 1;
                $sql .= " LIMIT " . $page * $limit . "," . $limit;
            }else{
            
                $sql .= " LIMIT 0,".$limit;
            }
            $pages = ceil($numRows / $limit);
        }
        
        echo $sql;
        
        $result = $connect -> query($sql);       
        if (!$result) {
            die("Eredménytelen a lekérdezés!");
        }

//        var_dump($result);
       
        if ($result->num_rows > 0) {
            // output data of each row
            
            
            while($row = $result->fetch_assoc()) {
                //var_dump($row);                
                echo "<tr><td>" . $row["okod"]. "</td><td>" . $row["onev"]. "</td><td>" . $row["fovaros"]. "</td><td>" . $row["nepesseg"]. "</td></tr>";
            }
            
        } else {
            echo "0 results";
        }
        echo "</table>";
        echo $pages . "<br>";
        $url =  $_SERVER['QUERY_STRING'];
        
        if (strpos($url, 'page') !== false) {
            echo strpos($url, 'page');
            $temp = strpos($url, 'page');
            $url = substr($url, 0,$temp-1);
        }
        
        for ($i = 1; $i <= $pages ; $i++ ){
            echo '<a href="index.php?'.$url.'&page='.$i.'">'.$i.'</a> ';
            
        }
        echo $url;
    ?>
    
</body>
</html>