<?php
require_once('php/zip.php');
require_once('php/ls.php');
require_once('php/vt.php');
require_once('php/size.php');

$arrWithoutMain = ['wp-admin', 'wp-includes' , 'index.php', 'wp-activate.php', 'wp-blog-header.php', 'wp-comments-post.php', 'wp-config-sample.php', 'wp-cron.php', 'wp-links-opml.php', 'wp-load.php', 'wp-login.php', 'wp-mail.php', 'wp-settings.php', 'wp-signup.php', 'wp-trackback.php', 'xmlrpc.php', 'wp-content', 'dogguard'];

$arrWithoutWpContent = ['plugins', 'themes', 'uploads'];

$dirMain = ls_one("../");
$dirWpContent = ls_one("../wp-content");

$dirWithoutMain = array();
$flag = 0;
foreach($dirMain as $el1){
	foreach($arrWithoutMain as $el2){
		if($el1 == $el2){
			$flag = 1;
			break;
		}
	}
	if($flag == 1){
		$flag = 0;
		continue;
	}else{
		array_push($dirWithoutMain, $el1);
	}
}

$dirWithoutWpContent = array();
$flag = 0;
foreach($dirWpContent as $el1){
	foreach($arrWithoutWpContent as $el2){
		if($el1 == $el2){
			$flag = 1;
			break;
		}
	}
	if($flag == 1){
		$flag = 0;
		continue;
	}else{
		array_push($dirWithoutWpContent, $el1);
	}
}

echo "unzip dogguard/wpElements/wp-admin.zip -d ./" . "</br>";
echo "unzip dogguard/wpElements/wp-includes.zip -d ./" . "</br>";
echo "unzip dogguard/wpElements/main.zip -d ./" . "</br>";
echo "unzip dogguard/wpElements/languages.zip -d wp-content/" . "</br>";
echo "</br>";

echo "rm -R " . "wp-admin" . "</br>";
echo "rm -R " . "wp-includes" . "</br>";
echo "rm !wp-config.php *.php" . "</br>";
echo 'find . -maxdepth 1 -type f -name "*.php" ! -name "wp-config.php" -delete' . "</br>";

echo "</br>";

foreach($dirWithoutMain as $el){
	if(is_file("../" . $el)){
		echo "rm " . $el . " <a href='./scanVtNotIdentifed.php?psvt=../" .  $el . "'>scan</a></br>";
	}elseif(is_dir("../" . $el)){
		echo "rm -R " . $el . " <a href='./scanVtNotIdentifed.php?psvt=../" .  $el . "'>scan</a></br>";
	}
}

echo "</br>";

foreach($dirWithoutWpContent as $el){
	if(is_file("../wp-content/" . $el)){
		echo "rm ../wp-content/" . $el . " <a href='./scanVtNotIdentifed.php?psvt=" . "../wp-content/" . $el . "'>scan</a></br>";
	}elseif(is_dir("../wp-content/" . $el)){
		echo "rm -R ../wp-content/" . $el . " <a href='./scanVtNotIdentifed.php?psvt=" . "../wp-content/" . $el . "'>scan</a></br>";
	}
}

if(isset($_GET['psvt'])){
	$pathToScan = $_GET['psvt'];
	$el = basename($pathToScan);
	echo $pathToScan . "\n</br>";
	echo $el . "\n</br>";
	if(is_file($pathToScan)){
		$size = check_size($pathToScan, 104857600);
		if($size != true){
			packFolderToZip($pathToScan, "zipToScan/notIdentifed/" . $el . ".zip");
			scanVt("zipToScan/notIdentifed/" . $el . ".zip");
		}else{
			echo "To big to scan " . "</br>";	
		}
	}elseif (is_dir($pathToScan)) {
		$size = check_size($pathToScan, 104857600);
		if($size != true){
			packFolderToZip($pathToScan, "zipToScan/notIdentifed/" . $el . ".zip");
			scanVt("zipToScan/notIdentifed/" . $el . ".zip");
		}else{
			echo "To big to scan " . "</br>";
		}
	}
}
?>