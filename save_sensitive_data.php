<?php

require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

$objEncManager = new DataEncryptor();

$intervid = $_REQUEST['intervid'];
$emenoid = 0;

$result = $mysqli->query("assign_new_emenoid( $intervid )");
echo $mysqli->error();
$row = $result->fetch_array();
$emenoid = $row[0];
$result->close();
$mysqli->next_result();



$private_data_sql = "START TRANSACTION; ";
foreach ($_REQUEST as $name => $value) {
        if ($name != "intervid") {
            $encvalue = $objEncManager->mcryptEncryptString( $value );
            $private_data_sql .= "INSERT INTO `private` VALUES ('', '$emenoid', '$name', '$encvalue'); ";
        }
}
$private_data_sql .= "COMMIT; ";
$result = $mysqli->query( $private_data_sql );

$result->close();
$mysqli->next_result();

echo $mysqli->error();

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