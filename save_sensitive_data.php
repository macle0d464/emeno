<?php

session_start();

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

$objEncManager = new DataEncryptor();

$intervid = $_SESSION['intervid'];
$emenoid = 0;

$result = $mysqli->query("CALL assign_new_emenoid( $intervid ); ");
echo $mysqli->error;
$row = $result->fetch_array();
$emenoid = $row[0];
$result->close();
$mysqli->next_result();



$private_data_sql = "START TRANSACTION; \n";
foreach ($_REQUEST as $name => $value) {
        if (($name != "intervid") & ($name != "PHPSESSID")) {
            $encvalue = $objEncManager->mcryptEncryptString( $value );
            $private_data_sql .= "INSERT INTO `private` VALUES ('', '$emenoid', '$name', '$encvalue'); \n";
        }
}
$private_data_sql .= "COMMIT; \n";
echo $private_data_sql;
$result = $mysqli->multi_query( $private_data_sql );

if ($mysqli->error == false) {
    echo '{"success": true; "emenoid": '.$emenoid.'}';
}

$result->close();
$mysqli->next_result();


$mysqli->close();

die;

/*
    $sensitiveData = "Νίκος Κιούρτης 123 testaki";
    echo "Raw Data: _" . $sensitiveData . "_<br><br>";

    $encryptedData = $objEncManager->mcryptEncryptString( $sensitiveData );
    echo "Enc Data: _" . $encryptedData . "_<br><br>";
    echo "Enc Data length: " . strlen( $encryptedData) . "<br><br>";

    //$decryptedData = $objEncManager->mcryptDecryptString( $encryptedData, $objEncManager->lastIv );
    $decryptedData = $objEncManager->mcryptDecryptStringWithIV( $encryptedData );
    echo "D-enc Data: _" . $decryptedData . "_<br><br>";

    echo "IV: _" . $objEncManager->lastIv . "_<br><br>";
*/

?>