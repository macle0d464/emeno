<?php

require_once('include/php/excel_reader2.php');

$dbconnection = @mysql_connect("localhost", "root", "97103");
if (!$dbconnection) {
    die("<h3>Unable to connect to the database server at this time.</h3>");
}

$dbselected = mysql_select_db("emeno", $dbconnection);
if (!$dbselected) {
    die('Can\'t use emeno : ' . mysql_error());
}
mysql_query("set names 'utf8';");

/* Excel columns
 * F: ATC Code
 * G: Medicine Code
 * I: Medicine Name
 * K: Medicine Contents 
*/

$col_atccode = 6;
$col_medcode = 7;
$col_medname = 9;
$col_contents = 11;

$eofxlsdir = "./eof/";

$eofxlsfiles = array();
$eofxlsfiles[] = "ATC_A.xls";
$eofxlsfiles[] = "ATC_B.xls";
$eofxlsfiles[] = "ATC_C.xls";
$eofxlsfiles[] = "ATC_D.xls";
$eofxlsfiles[] = "ATC_G.xls";
$eofxlsfiles[] = "ATC_H.xls";
$eofxlsfiles[] = "ATC_J.xls";
$eofxlsfiles[] = "ATC_L.xls";
$eofxlsfiles[] = "ATC_M.xls";
$eofxlsfiles[] = "ATC_N.xls";
$eofxlsfiles[] = "ATC_P.xls";
$eofxlsfiles[] = "ATC_R.xls";
$eofxlsfiles[] = "ATC_S.xls";
$eofxlsfiles[] = "ATC_V.xls";

//$i = 0;

for ($x=0; $x<count($eofxlsfiles); $x++) {

$xldata = new Spreadsheet_Excel_Reader($eofxlsdir . $eofxlsfiles[$x]);//, 'WINDOWS-1253');
$current_atccode = "";
$meds = array();
$atccode_categories = array();
for ($r=11; $r<$xldata->sheets[0]['numRows']; $r++) {
    $atccode = $xldata->val($r, $col_atccode);
    $medcode = trim($xldata->val($r, $col_medcode));
    $medname = trim($xldata->val($r, $col_medname));
    $contents = trim($xldata->val($r, $col_contents));
    if ($atccode != "") {
        
        $atccode_parts[0] = trim(substr($atccode, 0, strpos($atccode, ' ')));
        $atccode_parts[1] = trim(substr($atccode, strpos($atccode, ' ')));
        $current_atccode = $atccode_parts[0];
        $atccode_categories[] = array('id' => $atccode_parts[0], 'description' => $atccode_parts[1]);
    }
    if (($medcode != "") && ($medname != "") && ($contents != "")) {
        $meds[] = array('id' => '', 'atccode' => $current_atccode, 'medcode' => $medcode, 'medname' => $medname, 'contents' => $contents);
    }
}

echo "<pre>";
//print_r($atccode_categories);
//print_r($meds);
for ($i=0; $i<count($atccode_categories); $i++) {
    mysql_query("INSERT INTO atc_categories VALUES ('".$atccode_categories[$i]['id']."', '".$atccode_categories[$i]['description']."'); ");
    echo mysql_error();
}
for ($i=0; $i<count($meds); $i++) {
    mysql_query("INSERT INTO medicines VALUES ('', '".$meds[$i]['atccode']."', '".$meds[$i]['medcode']."', '".$meds[$i]['medname']."', '".$meds[$i]['contents']."'); ");
    echo mysql_error();
}

}

?>