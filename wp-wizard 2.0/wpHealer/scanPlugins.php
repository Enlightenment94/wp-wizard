<?php
require_once('../php/zip.php');
require_once('../php/ls.php');
require_once('../php/vt.php');
require_once('../php/size.php');

function scanPlugins(){
	$pluginsPath = "../wp-content/plugins";
	$outPutZip = "zipToScan/plugins";

	$dir = ls_one($pluginsPath);

	echo "<a href='./scanVtPlugins.php?z=t'>zip</a>" . '</br>';
	echo "<a href='./scanVtPlugins.php?a=t'>scanAll</a>" . '</br>';

	if(isset($_GET['z']) && $_GET['z'] == 't'){
		foreach ($dir as $el) {
			$temp = $pluginsPath . "/" . $el;
			$out = $outPutZip . "/" . $el ;
			echo $el . "</br>";
			if (is_file($temp)) {
				packFolderToZip($temp, $out . ".zip");
				echo $out . ".zip" . " <a href='./scanVtPlugins.php?psvt=" . $out . ".zip" . "'>scan</a></br>";
			} elseif (is_dir($temp)) {
				packFolderToZip($temp, $out . ".zip");
				echo $out . ".zip" . " <a href='./scanVtPlugins.php?psvt=" . $out . ".zip" . "'>scan</a></br>";
			}
		}
	}

	if(isset($_GET['a']) && $_GET['a'] == 't'){
		foreach ($dir as $el) {
			$temp = $pluginsPath . "/" . $el;
			$out = $outPutZip . "/" . $el ;
			echo $el . "</br>";
			if (is_file($temp)) {
				$size = check_size($pathToScan, 33554432);
				if($size != true){
					scanVt($out . ".zip");
				}else{
					echo "To big to scan " . "</br>";					
				}
			} elseif (is_dir($temp)) {
				$size = check_size($pathToScan, 33554432);
				if($size != true){
					scanVt($out . ".zip");
				}else{
					echo "To big to scan " . "</br>";					
				}
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
}
?>