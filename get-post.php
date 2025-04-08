<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="get-post.php" method="post">
        <input type="text" id="jmeno" name="jmeno">
        <label for="jmeno">jmeno</label>
        <input type="text" id="prijmeni" name="prijmeni">
        <label for="prijmeni">prijmeni</label>
        <br><br>
        <input type="submit" value="submit">
    </form>
    <br>
    <!-- <form action="get-post.php" method="get">
        <input type="number" id="num" name="num">
        <label for="num">mnozstvi</label>
        <br><br>
        <input type="submit" value="submit">
    </form> -->
</body>
</html>
<?php

    echo "pizdo{$_POST["jmeno"]}skap";
    // echo "pizdo{$_GET["num"]}skap";

?>

<!-- get uklada informace do url adresy => neni bezpecny ale je lepsi pro orientaci a webu a vlozene hodnoty se daji zmenit v url -->
<!-- post neuklada info do url adresy => je bezpecnejsi a proto se pouziva pu prihlaseni a registrace-->