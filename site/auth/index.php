<?php
session_start();
/*ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);*/
		if ($_SESSION['usera']){
			echo "<script type='text/javascript'>
			window.location = '../dashboard';
			</script>";
		}

	function error(){
		
		if (!$_SESSION['error']){
			;
		}

		else {
			echo "Login is incorrect, please try again.";
		}
}

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login to RIOT</title>
        <link type="text/css" href="style.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <link rel="icon" type="image/png" href="../res/logo.png">
       
		<script type="text/javascript">
	   	function disable()
	   	{
	   		document.getElementById("sub").disabled = true;

	   	}

	   	function directions()
	   	{
	   		document.getElementById("rloge").style.display = "normal";
	   	}
	   	/*disable();*/

	   	function tip()
	   	{
	   		var i = 0;
	   	}


	   	/*function (loginCheck)
	   	{
	   	var quip = window.location.href;
	   	var posit = quip.search('login=incorrect');
	   	var quip = document.cookie('login');

	   	if (quip != "")
	   	{
	   	document.getElementById('login_error').show;
	   	}
	   	else
	   	{
	   	return "";
	   	}
	   	}
	   	loginCheck();
	   	document.getElementById('login_error').show;*/
    </script>     
    </head>
    <body>

<div class="tbody">
<table>
<tr>
<td style="text-align: center;">
<img src="logo.png" alt="logo" id="logo">
</td>
</tr>
<tr>
<td>
<div id="login_error" style="visibility: visible;"><p style="font-size: 14px; color: #f00;"><?php error(); ?></p></div>

        <form id="login" action="login.php" method="get">
        </br>
        <br>
        <input type="text" name="uid" id="uid" class="box" placeholder="  username">
        </br>
        </br>
        <input type="password" name="pwd" id="pwd" class="box" placeholder="  password">
        </br>
        </br>
        <input type="submit" value="Login" id="sub" class="button" onfocus="tip();">
        </form>
</td>
</tr>	
<tr><td>
	<a href="#" id="rlog" onclick="document.getElementById('rloge').style.display = 'inline';">Request login</a><br>
	
	<div id="rloge">
		<p id="rlog1">If you are an investor, click </p><a id="rlog1" href="https://angel.co/riot-4">here</a>
		<p id="rlog1"> to access login information.</p>
	</div>
	<a href="https://angel.co/riot-4" id="rlog">Learn More</a>
</td></tr>


</table>    
</div>        

        
    </body>
</html>

