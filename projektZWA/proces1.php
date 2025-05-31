<?php

    header("Content-Type: application/json");

    $filesArr = [];
    $asocArr = []; 

    function searchThisDir($dir){
        global $filesArr;
        global $asocArr;

        $files = scandir($dir);

        foreach($files as $i){
            if($i != "." && $i != ".."){
                if(!str_contains($i, ".")){
    
                    searchThisDir("{$dir}/{$i}");
                }
                $filesArr[] = $i;
                $asocArr[] = $dir;
            }
        }
    }

    $dir = $_GET["dir"];
    $mainDir = $_GET["mainDir"];
    $FF = $_GET["FF"];
    $name = $_GET["name"];

    $postData = json_decode(file_get_contents("php://input"), true) ?? $_POST;

    if($FF){
        mkdir("{$dir}/{$name}");
    }else{
        file_put_contents("{$dir}/{$name}", "idk");
    }

    searchThisDir($mainDir);

    $result = [
        "files" => $filesArr,
        "dirs" => $asocArr
    ];

    echo json_encode($result);
?>