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
        
        <meta charset="utf-8" />
        <title><?php echo $un; ?>'s Dashboard</title>
        <link type="text/css" href="style.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <link rel="icon" type="image/png" href="res/home_ico.png">
  
    </head>
    <body>
        <!--<script type="text/javascript">
                $(function () { 
    $('#chart').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Monthly Usage'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'kW'
            }
        },
        series: [{
            name: 'Home',
            data: [12, 13, 15, 20, 23, 28, 25, 20, 17, 18, 16, 15]
        }/*, {
            name: 'Nat. Avg.',
            data: [9, 11, 14, 19, 15, 22, 9, 11, 14, 19, 15, 16]
        }*/]
    });
});
            </script>-->
        <script type="text/javascript">
            function show(divid) {
                document.getElementById(divid).style.visibility = "visible";
            }
            function hide(divid) {
                document.getElementById(divid).style.visibility = "hidden";
            }
            function create() {
                var n = 0;
                for (n; n < 10; n++) {
                    document.getElementById(diva + n).innerHTML = content;
                }
            }
            function logout() {
                window.location = '../auth/logout.php';
            }
            function turn(state) {
                document.getElementById('status').innerHTML = state;
            }
        </script>
        
        <div class="ctrl" id="ctrl_energy">
            <input type="button" id="div_close" value="X" onclick="hide('ctrl_energy');">
            <h1 style="text-align: center;">Energy</h1>
            <div id="chart"></div>
            <input type="button" id="cape" value="Zone 1">
            <input type="button" id="cape" value="Zone 2">
            </br>
            <input type="button" id="cape" value="Zone 3">
            <input type="button" id="cape" value="Zone 4">
        </div>

        <div class="ctrl" id="ctrl_settings">
        <input type="button" id="div_close" value="X" onclick="hide('ctrl_settings');">
        <h1 style="text-align: center;">Settings</h1>
        <h4> Your Username: <?php echo $un; ?></h4>
        <h4> Your Password: ****</h4>

        </div>
		
		<div id="header">
        <table class="header">
            <tr>
                <td>
                    <a href='/dashboard'><img src="res/logo.png" alt="home" height="50px" class="header"></a>
                </td>
                <td>
                    <h5>Welcome, <?php echo $un; ?></h5>
                </td>
                <td>
                    <h5 onclick="logout();" style="text-decoration: underline; cursor: pointer;">(logout)</h5>
                </td>
                <td id="sett">
                    <img src="res/sett_ico.png" alt="settings" height="35px" class="header" style="cursor: pointer;" onclick="show								('ctrl_settings');">
                </td>
                <td>
            </td>
            </tr>
        </table>
</div>

        <table><tr>
<?php 
			for ($n=1; $n<5; $n++) {
				
			$ukey = $_SESSION['usera'];
			$server = 'tcp:skzds6jsjx.database.windows.net,1433';
			$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
			$bsql = "SELECT did FROM devices WHERE belong = '$ukey' AND num = '$n'";
			$bstmt = sqlsrv_query($conn, $bsql);
			$bdisp = sqlsrv_fetch_array($bstmt, SQLSRV_FETCH_ASSOC);

			$ukey = $_SESSION['usera'];
			$server = 'tcp:skzds6jsjx.database.windows.net,1433';
			$conn = sqlsrv_connect($server, array('UID' => 'nlusskin@skzds6jsjx', 'PWD' => 'Loc.49523', 'Database' => 'ithings'));
			$csql = "SELECT status FROM devices WHERE belong = '$ukey' AND num = '$n'";
			$cstmt = sqlsrv_query($conn, $csql);
			$cdisp = sqlsrv_fetch_array($cstmt, SQLSRV_FETCH_ASSOC);
				
				$dev = $bdisp["did"];
				$stat = $cdisp["status"];
			
			if ($dev) {
				echo '<td>
						<div id="obj" onclick="show(\'ctrl_energy\');">
							<table style="margin-left: auto; margin-right: auto; grid-column-align: center;">
						<tr>
                        <td>
                            <h1 style="text-align: center;">'.$dev.'</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="text-align: center;">Status</p><span>-</span><span>'.$stat.'</span><span>+</span>
                        </td>
                    </tr>
                </table>
            </div>
            </td>';
			}
				else {
					echo "";
					}
				}
				?></tr></table>
               <!-- <td>
                <div id="obj" onclick="show('ctrl_energy');">
                    <table style="margin-left: auto; margin-right: auto; grid-column-align: center;">
                        <tr>
                            <td>
                                <h1 style="text-align: center;"></h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p id="status" style="text-align: center;" onclick="turn('On');">System Is:</p><span>Off</span>
                            </td>
                        </tr>
                    </table>
                </div>
                </td>
                <td>
                <div id="obj" onclick="show('ctrl_energy');">
                    <table style="margin-left: auto; margin-right: auto; grid-column-align: center;">
                        <tr>
                            <td>
                                <h1 style="text-align: center;"></h1>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: center;">Current Temperature:</p><span>75&ordm;</span>
                            </td>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>-->
        </table>
        

        

        


    </body>
</html>
