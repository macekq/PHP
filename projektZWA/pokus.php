<?php
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");


if (isset($_GET["nazev"]) && isset($_GET["SS"])) {
    $slozka_soubor = $_GET["SS"];
    $nazev = $_GET["nazev"];
    $dir = $_GET["path"];
    $mainDir = $_GET["mainDir"];

    if ($slozka_soubor == "true") {
        mkdir("{$dir}/{$nazev}");
    } else {
        if(!str_contains($nazev, ".")){
            file_put_contents("{$dir}/{$nazev}.txt", "");
        }else{
            file_put_contents("{$dir}/{$nazev}", "");
        }
    }
    
    // // Return the updated directory structure
    // header('Content-Type: application/json');

    // getDirectoryContents($mainDir);
    // $result = [
    //     "files" => $fileArr, "dirs" => $asocArr
    // ];
    
    // echo json_encode($result);
    // exit;
}
?>