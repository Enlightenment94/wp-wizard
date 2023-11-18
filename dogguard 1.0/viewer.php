<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$base = "../";

if(isset($_GET['s'])){
    $s = $_GET['s'];
    $fp = fopen($s, "r");
    $rd = fread($fp, filesize($s));
    fclose($fp);
    echo $rd;
    die();
}
?>

<style>
button{
    background: none;
    color: inherit;
	border: none;
	padding: 3px;
	font: inherit;
	cursor: pointer;
	outline: inherit;
    text-align: left;
    font-size: 11px;
}

button:hover{
    border-bottom: 1px solid;
}

textarea{
    background: transparent;
    color: rgba(205, 205, 205, 0.9);
}

body{
    color: rgba(205, 205, 205, 0.9);
    background-color: #212121;
    font-family: "Lucida Console", "Courier New", monospace;
}

button:visited {
    color: aliceblue;
    background-color: red;
}

input[type=submit]{
    background-color: transparent;
    border: none; 
    cursor: pointer;
    padding: 5px;
    color: rgba(205, 205, 205, 0.9);
}

input[type=submit]:hover {
    background-color: grey; 
}

#paths{
    margin: 5px;
    width: 35%; 
    float: left; 
    position: fixed;
    max-height: 100%;
    overflow-y: scroll;
    padding-right: 5px; 
}

#paths-area{
    width: 100%;
    height: 75px;
}

#viewer{
    height: 100%;
}

#viewer-area{
    padding-left: 10px;
}

::-webkit-scrollbar {
  width: 12px;
}

/* Styl suwaka przewijania */
::-webkit-scrollbar-thumb {
  background-color: rgba(205, 205, 205, 0.9); /* kolor suwaka */
  border-radius: 10px; /* zaokrąglenie rogów suwaka */
}
</style>


<div id='paths'>
    <p>Past path to view.</p>
    <textarea id='paths-area' form='p' name='pp'></textarea>
    <p>
        <form id='p' aciton='./' method='GET'>
            <input type='submit' value='view'/>
        </form>
    </p>
<?php
if(isset($_GET['pp'])){
    $p = $_GET['pp'];

    //echo $p;
    $exp = explode("\n", $p);
    //echo count($exp);

    echo "<p>Output: " . "</p>";

    foreach($exp as $a){
        //echo $a. "</br>";
        //echo '<button onclick=\"show("' . $a . '")\">' . $a . "</button></br>";
        //echo "<button onclick='show(\"" . $a . "\")'>" . $a . "</button></br>";
        $tmp = $base . trim(preg_replace('/\s+/', ' ', $a));
        echo '<button onclick="show(\'' . $tmp . '\')">' . $tmp. "</button></br>";
    }
}
?>
</div>

<div id='viewer' style='width: 60%; float: right; position: fixed; left: 40%;'>
    <textarea id='viewer-area' style='width: 98%; height: 100%;'></textarea>
</div>

<script>
function show(s) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("viewer-area").innerHTML = this.response;
    }
    xhttp.open("GET", "?s=" + s, true);
    xhttp.send();
}
</script>