<?php
require_once('php/zip.php');
require_once('php/ls.php');
require_once('php/vt.php');
require_once('php/size.php');

$outPutZip = "zipToScan/plugins";

$dir = ls_one($outPutZip);

echo "<a href='./scanVtPluginsNoZip.php?a=t'>scanAll</a>" . '</br>';
echo "<a href='./scanVtPluginsNoZip.php?r=t'>reportAll</a>" . '</br>';

foreach ($dir as $el) {
	$out = $outPutZip . "/" . $el ;
	//packFolderToZip($temp, $out . ".zip");
	echo $out .  " <a href='./scanVtPluginsNoZip.php?psvt=" . $out .  "'>scan</a>" . "</br>";
}
echo "</br>";

if(isset($_GET['a']) && $_GET['a'] == 't'){
	foreach ($dir as $el) {
		$out = $outPutZip . "/" . $el ;
		echo $el . "</br>";
		scanVt($out);
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
			packFolderToZip($pathToScan, "zipToScan/plugins/" . $el );
			scanVt("zipToScan/plugins/" . $el );
		}else{
			echo "To big to scan " . "</br>";	
		}
	}elseif (is_dir($pathToScan)) {
		$size = check_size($pathToScan, 33554432);
		if($size != true){
			echo " Ia am here ";
			packFolderToZip($pathToScan, "zipToScan/plugins/" . $el );
			scanVt("zipToScan/plugins/" . $el );
		}else{
			echo "To big to scan " . "</br>";
		}
	}
}

if(isset($_GET['r'])){
	foreach ($dir as $el) {
		$out = $outPutZip . "/" . $el ;
		echo $el . "</br>";
		report($out);
		
	}
}
?>