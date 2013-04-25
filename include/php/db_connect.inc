<?php 

$dbconnection = mysql_connect($dbserver, $dbusername, $dbpassword);
if (!$dbconnection) {
	die( "<h3>Unable to connect to the database server at this time.</h3>" );
}

$dbselected = mysql_select_db($database, $dbconnection);
if (!$dbselected) {
   	die ('Can\'t use ' . $database . ' : ' . mysql_error());
}

mysql_query("set names 'utf8';");

function execute_query($sql) {
    return mysql_query($sql);
}

?>