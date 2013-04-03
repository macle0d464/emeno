<?php 

$dbconnection = @mysql_connect("localhost", "root", "97103");
if (!$dbconnection) {
	die( "<h3>Unable to connect to the database server at this time.</h3>" );
}

$dbselected = mysql_select_db("eurocoord_wp4", $dbconnection);
if (!$dbselected) {
   	die ('Can\'t use eurocoord_wp4 : ' . mysql_error());
}
mysql_query("set names 'utf8';");

$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
if ($table == '') {
	$table = 'cohort_description';
}

$result = mysql_query("SELECT * FROM $table WHERE id='$id'");
echo mysql_error();
$data[$table] = array();
while ($row = mysql_fetch_assoc($result)) {
	$data[$table][$row['name']] = $row['value'];
}


?>