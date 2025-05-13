<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function getDirectoryContents($dir) {
    $result = ['files' => [], 'dirs' => []];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $result['dirs'][$file] = getDirectoryContents($path);
            } else {
                $result['files'][] = $file;
            }
        }
    }
    return $result;
}

if (isset($_GET["nazev"]) && isset($_GET["SS"])) {
    $slozka_soubor = $_GET["SS"];
    $nazev = $_GET["nazev"];
    $dir = $_GET["path"];
    $mainDir = $_GET["mainDir"];

    if ($slozka_soubor) {
        mkdir("{$dir}/{$nazev}");
    } else {
        file_put_contents("{$dir}/{$nazev}", 'mama te nechtela');
    }
    
    // Return the updated directory structure
    header('Content-Type: application/json');
    echo json_encode(getDirectoryContents($mainDir));
    exit;
}
?>