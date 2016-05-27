<?php
/*Authentication Class*/
/*PHP Vars Doc: https://msdn.microsoft.com/en-us/library/cc296207(v=sql.105).aspx*/
ini_set('display_errors', 'On');//remove in production
error_reporting(E_ALL | E_STRICT);//^^
session_start();
$url = "../auth";
if ($_SESSION['usera']){
    ;
}
else{
	$url_arg = '?login=failed';
    echo "<script type='text/javascript'>
        window.location = '$url';
        </script>";
}

/*Username Class*/

$ukey = $_SESSION['usera'];
/*echo $ukey.'</br>';*/
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));

$asql = "SELECT fname FROM users WHERE ukey = '$ukey'";

$astmt = sqlsrv_query($conn, $asql);
$adisp = sqlsrv_fetch_array($astmt, SQLSRV_FETCH_ASSOC);
$un = $adisp['fname'];


/*Device Class*/


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $un; ?>'s Dashboard</title>
        <link type="text/css" href="style.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <link rel="icon" type="image/png" href="res/home_ico.png">
  
    </head>
    <body>
        <div id="scroll">

		<ul class="navbar">
		<li class="nav" id="titlehead"style="border: none;">	
			<a>Riot</a>
			<!--<img src="geo.png" width="10%" height="10%" alt="geo_logo">-->
		</li>
		<li class="nav">
			<a href="#profile"><span>Welcome, <?php echo $un; ?></span></a>
		</li>
		<li class="nav">
			<a href="#dos"><span>Devices</span></a>
		</li>
		<li class="nav">
			<a href="#tres"><span>Settings</span></a>
		</li>
		<li class="nav">
			<a href="#quatro"><span>Help</span></a>
		</li>
		<li class="nav">
			<a href="#cinco"><span>+ Device</span></a>	
		</li>
		<li><p id="width"></p></li>
	</ul>
	



</div>
    </body>
</html>
