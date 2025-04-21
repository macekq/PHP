<?php
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPasswd = "";
    $dbName = "skap";
    $connection = "";

    $connection = mysqli_connect($dbServer, $dbUser, $dbPasswd, $dbName);

    if(!$connection) error_log("databazi nelze pripojit");
    else echo "<script>console.log('databaze pripojena')</script>";

    $sql = "SELECT jmeno FROM projektZWA";
    $result = mysqli_query($connection, $sql);

    while($row = mysqli_fetch_assoc($result)){
        echo "<br>" . $row["jmeno"];
        $dir = "data/". $row["jmeno"];
        if(!file_exists($dir)){
            mkdir($dir);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>