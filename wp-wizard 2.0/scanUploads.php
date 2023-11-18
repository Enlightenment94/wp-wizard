<?php

$output = shell_exec("find ../ -type d -name 'uploads'");
echo $output;
echo "</br>";

//$folderPath = $output;
$folderPath = "../wp-content/uploads";

$cmd = "find " . $folderPath . "/* -type f \( -name \"*.bin\" -o -name \".*\" -o -name \"*.php\" -o -name \"*.js\" -o -name \"*.ott\" -o -name \"*.oti\" \) - exec rm {} \; "; 
echo $cmd . "</br></br>";

$cmd = "find " . $folderPath . "/* -type f \( -name \"*.bin\" -o -name \".*\" -o -name \"*.php\" -o -name \"*.js\" -o -name \"*.ott\" -o -name \"*.oti\" \)";
echo $cmd . "</br>";
$output = shell_exec($cmd);
//echo $output;

$output_lines = explode("\n", $output);
foreach ($output_lines as $line) {
    echo $line . "<br>";
}
?>