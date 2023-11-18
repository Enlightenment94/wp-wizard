<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("php/ls.php");
require_once("php/StringOp.php");

$path = "..";
$change = "change";
$logsTest = "possible";
$dange = "dange";

if(!file_exists($dange)){
	mkdir($dange);
}

$time = date("Y-m-d H:i:s");

$without = array("loggs","dogguard", "uploads");
$lsWithout = ls_without($path, $without);

$foundBad = array();
$badFunctions = array("include(", "base64_decode(", "ini_", "md5(", "wp_remote_get", "eval(", "popen(", "passthru(", "system(", "exec(", "iframe", "script");

//print_r($badFunctions);

foreach ($lsWithout as $el) {
	foreach($badFunctions as $bad){
		$tmp = $path . "/" . $el;
		$fp = fopen($tmp, "r");
		$size = filesize($tmp);
		if($size > 0){
			$rd = fread($fp, $size);
			if(strpos($rd, $bad)){
				array_push($foundBad, array($el, $bad));	
			}
		}
		fclose($fp);
	}
}

$scanArr = array();
$scan2 = "<scan>\n";
$scan = "<scan>\n";
foreach($foundBad as $el){
	$scan .= "\t<func>\n"; 
	$scan .=  "\t\t<bad>" . $el[1] . "</bad>";
	$scan .=  "\t\t<path>" . $el[0] . "</path>\n";
	$scan .= "\t</func>\n";

	$scan2 .=  "\t\t<bad>" . $el[1] . "</bad>";
	$scan2 .=  "\t\t<path>" . $el[0] . "</path>\n";
	array_push($scanArr, array($el[1], $el[0])); 
}
$scan .= "</scan>\n\n";
$scan2 .= "</scan>\n\n";

//echo "<pre>" . $scan2 . "</pre>";

$scan3 = "<div>";

$scan3 .= "<div style='float: left; width: 15%;'>";
foreach($scanArr as $el){ 
	$scan3 .= $el[0] . "</br>";
}
$scan3 .= "</div>";

$scan3 .= "<div style='float: left; width: 85%;'>";
foreach($scanArr as $el){ 
	$scan3 .= $el[1] . "</br>";
}
$scan3 .= "</div>";

$scan3 .= "</div>";

echo $scan3;
//Find new

$fp = fopen($dange . "/" . $time  , "w");
fwrite($fp, $scan);
fclose($fp);

$strOp = new StringOp();
$dir = ls_one($dange);
$n = count($dir);

$first = "";
$last = "";

$scanNew = "<scanNew>\n";

if($n > 1){
	$fp = fopen($dange . "/" . $dir[0], "r" );
	$first = fread($fp, filesize($dange . "/" . $dir[0]));
	fclose($fp);

	$split2First = $strOp->split2($first, "<func>", "</func>");	
	$firstLength =  count($split2First);
	$lastLength = count($foundBad);

	$scanNew .= "\t<new>" . $firstLength . " ?= " . $lastLength . "</new>\n";

	$flag = 0;
	foreach($foundBad as $el){
		$flag = 0;
		foreach ($split2First as $fi) {
			$tmp = $strOp->cut($fi, "<path>","</path>");
			if($tmp  == $el[0]){
				$flag = 1;
				break;
			}
		}
		if($flag == 0){
			$scanNew .= "\t<bad>" . $el[1] . "</bad>\t";
			$scanNew .= "<path>" . $el[0] . "</path>\n";
		}
	}
}

$scanNew .= "</scanNew>\n\n";

echo "<pre>" . $scanNew . "</pre>";
?>
