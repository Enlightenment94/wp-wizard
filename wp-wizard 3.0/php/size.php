<?php
function get_file_size($filePath) {
    $maxSize = 32 * 1024 * 1024; // 32MB w bajtach
    $bufferSize = 4096; 
    $fileSize = 0;
    
    $file = fopen($filePath, 'r');
    if (!$file) {
        return -1; 
    }
    
    while (!feof($file)) {
        $buffer = fread($file, $bufferSize);
        $fileSize += strlen($buffer);
        
        if ($fileSize > $maxSize) {
            fclose($file);
            return -1; 
        }
    }
    
    fclose($file);
    return $fileSize;
}

function check_size($path, $max_size) {
  if (is_file($path)) {
    $filesize = get_file_size($path);
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