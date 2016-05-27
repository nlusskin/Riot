<?php
ini_set('display_errors', 'On');//Do not remove this, determines login state for view.html
error_reporting(E_ALL | E_STRICT);//by passing 'index usera not defined'
session_start();
$ukey = $_SESSION['usera'];
$name = $_GET['name'];

$file = fopen('http://ithings.blob.core.windows.net/devices/'.$ukey.'_'.$name, 'r');
while (!feof($file)) {
	echo fgets($file);
}
?>