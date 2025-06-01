<?php

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

header("Location: http://localhost/PHP/projektZWA/index.php");

if (isset($_GET["nazev"]) && isset($_GET["SS"])) {
    $slozka_soubor = $_GET["SS"];
    $nazev = $_GET["nazev"];
    $dir = $_GET["path"];

    if ($slozka_soubor == "true") {
        mkdir("{$dir}/{$nazev}");
    } else {
        file_put_contents("{$dir}/{$nazev}", '');
    }

    exit;
}
?>