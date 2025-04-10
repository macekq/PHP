<?php

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPasswd = "";
    $dbName = "skap";
    $connection = "";

    $connection = mysqli_connect($dbServer, $dbUser, $dbPasswd, $dbName); //connection bude objekt s moji databazi

    if(!$connection) error_log("databazi nelze pripojit");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
</body>
</html>

<?php

    $username = "bombardinoCrocodilo";
    $sql = "SELECT * FROM users WHERE username = '{$username}'";

    $result = mysqli_query($connection, $sql);

    $arr = ["id", "username", "passwd", "date"];
    
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){

            for($i = 0; $i<4; $i++){

                echo $arr[$i] . " - " . $row[$arr[$i]] . "<br>";
            }
        }
    }
?>