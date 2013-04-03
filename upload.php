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


   if (!isset($_FILES['myfile'])) {
   	   echo "<pre>\n";
	   $result = mysql_query("SELECT value FROM cohort_description WHERE name='file' AND id='".$_REQUEST['id']."'; ");
	   if (mysql_num_rows($result) > 0) {
	       echo "Uploaded file: \n";
		   $row = mysql_fetch_array($result);
		   echo "  ".substr($row[0], strpos($row[0], "_")+1);	
	   } else {
	       echo "No file uploaded.";	   	
	   }
	   echo "</pre>";
   	   die;
   }

   echo "<pre>\n";
   
   $destination_path = getcwd().DIRECTORY_SEPARATOR;
 
   $result = 0;
 
   $target_path = $destination_path . 'uploaded_files' . DIRECTORY_SEPARATOR . $_REQUEST['id'] . "_" . basename( $_FILES['myfile']['name']);
   $filename = $_REQUEST['id'] . "_" . basename( $_FILES['myfile']['name']);
 
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
 
   sleep(1);
   
   if ($result) {
   	   echo "Uploaded file: \n";
   	   echo "  ".$_FILES['myfile']['name'];
	   mysql_query("REPLACE INTO cohort_description VALUES ('".$_REQUEST['id']."', 'file', '$filename'); "); 	
   } else {
   	   echo "Error uploading file.. Please try again!";
   }
   echo "<pre>\n";
?>