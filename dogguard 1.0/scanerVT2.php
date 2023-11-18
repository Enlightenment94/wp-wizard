<form action='scanerVT2.php'>
    <input type='text' name='pvt' value='' />
    <input type='submit' value='scanVt' />
</form>

<?php
require_once('php/vt.php');

if(isset($_GET['pvt'])){
    $pvt = $_GET['pvt'];
    scanVtLarg();
}
?>