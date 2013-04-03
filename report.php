<?php
include_once "Spreadsheet/Excel/Writer.php";

header("Content-type: text/html; charset=utf-8'");

$dbconnection = @mysql_connect("localhost", "root", "97103");
if (!$dbconnection) {
	die("<h3>Unable to connect to the database server at this time.</h3>");
}

$dbselected = mysql_select_db("eurocoord_wp4", $dbconnection);
if (!$dbselected) {
	die('Can\'t use eurocoord_wp4 : ' . mysql_error());
}
mysql_query("set names 'utf8';");

function query2table($result) {
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\">\n";
	echo "<tr>\n";
	$i = 0;
	while ($i < mysql_num_fields($result)) {
		$field = mysql_fetch_field($result, $i);
		echo "<th class=result>" . $field -> name . "</th>";
		$i++;
	}
	echo "</tr>\n";
	$num_rows = mysql_num_rows($result);
	if ($num_rows == 0) {
		echo "</table><p> &nbsp; " . $num_rows . " rows returned!</p>";
		//        echo "<tr><td>".$num_rows." rows returned!</tr></td>";
	} else {
		for ($j = 0; $j < $num_rows; $j++) {
			$i = 0;
			$resultrow = mysql_fetch_assoc($result);
			echo "<tr>\n";
			while ($i < mysql_num_fields($result)) {
				$field = mysql_fetch_field($result, $i);
				echo "<td class=result>" . $resultrow[$field -> name] . "</td>";
				$i++;
			}
			echo "</tr>\n";
		}
	}
	echo "</table>";
}

function query2xls($result, $method)
{ 
    if ($method == "download")
    {
        $workbook =& new Spreadsheet_Excel_Writer();
        $workbook->send("query.xls");
    }
    else
    {
        $workbook =& new Spreadsheet_Excel_Writer($method);
    }
    
    $sheet =& $workbook->addWorksheet('Query Result');
 
    $format_header_row =& $workbook->addFormat();
    $format_header_row->setTop(1);
    $format_header_row->setLeft(1);
    $format_header_row->setBottom(1);
    $format_header_row->setPattern(1);
    $format_header_row->setBorderColor('black');
    $format_header_row->setFgColor(31);
    $format_header_row->setBold();
    $format_header_row->setShadow();

    $format_data =& $workbook->addFormat();
    $format_data->setAlign('center');
    
// colors are calculated by subtractring 7 from the color table
    
    $i = 0;
    while ($i < mysql_num_fields($result))
    {
        $field = mysql_fetch_field($result, $i);
        $sheet->write(0,$i,$field->name, $format_header_row);
        $i++;
    }
    $num_rows = mysql_num_rows($result);
    if ($num_rows == 0)
    {
        $message = $num_rows . " rows returned!";
        $sheet->write(1,0,$message);
    }
    else
    {
        for ($j=0; $j<$num_rows; $j++)
        {
            $i = 0;
            $resultrow = mysql_fetch_assoc($result);
            while ($i < mysql_num_fields($result))
            {
                $field = mysql_fetch_field($result, $i);
                $sheet->write($j+1,$i,$resultrow[$field->name],$format_data);
                $i++;
            }
            echo "</tr>\n";
        }
    }
    $workbook->close();
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Completion Report</title>
<style type="text/css">
	body, td, th, input, select {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	body {
		background-color: #f8e8a0;
	}
	th.result {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
		color: #000000;
		background-color: #99FFFF;
		-moz-border-radius: 8px 8px 8px 8px;
	}
	td.result {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
		background-color: #FFFFFF;
		-moz-border-radius: 4px 4px 4px 4px;
	}
</style>
</head>
<body>

<h3>Overall Completion Report: </h3>
<?
$result = mysql_query("SELECT * FROM completed;");
query2table($result);
?>
<h3>Percentiles: </h3>
<?
$result = mysql_query("SELECT * FROM percentiles;");
query2table($result);
?>
<h3>Analytical Report:</h3>
<?
$result = mysql_query("SELECT * FROM completion_report;");
query2table($result);
$result = mysql_query("SELECT * FROM completion_report;");
query2xls($result, "answered.xls");
?>
<p>Αποτελέσματα σε <a href="answered.xls">Excel</a></p>
</body>
</html>
