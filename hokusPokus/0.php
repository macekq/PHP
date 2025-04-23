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
    #saveBtt{
        position: absolute;
        top: 99%;
        transform: translateY(-100%);
    }
    form{
        position: absolute;
        top: 60vh; left: 0;
    
        padding: 1%;
    }   
</style>
<body>

    <textarea id="in" name="in"></textarea>
    <input type="button" id="saveBtt" value="save">

    <form method="get">
        <label for="nazev">nazev souboru</label>
        <input type="text" id="nazev" name="nazev">
        <input type="submit">
    </form>

    <script>
        document.getElementById('saveBtt').addEventListener("click", () => {
            const input = document.getElementById('in')
            
            
            // console.log("nazev: ", nazev)
            console.log("content", input.value)
        })
    </script>
    <?php
        $soubor = "";
        if(isset($_GET["nazev"])){
            $soubor = $_GET["nazev"];
            
            $file = fopen($soubor, "w");
            if($file){
                $content = file_get_contents($soubor);
                echo "skap";
                echo "<script>test()</script>";
            }
        }
    ?>
</body>
</html>