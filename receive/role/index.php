<?php
$id = $_GET['id'];

$dkey = $_GET['pin'];

$bit = $_GET['bit'];


$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));


$asql = "SELECT data FROM devices WHERE address='$id' AND dkey='$dkey'";
$astmt = sqlsrv_query($conn, $asql);
$adisp = sqlsrv_fetch_array($astmt, SQLSRV_FETCH_ASSOC);
$current = $adisp['data'];
$append = $current.','.$bit;

$bsql = "UPDATE devices SET status='Connected, Sending Data', data='$append' WHERE address='$id' AND dkey='$dkey'";
$bstmt = sqlsrv_query($conn, $bsql);

if($bstmt) {;}
else {;}
?>