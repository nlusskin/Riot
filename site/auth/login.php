<?php
/*ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);*/
$uid = $_GET['uid'];
$pwd = $_GET['pwd'];
$url = "../dashboard";
/*$url_arg = "?login=true&user=set";*/
$f_url = '/auth';
/*$f_url_arg = '?login=incorrect';*/
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
session_start();
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));

$tsql = "SELECT ukey FROM users WHERE uid = '$uid' AND pwd = '$pwd'";
/*$verify = "SELECT uid FROM users WHERE uid = '$uid' AND pwd = '$pwd'";*/

$stmt = sqlsrv_query($conn, $tsql);
$disp = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$disp['ukey']) {
        echo '<script type="text/javascript">
          window.location = "'.$f_url.'"
          </script>';
		  $_SESSION['error'] = 'untrue';
}
else {
		$_SESSION['usera'] = $disp['ukey'];
		echo '<script type="text/javascript">
			  window.location = "'.$url.'"
			  </script>';
    }


/*
        HttpResponse::Redirect("http://ithings.azurewebsites.net/dashboard");
        $tsql1 = "SELECT uid FROM users WHERE uid = ".$uid;
        $ret1 = sql_query($conn, $tsql1);
        
if ($ret1 === false) {
        echo '<p>Username is incorrect.<p>';
}
else {
        $tsql2 = "SELECT pwd FROM users WHERE pwd = ".$pwd;
        $ret2 = sql_query($conn, $tsql2);
    }
if ($ret2 === false) {
        echo "Password is incorrect";
}

else{
    $tsql3 = "SELECT key FROM users WHERE uid = ".$uid;
        $key = sql_query($conn, $tsql3);
        setcookie('user', $key);
}

if ($_COOKIE['user'] === true) {
    echo 'Login Successful.';
}

elseif ($_COOKIE['user'] === false) {
    echo "Not logged in.";
}
else {
    echo "Error.";
}
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Logging in...</title>

 <link rel="icon" type="image/png" href="../res/logo.png">
    </head>
    <body>
 
    </body>
</html>