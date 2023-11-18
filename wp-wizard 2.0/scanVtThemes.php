<?php
require_once('php/zip.php');
require_once('php/ls.php');
require_once('php/vt.php');
require_once('php/size.php');

$themesPath = "../wp-content/themes";
$outPutZip = "zipToScan/themes";

$dir = ls_one($themesPath);

echo "<a href='./scanVtThemes.php?a=t'>scanAll</a>" . '</br>';
echo "<a href='./scanVtThemes.php?r=t'>reportAll</a>" . '</br>';

foreach ($dir as $el) {
	$temp = $themesPath . "/" . $el;
	$out = $outPutZip . "/" . $el ;
	echo $el . "</br>";
	if (is_file($temp)) {
		packFolderToZip($temp, $out . ".zip");
		echo $out . ".zip" . " <a href='./scanVtThemes.php?psvt=" . $out . ".zip" . "'>scan</a></br>";
	} elseif (is_dir($temp)) {
		packFolderToZip($temp, $out . ".zip");
		echo $out . ".zip" . " <a href='./scanVtThemes.php?psvt=" . $out . ".zip" . "'>scan</a></br>";
	}
}
echo "</br>";

if(isset($_GET['a']) && $_GET['a'] == 't'){
	foreach ($dir as $el) {
		$temp = $themesPath . "/" . $el;
		$out = $outPutZip . "/" . $el ;
		echo $el . "</br>";
		if (is_file($temp)) {
			scanVt($out . ".zip");
		} elseif (is_dir($temp)) {
			scanVt($out . ".zip");
		}
	}
}

if(isset($_GET['psvt'])){
	$pathToScan = $_GET['psvt'];
	$el = basename($pathToScan);
	echo $pathToScan . "\n</br>";
	echo $el . "\n</br>";
	if(is_file($pathToScan)){
		$size = check_size($pathToScan, 33554432);
		if($size != true){
			packFolderToZip($pathToScan, "zipToScan/themes/" . $el );
			scanVt("zipToScan/themes/" . $el );
		}else{
			echo "To big to scan " . "</br>";	
		}
	}elseif (is_dir($pathToScan)) {
		$size = check_size($pathToScan, 33554432);
		if($size != true){
			echo " Ia am here ";
			packFolderToZip($pathToScan, "zipToScan/themes/" . $el );
			scanVt("zipToScan/themes/" . $el );
		}else{
			echo "To big to scan " . "</br>";
		}
	}
}

if(isset($_GET['r'])){
	foreach ($dir as $el) {
		$temp = $themesPath . "/" . $el;
		$out = $outPutZip . "/" . $el ;
		echo $el . "</br>";
		if (is_file($temp)) {
			report($out . ".zip");
		} elseif (is_dir($temp)) {
			report($out . ".zip");
		}
	}
}
?>