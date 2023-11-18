<?php
function check_size($path, $max_size) {
  if (is_file($path)) {
    $filesize = filesize($path);
    return $filesize > $max_size;
  } else {
    $dir_size = 0;

    $dir_iterator = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $file) {
      if ($file->isFile()) {
        $dir_size += $file->getSize();
        if ($dir_size > $max_size) {
          return true;
        }
      }
    }

    return false;
  }
}

?>