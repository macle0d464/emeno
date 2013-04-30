<?php 

$mysqli = new mysqli($dbserver, $dbusername, $dbpassword, $database);

/* check connection */
if ($mysqli->connect_errno) {
    printf( "<h3>Unable to connect to the database server at this time.</h3>" );
    printf( "<h3>Connect failed: %s\n </h3>", $mysqli->connect_error);
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8';");

function execute_query($sql) {
    return $mysqli->query($sql);
}

?>