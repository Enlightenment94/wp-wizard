<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('php/ls.php');

$dir = ls_one("loggs");
foreach ($dir as $el) {
	if(is_file("loggs" . "/" . $el)){
		echo "<a href='" . "loggs" . "/" . $el . "'>" . $el . "</a>" . "</br>";
	}else{
		
	}
}
?>