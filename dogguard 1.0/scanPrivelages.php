<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("php/ls.php");

echo "<pre>Default privelages:
.htaccess — 444 lub 400
wp-config.php — 600
configuration.php — 600
Pliki — 644
Katalogi — 755

find ./ -type f -exec chmod xyz {}+;

find ./ -type f -iname 'wp-config.php' -exec chmod 600 {} \;
find ./ -type f -iname '.htaccess' -exec chmod 400 {} \;
find ./ -type f -iname 'configuration.php' -exec chmod 600 {} \;
find ./ -type f -exec chmod 644 {} \;
find ./ -type d -exec chmod 755 {} \;
</pre>";

$arr = array("dogguard");
$base = "../";
$dir = ls_without($base, $arr);

foreach ($dir as $el) {
    $perms = '0'.sprintf('%d', fileperms($base . "/" . $el) & 0777); 
    $color = ""; // default color
    if ($perms > 0755) {
        $color = "color: red;"; // red color
    } elseif ($perms < 0644) {
        $color = "color: blue;"; // blue color
    }
    if($color != ""){
        echo "<div style=\"" . $color . "\">" . $el . " " . decoct($perms) . "</div>";
    }else{

    }
}

?>