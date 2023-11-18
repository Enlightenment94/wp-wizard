<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function listaPlikow($folder, $rozszerzenia) {
    $pliki = array();
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folder)
    );

    foreach($iterator as $plik) {
        if (!$plik->isFile()) {
            continue;
        }
        $ext = strtolower(pathinfo($plik->getFilename(), PATHINFO_EXTENSION));
        if (in_array($ext, $rozszerzenia)) {
            $pliki[] = $plik->getPathname();
        }
    }

    return $pliki;
}

// Lista rozszerzeń, które chcesz wyszukać
$rozszerzenia = array('php', 'ott', 'zip', 'bin', 'ott', 'oti');

// Ścieżka do folderu, w którym chcesz wyszukać pliki
$folder = '../wp-content/uploads';

// Pobierz listę plików z wybranymi rozszerzeniami we wszystkich podfolderach i folderze
$pliki = listaPlikow($folder, $rozszerzenia);

// Wyświetl listę plików
echo '<ul>';
foreach($pliki as $plik) {
    echo '<li>' . $plik . '</li>';
}
echo '</ul>';
?>