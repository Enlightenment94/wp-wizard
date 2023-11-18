<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("php/ls.php");
require_once("php/StringOp.php");
require_once("php/change.php");

$without = array('uploads', 'dogguard');

echo "Script start ...</br>\n";
createFirstContener($without);

$path = "./loggs";

$first = loadContener($path . "/" . "first");
$contenerPath = $path . "/" . "contener";
$dir = ls_one($contenerPath);

if(count($dir) == 1){
	echo "Contener create ...</br>";
	createContener($without);
	$oldName = $path . "/" . "log.txt";
	$time = date("Y-m-d H:i:sa");
	rename($oldName, $path . "/" . $time . ".log");
	echo "created.</br>";
}

echo "Start compare</br>\n";
$counter = 0;
$many = 20;
$dir = ls_one($contenerPath);
foreach($dir as $el){
	echo "part " . $el . "</br>\n"; 
	if($counter == $many){
		break;
	}
	$last = file_get_contents($path . "/" . "contener/" . $el);

	$result = compareFirstLast($first, $last);

	$fp = fopen($path . "/log.txt", "a");
	fwrite($fp, $result);
	fclose($fp);
	unlink($path . "/" . "contener/" . $el);

	$counter++;
}
echo "compare is end</br>\n";
echo "Script end.";
?>