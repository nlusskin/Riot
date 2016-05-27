<?php
/*Authentication Class*/
/*PHP Vars Doc: https://msdn.microsoft.com/en-us/library/cc296207(v=sql.105).aspx
ini_set('display_errors', 'On');//remove in production
error_reporting(E_ALL | E_STRICT);//^^*/
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

$tsql = array("SELECT fname FROM users WHERE ukey = '$ukey'");

$stmt  = sqlsrv_query($conn, $tsql[0]);
$adisp = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

$un = $adisp['fname'];
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
		<li class="nav" id="titlehead"style="border: none; font-family: damion;">	
			<a>Riot</a>
		</li>
		<li class="nav" onclick='divver("profile");'>
			<a href="#"><span >Welcome, <?php echo $un; ?></span></a>
		</li>
		<li class="nav" onclick='divver("devices");'>
			<a href="#"><span>Devices</span></a>
		</li>
		<li class="nav" onclick='divver("settings");'>
			<a href="#"><span>Settings</span></a>
		</li>
		<li class="nav" onclick='divver("help");'>
			<a href="#"><span>Help</span></a>
		</li>
		<li class="nav" onclick='divver("add");'>
			<a href="#"><span>+ Device</span></a>	
		</li>
		<li class="nav">
		<a href="../auth/logout.php"><span>Logout</span></a>
		</li>
	</ul>
</div>
<div id="devices" class="order">
<?php

$bsql = array("SELECT tally FROM users WHERE ukey = '$ukey'");
$bstmt = sqlsrv_query($conn, $bsql[0]);
$bdisp = sqlsrv_fetch_array($bstmt, SQLSRV_FETCH_ASSOC);
$num = $bdisp['tally'];

function name($take) {
$ukey = $_SESSION['usera'];
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
$csql = array("SELECT did FROM devices WHERE belong = '$ukey' and num = $take");
$cstmt = sqlsrv_query($conn, $csql[0]);
$cdisp = sqlsrv_fetch_array($cstmt, SQLSRV_FETCH_ASSOC);
$did = $cdisp['did'];

$fsql = ("SELECT type FROM devices WHERE belong = '$ukey' AND num = '$take'");
$fstmt = sqlsrv_query($conn, $fsql);
$fdisp = sqlsrv_fetch_array($fstmt, SQLSRV_FETCH_ASSOC);
$type = $fdisp['type'];

$left_adjust = $take*400 - 300;
echo "<div id='obj' style='left:". $left_adjust."px';>
<img src='res/$type.png' id='type_id' alt='type_id'>
<a href='/dashboard/view.html?name=".$did."'><span class='title_id'>".$did."</span></a>";
}

function status($taker){
$ukey = $_SESSION['usera'];
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
$dsql = array("SELECT status FROM devices WHERE belong = '$ukey' and num = $taker");
$dstmt = sqlsrv_query($conn,$dsql[0]);
$ddisp = sqlsrv_fetch_array($dstmt, SQLSRV_FETCH_ASSOC);
$stat = $ddisp['status'];

echo "<span class='info_id' id='status'>Connection: ".$stat."</span>";
}

function data($takers) {
$ukey = $_SESSION['usera'];
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
$esql = array("SELECT data FROM devices WHERE belong = '$ukey' and num = $takers");
$estmt = sqlsrv_query($conn,$esql[0]);
$edisp = sqlsrv_fetch_array($estmt, SQLSRV_FETCH_ASSOC);
$data = $edisp['data'];

$data_stat = explode(',',$data);
$len = count($data_stat)-1;
echo "<span class='info_id' id='data'>Status: $data_stat[$len]</span>
<div id='my$takers' style='width: inherit; height: 100px; position: absolute; top: 150px;'></div>
</div>
<p id='data_set_$takers' style='display:none;'>$data</p>";
$_SESSION[$takers] = $data;
}

for($i=1;$i<=$num;$i++){
name($i);
status($i);
data($i);	
echo "<script type=\"text/javascript\">
var quest = document.getElementById(\"data_set_$i\").innerHTML;
var jewel = quest.split(\",\");

\$('#my$i').highcharts({
			chart: {
				type: 'area',
				backgroundColor: 'rgb(21, 45, 110)'
			},
			borderWidth: 0,
			legend: {
				enabled: false
				},
			title: {
			text: ''
			},
			xAxis: {
				text: 'Time',
				tickIntervals: 1,
				labels: {
					enabled: false
					}
			},
			yAxis: {
				title: {
					text: 'Unit'
				}
			},
			series: [{
				name: 'Data',
				data: [$_SESSION[$i]]
			}]
		});
</script>";
}




?>
</div>

<div id="profile" class="order"><h1>Account</h1></div>
<div id="settings" class="order"><h1>Settings</h1>
<h2>Your Devices:</h2>
<?php	
function names($tin) {
$ukey = $_SESSION['usera'];
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
$fsql = array("SELECT did FROM devices WHERE belong = '$ukey' and num = '$tin'");
$fstmt = sqlsrv_query($conn, $fsql[0]);
$fdisp = sqlsrv_fetch_array($fstmt, SQLSRV_FETCH_ASSOC);
$dids = $fdisp['did'];

echo "<form name='update_$dids' style='display: inline; width: 500px;'>
<input id='control_name_$dids' name='newName' onmouseover='edit_on(\"$dids\")' onmouseout='edit_off(\"$dids\")' onclick='edit(\"$dids\")' style='display: inline; position:relative; font-size: 48px; width: 250px; color: #1a64a2; border: none;' value='$dids'>
<input type='button' id='update_button_$dids' onclick='send_check(\"update_id\", \"$tin\", \"$dids\")' value='Change' style='background-color: #1a64a2; color: #fff; height: 48px; display: none;'>
</form>
<br><br><br><br>
<a href='#'><p onclick='send_check(\"delete\", \"$tin\", \"$dids\")' style='display: inline; padding: 20px;'><b>Delete Device </b></p></a> 
<a href='#'><p onclick='divver(\"rules_$dids\", \"g\")' style='display: inline; padding: 20px;'><b> Set Data Rules</b></p></a>
<br><br><br><br>
";
    }

for ($in=1;$in<=$num;$in++) {
	names($in);
}
?>
	<script type="text/javascript">
 	function edit_on(a) {
 		document.getElementById('control_name_' + a).style.backgroundColor = '#e1e1e1';
 	}
 	function edit_off(b) {
 		document.getElementById('control_name_' + b).style.backgroundColor = '#fff';
 	}
 	function edit(c) {
 		//document.getElementById('control_name').style.border = '3px solid #152d6e';
 		document.getElementById('update_button_' + c).style.display = 'inline';
 	}
 	function send_check(c, d, e) {
 		var request = new XMLHttpRequest();
 		var new_id = document.forms['update_' + e]['newName'].value;
 		//document.getElementById('update_button').style.backgroundColor = "#808080";
 		request.open('GET', 'update.php?type=' + c + '&val=' + d + '&name=' + new_id, true);
 		request.send();
		if (c == 'update_id'){
			 		document.getElementById('update_button_' + e).value = "Device Name Has Been Updated";
		}
 	}
</script>
</div>
<div id="help" class="order"><h1>Help</h1></div>
<div id="add" class="order"><h1>Add a Device</h1>
	
<script type="text/javascript">
	function addThisDevice(c, d) {
		var request = new XMLHttpRequest();
		var id = document.forms['add']['id'].value;
		document.getElementById('reg').style.backgroundColor = "#808080";
		request.onreadystatechange = function () {
			document.getElementById('success_add').style.display = "inline";
			var full = request.responseText;
			full.toString;
			var each = full.split("|");
			document.getElementById('return_addr').innerHTML = each[0];
			document.getElementById('return_key').innerHTML = each[1];
			document.getElementById('reg').style.backgroundColor = "#1a64a2";

		}
		request.open('GET', 'update.php?type=' + c + '&val=' + d + '&name=' + id, true);
		request.send();
	}
</script>
	<form name="add">
	<p>You can add up to 3 Arduinos to this account. In the future you'll be able to add more.</p>
	<input class="box" type="text" name="id" placeholder="Name Your Device" required><br><br>
	<label>Type: Arduino</label>
	<input class="other" type="radio" name="isArduino" checked><br><br>
	<input class="plane" id="reg" type="button" value="Add This" onclick="addThisDevice('new','null')">
	<p id="success"></p>
	</form>
	<a href="#" onclick="document.getElementById('success_add').style.display = 'inline'"></a><br>
	<div id="success_add" style="display: none; position: absolute; top: 400px;">
	<h2>Congratulations, you're all ready to go set up your Arduino!</h2><br>
	<p>Your device <b>address</b> is (also in settings): </p><p class="inst" id="return_addr" style="color: #000; background-color: #ffd800;"></p>
	<p>Your device <b>key</b> is (also in settings): </p><p class="inst" id="return_key" style="color: #000; background-color: #ffd800;"></p>
	<p>Here's how to get set up:</p>
	<p><b>1. </b>Grab an Arduino and set up a sketch. It doesn't matter if you have a sketch already, Riot is very flexible.</p>
	<p>If you want to set up a quick example, <a href="https://bitbucket.org/riot-rocks/riot-for-arduino">check this out.</a></p>
	<p><b>2. </b>In your sketch, add the following code before the <b>setup()</b> function:</p>
<div id="code">
	#include &lt;Dhcp.h&gt;<br>
	#include &lt;Dns.h&gt;<br>
	#include &lt;Ethernet.h&gt;<br>
	#include &lt;EthernetClient.h&gt;<br>
	#include &lt;EthernetServer.h&gt;<br>
	#include &lt;SPI.h&gt;<br><br>
<span id="comment">
	//Set Service Variables Here</span><br>
	<span id="dtype">String</span> serial = "D0987654321"; <span id="comment">//Assigned above (address)</span><br>
	<span id="dtype">String</span> pin = "0001"; <span id="comment">//Assigned above (key)<br><br>

	//Set up internet capabilities </span><br>
	<span id="dtype">byte</span> mac_addr[] = {0xFE, 0xDD, 0xBE, 0xEF, 0xFE, 0xE1};<br>
	<span id="dtype">char</span> server_addr[] = "riot.cloudapp.net"; <span id="comment">//Service URL. Not the same as web URL.</span>
	<br><br>
	<span id="func">EthernetClient</span> client;
</div>
<p><b>3. </b>Once you make sure you're connecting to <b>riot.cloudapp.net</b>, initialize the ethernet or wifi shield.</p>
<p><b>4. </b>In the <b>loop()</b> function of your Arduino sketch, you need to declare two values: The data being sent to Riot and the GET request used to send it.</p>
	<div id="code">
<span id="dtype">void loop()</span> {<br><br>

<span id="dtype">String</span> bite = "12"; //This is the data you want to be sent. Can be any data type.<br><br>

<span id="dtype">String</span> add = "HEAD /?id=";&nbsp;&nbsp;&nbsp;&nbsp;<span id="dtype">//Do not change anything here</span><br>
<span id="dtype">add</span> += serial;<br>
<span id="dtype">add</span> += "&pin=";<br>
<span id="dtype">add</span> += pin;<br>                  
<span id="dtype">add</span> += "&bit=";<br>
<span id="dtype">add</span> += bite;<br>
<span id="dtype">add</span> += " HTTP/1.0"; 
	</div>
<p><b>5. </b>The only thing left to do is initiate the connection to the server and send the data.</p>
<div id="code">
	<span id="dtype">int</span> conn = client.<span id="func">connect</span>(server_addr, 80);<br> 
	client.<span id="func">println</span>(add);<br>
	client.<span id="func">println</span>();<br><br>

	client.<span id="func">stop</span>();<br><br>

	<span id="func">delay</span>(1000); <span id="comment">//This controls how often data is sent to the server. Recommended at least one second (1000ms) to prevent client request overlaps.</span>
</div>
<p>You're all set! You can now do anything you want with your sketch; add events and triggers, send various types of data, etc. Once you start sending data, visit your Dashboard to establish rules that tell Riot how to handle what you are sending.</p>
	</div>
</div>
<div id="rules" class="order">
<?php
function namer($sin) {
$ukey = $_SESSION['usera'];
$server = 'tcp:skzds6jsjx.database.windows.net,1433';
$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
$gsql = array("SELECT did FROM devices WHERE belong = '$ukey' and num = '$sin'");
$gstmt = sqlsrv_query($conn, $gsql[0]);
$gdisp = sqlsrv_fetch_array($gstmt, SQLSRV_FETCH_ASSOC);
$didr = $gdisp['did'];
$hsql = "SELECT data FROM devices WHERE belong='$ukey' and num='$sin'";
$hstmt = sqlsrv_query($conn, $hsql);
$hdisp = sqlsrv_fetch_array($hstmt, SQLSRV_FETCH_ASSOC);
$datap = $hdisp['data'];
$datap_arr = explode(",", $datap);

echo "<h1 id='rule_$didr'>Set Your Data Rules For $didr</h1>";
/*echo "<ul class='data'>";
$n=0;
while($n < count($datap_arr)){
	echo "<li class='data'>$datap_arr[$n]</li>";
	$n++;
}
echo "</ul>";
}
for ($is=1;$is<=$num;$is++) {
	namer($is);
	}*/
	}
?>
<form name="judge" method="post" style="top: 25px; width: 90%; display: inline;">
	<label style="display: inline;">Language:</label>
	<select name="lang" style="display: inline;">
		<option value="php">PHP</option>
		<option value="php" disabled>Coming Soon:</option>
		<option value="python" disabled>Python</option>
		<option value="r" disabled>R</option>
		<option value="js" disabled>JavaScript</option>
		<option value="ruby" disabled>Ruby</option>
	</select>
	<br>
	<textarea name="code" style="width: 500px; height: 250px;" placeholder="Enter your analysis alogrithm here..."></textarea>
	<input type="submit" id="" class="plane">
</form>
</div>

<script type="text/javascript">

	function divver(choose, previous) {
		var aps = new Array("profile", "devices", "settings", "help", "add", "rules");
		var ips = 0;
		while (ips < 6) {
			document.getElementById(aps[ips]).style.display = "none";
			ips++;
		}
		if (previous == "g") {
			document.getElementById('rules').style.display = "inline";
		} else { ; }
		document.getElementById('' + choose).style.display = "inline";
	}
</script>
    </body>
</html>