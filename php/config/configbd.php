<?php
/*
// mysql_connect("database-host", "username", "password")
$conn = mysql_connect("localhost","root","root") 
			or die("cannot connected");
// mysql_select_db("database-name", "connection-link-identifier")
@mysql_select_db("test",$conn);
*/

/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */

$databaseHost = 'us-cdbr-east-05.cleardb.net';
$databaseName = 'heroku_0da26506f5f16f5';
$databaseUsername = 'b04e4dafaf991b';
$databasePassword = '394a13a6';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
$mysqli->set_charset("utf8")
 
?>