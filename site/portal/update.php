<?php
ini_set('display_errors', 'On');//remove in production
error_reporting(E_ALL | E_STRICT);//^^
session_start();
$ukey = $_SESSION['usera'];

$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));

/*Get Passed Vars*/
//ukey already set
$uType = $_GET['type'];
$uName = $_GET['name'];
$uValue = $_GET['val'];

if ($uType == 'new'){
$mash = password_hash("0000000000", PASSWORD_DEFAULT);
$hash = password_hash("A123456789", PASSWORD_DEFAULT);

$bsql = "SELECT tally FROM users WHERE ukey = '$ukey'";
$bstmt = sqlsrv_query($conn, $bsql);
$bdisp = sqlsrv_fetch_array($bstmt, SQLSRV_FETCH_ASSOC);
$tally = $bdisp['tally'];
$tally++;

$asql = "INSERT INTO devices (did,address,dkey,type,num,belong,status,data) VALUES ('$uName','$hash','$mash','arduino','$tally','$ukey','Not Connected','0')";
$astmt = sqlsrv_query($conn, $asql);

$csql = "UPDATE users SET tally = '$tally' where ukey = '$ukey'";
$cstmt = sqlsrv_query($conn, $csql);
echo $hash."|".$mash;
}

if ($uType == 'update_id') {
	$dsql = "UPDATE devices SET did = '$uName' WHERE belong = '$ukey' AND num = '$uValue'";
	$dthrow = sqlsrv_query($conn, $dsql);
}

if ($uType == 'delete') {
	$esql = "DELETE FROM devices WHERE belong = '$ukey' AND num = '$uValue'";
	$fsql = "SELECT tally FROM users WHERE belong = '$ukey'";
	sqlsrv_query($conn, $esql);
	$fstmt = sqlsrv_query($conn, $fsql);
	$fdisp = sqlsrv_fetch_array($fstmt, SQLSRV_FETCH_ASSOC);
	$tally = $fdisp['tally'];
	$tally--;
	$gsql = "UPDATE users SET tally = '$tally' WHERE ukey = '$ukey'";
	sqlsrv_query($conn, $gsql);
}

?>
