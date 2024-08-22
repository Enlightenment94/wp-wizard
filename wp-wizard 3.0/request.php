<?php

require_once('php/zip.php');
require_once('php/vt.php');

if(isset($_GET['p'])){
	$path = $_GET['p'];
	if($path == "../wp-content/uploads"){
		$files = glob($path . '/*.{bin,php,js,ott,oti}', GLOB_BRACE);
		$uploads  = array();
		foreach ($files as $file) {
			array_push($uploads, $file . PHP_EOL);
		}
	}
}

if(isset($_GET['pb'])){
	$path = $_GET['pb'];
	if($path != '../' && $path != '..'){
		$path = dirname($path);
	}
}

if(isset($_GET['c'])){
	$core = "t";
}

if(isset($_GET['z'])){
	$z = $_GET['z'];
	$path = dirname($z);
	$front = basename($z);
	packFolderToZip($z, "./lab/" . $front . ".zip");
}

if(isset($_GET['d'])){
	$d = $_GET['d'];
	$front = basename($d);
	unlink("./lab/" . $front);
}

if(isset($_GET['s'])){
	$s = $_GET['s'];
	$responseArr = scanVt("./lab/" . $s);
	$response = $responseArr[0] . "</br>" . $responseArr[1];
}

if(isset($_GET['r'])){
	$r = $_GET['r'];
	$responseArr = report("./lab/" . $r);
	$response = $responseArr[0] . "</br>" . $responseArr[1];
}

if(isset($_GET['ra'])){
	$ra = $_GET['ra'];
	$response = "";
	foreach($ra as $el){
		$responseArr = report("./lab/" . $el);
		$response .= $responseArr[0] . "</br>" . $responseArr[1] . "</br>";
	}
}

if(isset($_GET['sa'])){
	$sa = $_GET['sa'];
	$response = "";
	foreach($sa as $el){
		$responseArr = scanVt("./lab/" . $el);
		$response .= $responseArr[0] . "</br>" . $responseArr[1] . "</br>";
	}
}

if(isset($_GET['cl'])){
	$cl = $_GET['cl'];
	file_put_contents("log.txt", "");
}

if(isset($_GET['l'])){
	$l = $_GET['l'];
	$responseLog = file_get_contents("log.txt");
}
//$result = packFolderToZip($outputZip, $path);
?>