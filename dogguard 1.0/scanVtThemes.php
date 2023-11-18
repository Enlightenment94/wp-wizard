<?php
require_once('php/zip.php');
require_once('php/ls.php');
require_once('php/vt.php');

$pluginsPath = "../wp-content/themes";
$outPutZip = "zipToScan/themes";

$dir = ls_one($pluginsPath);

foreach ($dir as $el) {
	$temp = $pluginsPath . "/" . $el;
	$out = $outPutZip . "/" . $el ;
	echo $el . "</br>";
	if (is_file($temp)) {
		//copy($temp, $out);	
		packFolderToZip($temp, $out . ".zip");
	} elseif (is_dir($temp)) {
		packFolderToZip($temp, $out . ".zip");
		//echo $out . ".zip";
		scanVt($out . ".zip");
	}
}

?>