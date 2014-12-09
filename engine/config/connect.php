<?php
$host="localhost";
$databaseuser="root";
$databasepassword="";
$database="080property";
$connect = mysql_connect($host,$databaseuser,$databasepassword) or die ("unable to connect to server");
$db = mysql_select_db($database,$connect) or die ("unable to select database.");
?>
