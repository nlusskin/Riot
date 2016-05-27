<?php


function sqlsrvr() {
    $server = 'TCP:skzds6jsjx.database.windows.net,1433';
    $user   = 'nlusskin@skzds6jsjx';
    $pwd    = 'Loc.49523';
    $db     = 'ithings';

    $conn = sqlsrv_connect($server, array('UID' => $user, 'PWD' => $pwd, 'Database' => $db));

    if ($conn === FALSE) {
        die(print_r(sqlsrv_errors()));
    }
    if ($conn === TRUE) {
        echo 'Connected Successfully.';
    }

}  

/*
$server = "tcp:skzds6jsjx.database.windows.net,1433";
$user = "nlusskin@skzds6jsjx";
$pwd = "Loc.49523";
$db = "ithings";
$conn = sqlsrv_connect($server, array("UID"=>$user, "PWD"=>$pwd, "Database"=>$db));

try {
    $conn = new PDO("sqlsrv:Server = $server; Database = $db", $user, $pwd);
}

catch(Exception $e){
    die(print_r($e));
    }
*/

function login() {

if ($_POST['uid'] isset) {
    sqlserverconn();
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $tsql = "SELECT uid FROM users WHERE uid = $uid";
    $ret1 = sql_query($conn, $tsql);
    if ($ret1){
        $tsql = "SELECT pwd FROM users WHERE pwd = $pwd";
        $ret2 = sql_query($conn, $tsql);
    }
    else {
        echo "<p>Username is incorrect.<p>"
    }
    if ($ret2) {
        $tsql = "SELECT key FROM key WHERE uid = $uid AND pwd = $pwd"
        $key = sql_query($conn, $tsql);
        setcookie('user', $key);
    }
}

if ($_COOKIE['user'] isset) {
    exit();
}
elseif ($_COOKIE['user'] !isset){
    echo "Not logged in."
}
else {
    echo "Error."
}
}
?>
