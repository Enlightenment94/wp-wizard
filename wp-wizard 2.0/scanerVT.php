<form action='scanerVT.php'>
    <input type='text' name='pvt' value='' />
    <input type='submit' value='scanVt' />
</form>

<?php
require_once('php/vt.php');
if(isset($_GET['pvt'])){
    $p = $_GET['pvt'];
    scanVt($p);
}
?>