<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


$filesArr = [];
$asocArr = [];
//-------------------------------------------------------------------------
function getDirectoryContents($dir){
    
    global $filesArr;
    global $asocArr;
    
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {

            if(strpos($file, ".")){

                $filesArr[] = $file;
                $asocArr[] = $dir;
                getDirectoryContents("{$dir}/{$file}");
            
            }else{

                $filesArr[] = $file;
                $asocArr[] = $dir;
            }
        }
    }
}

if (isset($_GET["nazev"]) && isset($_GET["SS"])) {
    $slozka_soubor = $_GET["SS"];
    $nazev = $_GET["nazev"];
    $dir = $_GET["path"];
    $mainDir = $_GET["mainDir"];

    if ($slozka_soubor == "true") {
        mkdir("{$dir}/{$nazev}");
    } else {
        file_put_contents("{$dir}/{$nazev}", 'mama te nechtela');
    }

    global $filesArr;
    global $asocArr;

    $filesArr = [];
    $asocArr = [];

    getDirectoryContents($mainDir);
    $result = [
        'files' => $filesArr,
        'dirs' => $asocArr,
        'main dir' => $mainDir,
        'dir' => $dir
    ];
    // Return the updated directory structure
    header('Content-Type: application/json');
    echo json_encode($filesArr);
    exit;
}

?>