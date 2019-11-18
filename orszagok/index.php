<?php
    //$connect objektum elérése (sql kapcsolat) több lehetőség is van:
    //include, include_once, required, required_once
    require_once('Connect.php');
    $sql = "SELECT * FROM foldreszek;";
    $result = $connect -> query($sql);
    if (!$result) {
        die("Eredménytelen a lekérdezés!");
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Országok</title>
</head>
<body>
    <br>
    <form action="#" method="get">
        <select name="continent">
        <?php
            while($row = $result->fetch_array()) {                
                echo '<option value='.$row[0].'>' . $row[1] . '</option>';
            }

        ?>
        </select>
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
            $sql .= " WHERE foldreszkod=".$_GET['continent'];
        }
        
        
        $result = $connect -> query($sql);
       
        if (!$result) {
            die("Eredménytelen a lekérdezés!");
        }

        //var_dump($result);
       
        if ($result->num_rows > 0) {
            // output data of each row
            
            
            while($row = $result->fetch_assoc()) {
                //var_dump($row);                
                echo "<tr><td>" . $row["okod"]. "</td><td>" . $row["onev"]. "</td><td>" . $row["fovaros"]. "</td><td>" . $row["nepesseg"]. "</td></tr>";
            }
            
            
        } else {
            echo "0 results";
        }

    ?>
    </table>";
</body>
</html>