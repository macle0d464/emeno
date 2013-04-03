<?php 
require_once('./include/php/basic_defines.inc');
require_once('./include/php/db_connect.inc');

$sql = $_REQUEST["sql"];

$data = array();
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) {
	$json = array();
    $i = 0;
	while ($i < mysql_num_fields($result))
    {
        $field = mysql_fetch_field($result, $i);
        $json[$field->name] = $row[$field->name];
        $i++;
    }
	$data[] = $json;
}
mysql_free_result($result);

header("Content-type: application/json");
echo json_encode($data);
?>