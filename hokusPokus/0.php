<?php
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPasswd = "";
    $dbName = "skap";
    $connection = "";

    $connection = mysqli_connect($dbServer, $dbUser, $dbPasswd, $dbName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    #in{
        top: 0; left: 0;
        position: absolute;
        width: 100vw; height: 50vh;
        background-color: rgb(50,50,50);
        padding: 1%;
        color: white;
    }
    input[type="submit"]{
        position: absolute;
        top: 60vh; left: 0;
    }   
</style>
<body>
    <form method="post">
        <textarea type="text" id="in" name="in"></textarea>
        <input type="submit">
    </form>
    <?php

        if(isset($_POST["in"])){
            // $text = $_POST["in"];
            // echo "<script>console.log('" . $text . "')</script>";
            // echo $text;

            $text = "CREATE TABLE userFiles(nazevSouboru varchar() not null primary key, userId int not null, foreign key (userId) references projektZWA (id));";
            mysqli_query($connection, $text);
        }
    ?>
</body>
</html>