<?php

$dbconnection = @mysql_connect("localhost", "root", "97103");
if (!$dbconnection) {
	die("<h3>Unable to connect to the database server at this time.</h3>");
}

$dbselected = mysql_select_db("eurocoord_wp4", $dbconnection);
if (!$dbselected) {
	die('Can\'t use eurocoord_wp4 : ' . mysql_error());
}
mysql_query("set names 'utf8';");

$id = trim($_REQUEST['id']);
$table = trim($_REQUEST['table']);

$data = array();

if ($table == "getstate") {
	$result = mysql_query("SELECT completed FROM users WHERE id='$id'");
	$row = mysql_fetch_assoc($result);
	if ($row['completed'] == "0") {
		$data['state'] = "open";		
	} else {
		$data['state'] = "closed";
	}
	echo json_encode($data);
} else {
	$result = mysql_query("SELECT * FROM $table WHERE id='$id'");
	while ($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	echo json_encode($data);
}
?>