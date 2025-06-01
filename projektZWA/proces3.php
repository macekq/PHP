<?php
    if(isset($_GET["nazev"])){
        $name = $_GET["nazev"]; $dir = $_GET["dir"];
    
        if(!file_exists("{$dir}/{$name}")){
            echo "nenalezeno :(";
        }else{

            $content = file_get_contents("{$dir}/{$name}");
            $returnText = str_replace(["\r\n", "\r", "\n"], '■', $content);

            echo $returnText;
        }
    }
?>