<?php
function packFolderToZip($folder, $zip_file) {
    $zip = new ZipArchive();

    if ($zip->open($zip_file, ZipArchive::CREATE) !== TRUE) {
        return false;
    }

    if (is_file($folder)) {
        $zip->addFile($folder, basename($folder));
    } else {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folder),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folder) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
    }

    $zip->close();

    if (!file_exists($zip_file)) {
        return false;
    }

    return true;
}
?>