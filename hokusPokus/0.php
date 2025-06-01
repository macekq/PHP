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
        width: 50vw; height: 50vh;
        background-color: rgb(50,50,50);
        padding: 16px;
        color: white;
        z-index: 0;
    }
    #saveBtt{
        position: absolute;
        top: 99%;
        transform: translateY(-100%);
    }
    #f1{
        position: absolute;
        top: 0; left: 0;
    
        padding: 1%;
    }
    #f2{
        position: absolute;
        top: 70vh;
    }
    #f3{
        position: absolute;
        top: 80vh;
    }
    #box{
        position: absolute;
        top: 100%;
        transform: translateY(-100%);
        width: 100vw; height: 20vh;
    }
</style>
<body>
    <form method="post" id="f1">
        <textarea id="in" name="in"></textarea>

        <div style="position: absolute; top: 60vh;">
            <label for="nazev">nazev souboru</label>
            <input type="text" id="nazev" name="nazev">
            <input type="submit" id="saveBtt" value="save">
        </div>
    </form>
    <form method="post" id="f2">
        <label for="nazevSouboru">otevrit soubor</label>
        <input type="text" id="nazevSouboru" name="nazevSouboru">
        <input type="submit">
    </form>

    <form method="post" id="f3">
        <label for="dir">dir</label>
        <input type="text" id="dir" name="dir">
        <input type="submit">
    </form>

    <script>
        function writeOutContent(content){
            console.log(content.split('■').join("\n"))
            document.getElementById('in').value = content.split('■').join('\n')
        }
        document.getElementById('saveBtt').addEventListener("click", () => {
            const input = document.getElementById('in')
            
            // console.log("nazev: ", nazev)
            console.log("content", input.value)
        })
    </script>
    <?php
        $soubor = ""; $content;
        if(isset($_POST["nazev"])){
            $soubor = $_POST["nazev"];
            $content = $_POST["in"];
            
            $file = fopen($soubor, "w");
            if($file){
                file_put_contents($soubor, $content);
                // $content = file_get_contents($soubor); 
                // echo "<script>writeOutContent('" . $content . "')</script>";
            }
        }

        //=======================================================
        if(isset($_POST["nazevSouboru"])){
            $nazev = $_POST["nazevSouboru"];

            if(!file_exists($nazev)){
                echo "<script>window.alert('spatny nazev')</script>";
            }else{
                echo "true2";
                $content = file_get_contents($nazev);
                $clean_text = str_replace(["\r\n", "\r", "\n"], '■', $content);
                // echo $content;
                // echo $clean_text;
                echo "<script>window.alert('{$clean_text}')</script>";
                echo "<script>writeOutContent('" . $clean_text . "')</script>";
            }
        }
        //=======================================================

        if(isset($_POST["dir"])){
            $dir = $_POST["dir"];
            $files = scandir($dir);

            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo "<script>console.log('" . $file . "')</script>";
                }
            }
        }
    ?>
</body>
</html>