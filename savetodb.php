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

$id = $_REQUEST['id'];
$table = $_REQUEST['table'];
$count = 1;

print_r($_REQUEST);

if ($table == "users") {
	mysql_query("UPDATE users SET completed='1' WHERE id='$id'; ");
} else {
	foreach ($_REQUEST as $name => $value) {
		if (($name != "id") && ($name != "table")) {
			if (($table == "hicdep") || ($table == "nonhicdep")) {
				$name = str_replace("_", ".", $name);
				$name[strpos($name, ".")] = "_";
			}
			mysql_query("REPLACE INTO `$table` VALUES ('$id', '$name', '$value'); ");
			// echo "$name => $value \n";
		}
	}

}
?>