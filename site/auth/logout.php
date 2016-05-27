<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
session_start();
$ukey = $_SESSION['usera'];

$newkey =  md5($ukey);

$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));

$asql = "UPDATE users SET ukey = '$newkey' WHERE ukey = '$ukey'";

sqlsrv_query($conn, $asql);

$bsql = "UPDATE devices SET belong = '$newkey' WHERE belong = '$ukey'";
sqlsrv_query($conn, $bsql);

session_unset();
session_destroy();
setcookie("PHPSESSID", "", time()-3600);

$url_arg = '?logout=true';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Authentication</title>
    </head>
    <body>
        <p>Logging out...</p>
        <?php 
        echo 
        "<script type='text/javascript'>
        window.location = '/auth".$url_arg."';
        </script>"
		?>
    </body>
</html>
