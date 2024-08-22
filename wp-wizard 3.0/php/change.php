<?php

function compareFirstLast($first, $last){
		$strOp = new StringOp();

		$split2First = $strOp->split2($first, "<file>", "</file>");
		$split2Last = $strOp->split2($last, "<file>", "</file>");

		$result = "";

		$cutArrFirst = array();
		$tmp = "";

		foreach($split2First as $el){
			$tmp = $strOp->cut($el, "<path>", "</path>");
			array_push($cutArrFirst, $tmp);
		}

		$cutArrLast = array();
		foreach($split2Last as $el){
			$tmp = $strOp->cut($el, "<path>", "</path>");
			array_push($cutArrLast, $tmp);
		}

		$sets = array();
		$flag = 0;

		$setsSize = array();
		//new Files, paths
		foreach($split2Last as $lt){
			$flag = 0;
			$ltPath = $strOp->cut($lt, "<path>", "</path>");

			foreach($split2First as $ft){
				$ftPath = $strOp->cut($ft, "<path>", "</path>");
				if($ftPath == $ltPath){
					$flag = 1;
					$ltSize = $strOp->cut($lt, "<size>", "</size>");
					$ftSize = $strOp->cut($ft, "<size>", "</size>");
					if($ltSize != $ftSize){
						array_push($setsSize, array($ftSize, $ltSize, $ftPath)); 
					}
					break;
				}
			}

			if($flag == 0){
				array_push($sets, $ltPath);
			}
		}


		$changes = "";

		if(count($sets) != 0){
			$changes = "<newFile>\n";
			foreach ($sets as $el) {
				$changes .= "\t<new>" . $el . "</new>\n";
			}
			$changes .= "</newFile>\n\n";
		}

		if(count($setsSize) != 0){
			$changes .= "<setSize>\n";
			foreach ($setsSize as $el) {
				$changes .= "\t<firstSize>" . $el[0] . "</firstSize>\n";
				$changes .= "\t<lastSize>" . $el[1] . "</lastSize>\n";
				$changes .= "\t<path>" . $el[2] . "</path>\n";
			}
			$changes .= "</setSize>\n\n";
		}

		return $result . $changes;
}


function createFirstContener($without){
	$change = "loggs";
	if(!file_exists($change)){
		mkdir($change);
	}

	$contenerPath = $change . "/" . "first";
	if(!file_exists($contenerPath)){
		mkdir($contenerPath);
		chmod($contenerPath, 0777);
	}else{
		return;
	}

	partial_ls_without($contenerPath . "/" , $without);
}


function createContener($without){
	$change = "loggs";
	if(!file_exists($change)){
		mkdir($change);
	}

	$contenerPath = $change . "/" . "contener";
	if(!file_exists($contenerPath)){
		mkdir($contenerPath);
	}else{
		removeDirectory($contenerPath);
		mkdir($contenerPath);
		chmod($contenerPath, 0777);
	}

	partial_ls_without($contenerPath . "/" , $without);
}

function loadContener($path){
	$dir = ls_one($path);
	$content = "";
	$tmp = "";
	foreach($dir as $el){
		echo $path . "/" . $el . "</br>\n";
		$tmp = file_get_contents($path . "/" . $el);
		$content .= $tmp;
	}
	return $content;
}

?>