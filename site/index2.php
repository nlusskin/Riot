<!DOCTYPE html>
<?php
    include "functions.php;"
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link type="text/css" href="style.css" rel="stylesheet">
        <title>iThings Portal</title>
    </head>
    <body>
        
        <div id="header" class="header">
                <span><img src="res/home_ico.png" alt="home"></span>
                <span><img src="res/sett_ico.png" alt="settings"></span>        
        </div>
        <?php require 'functions.php'; getObjs();?>
        <div id="things">
            <table>
            <tr>
            <td>
            <div id="obj"><h2>Thermostat</h2></div>
            </td>
            <td><div id="obj"><h2>Car</h2></div></td>
            <td><div id="obj"><h2>TV</h2></div></td>
            <td><div id="obj"><h2>Electricity</h2></div></td>
            <td><div id="obj"><h2>Lights</h2></div></td>
            <td><div id="obj"><h2>Security</h2></div></td>
            </tr>
            </table>
                
                
                
                
                
                
        </div>
    </body>
</html>
