<?php
    function smazatDir($dir){

        foreach(scandir($dir) as $item){
            
            if($item == "." || $item == ".."){
                continue;
            }
            if(is_dir($dir . DIRECTORY_SEPARATOR . $item)) smazatDir($dir . DIRECTORY_SEPARATOR . $item);
            else unlink($dir . DIRECTORY_SEPARATOR . $item);
        }
        rmdir($dir);
    }

    if(isset($_GET["nazev"])){
        $name = $_GET["nazev"]; $dir = $_GET["dir"]; $FF = $_GET["SS"];

        if($FF == "true"){
            smazatDir("{$dir}/{$name}");
            
        }else{
            unlink("{$dir}/{$name}");
        }
        exit;
    }
?>