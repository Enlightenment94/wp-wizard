<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function ls_one($path){
    $files = scandir($path);
    $length = count($files);
	        
    $ret = array($length);
    $counter = 0;
    for ($x = 0; $x < $length; $x++) {
        if ($files[$x] != "." && $files[$x] != ".." && $files[$x] != "") {
            $ret[$counter] = $files[$x];
            $counter++;
        }
    }

    return $ret;
}

function ls($dir) {
	$result = [];
	foreach(scandir($dir) as $filename) {
		if ($filename[0] === '.') continue;

		$filePath = $dir . '/' . $filename;

		if (is_dir($filePath)) {

			foreach (ls($filePath) as $childFilename) {
				$result[] = $filename . '/' . $childFilename;
 			}
		} else {
			$result[] = $filename;
		}
	}
	return $result;
}

function ls_size_xml($dir){
	$res = ls($dir);
	$ret = "<dir>\n";
	foreach($res as $el){
		$ret .= "\t<file>\n";
		$ret .= "\t\t<size>" . filesize($dir . "/" . $el) . "</size>\n";
		$ret .= "\t\t<path>" . $dir . "/" . $el . "</path>\n";
		$ret .= "\t</file>\n";
	}
	$ret .= "</dir>\n\n";
	return $ret;
}

function ls_without($dir, $arr) {
	$result = [];
	foreach(scandir($dir) as $filename) {
		if ($filename[0] === '.') continue;

		$flag = 0;
		foreach($arr as $el){
			if(strcmp($filename, $el) == 0){
				$flag = 1;
				break;
			}
			//echo strcmp($filename, $el) . " " . $filename . " el " . $el . "</br>";
		}
		if($flag == 1){
			continue;
		}

		$filePath = $dir . '/' . $filename;

		if (is_dir($filePath)) {

			foreach (ls_without($filePath, $arr) as $childFilename) {
				$result[] = $filename . '/' . $childFilename;
 			}
		} else {
			$result[] = $filename;
		}
	}
	return $result;
}

function ls_without_size_xml($dir, $arr){
	$res = ls_without($dir, $arr);
	$ret = "<dir>\n";
	foreach($res as $el){
		$ret .= "\t<file>\n";
		$ret .= "\t\t<size>" . filesize($dir . "/" . $el) . "</size>\n";
		$ret .= "\t\t<path>" . $dir . "/" . $el . "</path>\n";
		$ret .= "\t\t<editTime>" . date("F d Y H:i:s.", filectime($dir . "/" . $el)) . "</editTime>\n";
		$ret .= "\t</file>\n";
	}
	$ret .= "</dir>\n\n";
	return $ret;
}

function ls_without_size_xml_arr($dir, $arr){
	$res = ls_without($dir, $arr);
	$arr = array();
	foreach($res as $el){
		$ret = "";
		$ret .= "\t<file>\n";
		$ret .= "\t\t<size>" . filesize($dir . "/" . $el) . "</size>\n";
		$ret .= "\t\t<path>" . $dir . "/" . $el . "</path>\n";
		$ret .= "\t\t<editTime>" . date("F d Y H:i:s.", filectime($dir . "/" . $el)) . "</editTime>\n";
		$ret .= "\t</file>\n";
		array_push($arr, $ret);
		//echo $ret . "\n";
	}
	return $arr;
}

function removeDirectory($dir) {
    if (is_dir($dir)){
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") {
                    removeDirectory($dir."/".$object);
                } else {
                    unlink($dir."/".$object);
                }
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

function count_files($dir){
    $num_files = 0;
    $num_dirs = 0;

    // Pobranie listy plików i katalogów
    $files = glob($dir . '/*');

    // Iteracja po plikach i katalogach i zliczanie ilości plików i katalogów
    foreach ($files as $file) {
        if (is_dir($file)) {
            // Jeśli element jest katalogiem, zliczamy go oraz wywołujemy rekurencyjnie funkcję dla podkatalogu
            $num_dirs++;
            list($sub_dirs, $sub_files) = count_files($file);
            $num_dirs += $sub_dirs;
            $num_files += $sub_files;
        } else {
            // Jeśli element jest plikiem, zliczamy go
            $num_files++;
        }
    }

    return array($num_dirs, $num_files);
}


function partial_ls_without($path, $without){
	$lsXmlArr = ls_without_size_xml_arr("..", $without);
	//echo "LOL";

	//Partial save
	$i = 0;
	$j = 0;
	$endArr = count($lsXmlArr);
	$partial = 1000;
	$parts = ceil(count($lsXmlArr) / $partial);
	$k = 0; 

	for($j = 0 ; $j < $parts; $j++){
		$fp = fopen($path . $j, "w");
		for($i = 0; $i < $partial; $i++){
			if($k >= $endArr){
				break;
			}
			//echo $k .  " >> " . "</br>\n";
			fwrite($fp, $lsXmlArr[$k]);
			$k++;
		}
		fclose($fp);
	}
}

/*
$without = array("nobody");
$xml = ls_without_size_xml(".", $without);
echo $xml;

echo "</br></br>";

$without = array("change");
$xml = ls_without_size_xml(".", $without);
echo $xml;
*/

?>
