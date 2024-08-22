<head>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<div id='header'></div>
<div id='menu'>
	<img src='Healer.gif' width="150" height="75">
	<ul>
		<li><a href='index.php?c=t'>core</a></li>
		<li><a href='index.php?p=..'>main</a></li>
		<li><a href='index.php?p=../wp-content'>wp-content</a></li>
		<li><a href='index.php?p=../wp-content/plugins'>plugins</a></li>
		<li><a href='index.php?p=../wp-content/themes'>themes</a></li>
		<li><a href='index.php?p=../wp-content/uploads'>uploads</a></li>
		<li><a href=''>documentation</a></li>
	</ul>
</div>

<?php
	require_once('php/ls.php');
	require_once('php/size.php');

	$base = "../";
	$path = $base;
	$outputZip = "lab";
	$uploads = "";
	$core = "";
	$result = "";
	$response = "";
	$responseLog = "";

	require_once("request.php");
?>
<div id='content'>
	<div id='path'><?php echo $path;?> <a href='index.php?pb=<?php echo $path;?>'>back</a></div>
	<div id='directory'>
		<ul>
		<?php 
		$arr = ls_one($path);
		$temp = "";
		$tempSize = "";
		foreach($arr as $el){
			$temp = $path . "/" . $el;
			$tempSize = check_size($temp, 33554432);
			if(is_dir($temp)){
				if($tempSize == 1){
					echo "<li><a class='dir' href='index.php?p=" . $temp . "'>" .  $el . "</a></li>"; 
				}else{
					echo "<li><a class='dir' href='index.php?z=" . $temp . "'>zip</a> <a class='dir' href='index.php?p=" . $temp . "'>" .  $el . "</a></li>"; 
				}
			}else{
				if($tempSize == 1){
					echo "<li class='file'>" .  $el . " " . check_size($temp, 33554432) . "</li>"; 
				}else{

					echo "<li class='file'><a href='index.php?z=" . $temp . "'>zip</a> " .  $el . " " . check_size($temp, 33554432) . "</li>"; 
				}
			}
		}

		if($uploads != ""){
			echo "<h1>Uploads scan:</h1>";
			foreach($uploads as $el){
				echo $el;
			}
		}

		if($core == "t"){
			echo "</br>";
			echo "<a href=''>Reinstall core</a>";
		}
		?>
		</ul>
	</div>
	<div id='lab'>
		<?php
			$arr = ls_one("lab");
			echo '<ul>';
			$rall = "";
			$sall = "";
			foreach($arr as $el){
				echo "<li><a href='index.php?d=" . $el .  "' style='color: red;'>del</a> " . $el . " <a href='index.php?s=" . $el . "'>scan</a> <a href='index.php?r=" . $el . "'>report</a></li>";
				$rall .= "ra[]=" . $el . "&"; 
				$sall .= "sa[]=" . $el . "&";
			}
			$rall = substr($rall, 0, -1);
			$sall = substr($sall, 0, -1);
			echo '</ul>';
		?>
		<p style="text-align: left; padding: 5px;">
			<a href='index.php?<?php echo $sall; ?>'>scanAll</a>
			<a href='index.php?<?php echo $rall; ?>'>reportAll</a>
		</p>

		<div id='response'>
		<?php 
			echo "<pre id='result'>";
			echo $response;
			echo $responseLog;
			echo "</pre>";
			if($response != ""){
				file_put_contents("log.txt", $response . PHP_EOL, FILE_APPEND);
			}
		?>
		</div>
		
			<div style='float: left; text-align: left; padding: 5px;'>
				<a href='index.php?l=t'>log</a>
			</div>
			<div style='float: right; text-align: right; padding: 5px;'>
				<a href='index.php?cl=t'>clean</a>
			<div>
		
	</div>
</div>

<?php
	if($result != ""){
		echo $result;
	}
?>
<img id='logo' src='logo.jpeg' width='100' height='100'/>
<script></script>