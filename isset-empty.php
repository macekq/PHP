<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="isset-empty.php" method="post">

        <input type="text" id="jmeno" name="jmeno">
        <input type="text" id="prijmeni" name="prijmeni">

        <input type="submit" name="submit" value="submit">
    </form>

</body>
</html>

<?php

    //isset() vrati TRUE (1) pokud je promenna deklerovana a neni null
    //empty() vrati TRUE pokud promnenna neni deklerovana == false, null, ""  

    $text = "skap";
    // $text = "";
    // $text = null;

    if(isset($text)){
        echo "is set";
    }else{
        echo "is not set";
    }

    echo "<br>";

    if(empty($text)) echo "empty";
    else echo "not empty";

    if(isset($_POST["submit"])){
        
        echo "submit 👍🏻👍🏻";
        
        if(empty($_POST["jmeno"])){
        
            echo "jmeno 👎🏻👎🏻";
        }else{

            echo "jmeno {$_POST["jmeno"]}";
        }
    }

?>