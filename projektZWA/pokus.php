<?php
    function deleteSavedDir(){
        echo "<script>USER.files=[]</script>";
        echo "<script>USER.filesAsocDir=[]</script>";
    }
    function searchDir($dir){
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                if(str_contains($file, ".")){

                    echo "<script>addFromDir('{$file}','{$dir}')</script>";
                }else{
                    echo "<script>addFromDir('{$file}','{$dir}')</script>";
                    searchDir("{$dir}/{$file}");
                }
            }
        }
    }

    if(isset($_GET["nazev"]) && isset($_GET["SS"])){
        $slozka_soubor = $_GET["SS"];
        $nazev = $_GET["nazev"];
        $dir = $_GET["path"];
        $mainDir = $_GET["mainDir"];

        if($slozka_soubor){
            mkdir("{$dir}/{$nazev}");
        }else{
            $file = fopen("{$dir}/{$nazev}", "w");
        }
        deleteSavedDir();
        searchDir($mainDir);
        echo "<script>console.log(USER)</script>";
    }
?>