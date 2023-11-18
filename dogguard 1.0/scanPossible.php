<?php
/*Wordpress secuirty
Possible test
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("php/ls.php");
require_once("php/StringOp.php");


function wrTest($path){
	if(file_exists($path)){
		if (!is_writable($path)) {
    		return 0;
		}else{
			return 1;
		}
	}else{
		return -1;
	}
}

function checkPermision($path){
	return substr(sprintf('%o', fileperms($path)), -4);
}

function checkLs($path){
	return ls_one($path);
}

function checkExec(){
	$output = null;
	$retval = null;
	exec('echo exec is True', $output, $retval);
	return $retval;		
}

function checkShellExec(){
	return shell_exec("echo shell_exec is True");
}

function checkSetChmod($path){
	$a = checkPermision($path);
	chmod($path, 0777);
	$b = checkPermision($path);
	echo $a . " != " . $b; //lol nie widzi zmiany
	if($a != $b){
		chmod($path, 0644);
		return $a . " != " . $b;
	}
	chmod($path, 0644);
	return "false";
}

$change = "change";
$logsTest = "possible";

if(!file_exists($change)){
	mkdir($change);
}

if(!file_exists($logsTest)){
	mkdir($logsTest);
}

$testFile = "../wp-config.php";
$wrT = wrTest($testFile);
$permT = checkPermision($testFile);
$lsT = checkLs(".");
$execT = checkExec();
$shellExecT = checkShellExec();
$setChmodT = checkSetChmod($testFile); 

$time = date("Y-m-d H:i:sa");

$test = "<test>\n";
$test .= "\t<date>" . $time . "</date>\n";
$test .= "\tfwrite : <writeTest>" . $wrT . "</writeTest>| -1 file not found, 0 false, 1 write true\n";
$test .= "\tfileperms: <permisionTest>" . $permT . "</permisionTest>| Possible check prermision ???\n";
$test .= "\tscandir: <lsTest>" . count($lsT) . "</lsTest>| 0 < true\n";
$test .= "\texec: <execTest>" . $execT . "</execTest>| 0 is possible \n";
$test .= "\tshell_exec: <shellExecTest>" . $shellExecT . "</shellExecTest>\n";
$test .= "\tchmod: <checkSetChmodTest>" . $setChmodT . "</checkSetChmodTest>\n";
//$test .= "\teval: <checkSetChmodTest>" . $setChmodT . "</checkSetChmodTest>\n";
//$test .= "\tsystem: <checkSetChmodTest>" . $setChmodT . "</checkSetChmodTest>\n";

echo "<pre>" . $test . "</pre>";
?>