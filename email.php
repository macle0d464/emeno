<?php

require_once "Mail.php";
require_once "Mail/mime.php";

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

function email($from, $recipients, $subject, $body, $id) {

	$smtphost = "mail.med.uoa.gr";
	$port = "25";
	//	$smtphost = "ssl://smtp.gmail.com";
	//	$port = "465";
	//	$username = "nsubdeept@gmail.com";
	//	$password = "[nsubdeept].";
	/*
	 $smtp_params = Mail::factory('smtp',
	 array ('host' => $smtphost,
	 'auth' => false));

	 $mail = Mail::factory('smtp',
	 array ('host' => $host,
	 'port' => $port,
	 'auth' => false)
	 // 'auth' => true,
	 // 'username' => $username,
	 // 'password' => $password)
	 );
	 */
	$headers = array('From' => $from, 'To' => $recipients['to'], 'Cc' => $recipients['cc'], 'Bcc' => $recipients['bcc'], 'Subject' => $subject, 'Content-Type' => 'text/html; charset=UTF-8; format=flowed', 'Content-Transfer-Encoding' => '8bit');
	$crlf = "\n";

	// $mime = new Mail_mime($crlf);
	$mime = new Mail_mime( array("text_charset" => "utf-8", "html_charset" => "utf-8", "eol" => "\n") );

	// Setting the body of the email
	$mime -> setTXTBody($body);
	$mime -> setHTMLBody($body);

	// Add an attachment
	$file = "Introduction to the online WP4.4 survey tool.pdf";
	// Content of the file
	$file_name = "Introduction to the online WP4.4 survey tool.pdf";
	// Name of the Attachment
	$content_type = "application/pdf";
	// Content type of the file
	$mime -> addAttachment($file, $content_type, $file_name, 1);
	// Add the attachment to the email
	$body = $mime -> get();
	// prepare headers
	foreach ($headers as $name => $value){
	    $headers[$name] = $mime->encodeHeader($name, $value, "utf-8", "quoted-printable");
	}	
	foreach ($recipients as $name => $value){
	     $recipients[$name] = $mime->encodeHeader($name, $value, "utf-8", "quoted-printable");
	}	

    // $recipients['to'] = $mime->encodeHeader('to', $recipients['to'], "utf-8", "quoted-printable");
    // $recipients['cc'] = $mime->encodeHeader('cc', $recipients['cc'], "utf-8", "quoted-printable");

	$headers = $mime -> headers($headers);
	 // print_r($recipients);
	 // print_r($headers);
	// print_r($body);
	// Sending the email
	$smtp_params["host"] = $smtphost;
	// SMTP host
	$smtp_params["port"] = "25";
	// SMTP Port (usually 25)

	//$mail =& Mail::factory('mail');

	// Sending the email using smtp
	$mail = &Mail::factory("smtp", $smtp_params);
	$result = $mail -> send($recipients, $headers, $body);
	if ($result == 1) {
		echo("Your message has been sent to the following recipients --> To: " . $recipients['to'] . ", Cc:" . $recipients['cc'] . "\n");
		mysql_query("UPDATE users SET emailed='1' WHERE aa='".$id."'; ");
		// echo $result;
	} else {
		echo("Your message was not sent: " . $result . "\n");
	}

}

$from = "Nikos Pantazis <npantaz@med.uoa.gr>";
$subject = "EuroCoord WP4: Data inventory survey";
$bcc = "Nikos Pantazis <npantaz@med.uoa.gr>, Nikos Kiourtis <nkiourtis@gmail.com>";

echo "<pre>\n";

$result = mysql_query("SELECT * FROM users WHERE emailed='0'; ");
for ($i = 0; $i < mysql_num_rows($result); $i++) {
	$row = mysql_fetch_assoc($result);
	// print_r($row);
	$dm_name = $row['dm_name'];
	$cc = "\"" . $row['pi_name'] . "\" <" . $row['pi_email'] . ">";
	if ($row['pi2_name'] != "") {
		$cc .= ", " . $row['pi2_name'] . " <" . $row['pi2_email'] . ">";
	}
	if ($row['pi3_name'] != "") {
		$cc .= ", " . $row['pi3_name'] . " <" . $row['pi3_email'] . ">";
	}
	$to = $row['dm_name'] . " <" . $row['dm_email'] . ">";
	if ($row['dm2_name'] != "") {
		$to .= ", " . $row['dm2_name'] . " <" . $row['dm2_email'] . ">";
	}
	$cohort_name = $row['cohort_name'];
	$link = "http://195.134.113.115/wp4/survey.php?id=" . $row['id'];
	$recipients = array('to' => $to, 'cc' => $cc, 'bcc' => $bcc);
	$coverletter_body = "Dear $dm_name,<br />\n";
	$coverletter_body .= "<p>The Data Management and Harmonisation EuroCoord work package (WP4) focuses on ensuring harmonisation and standardised definitions of the data variables captured by the 4 founding networks (CASCADE, COHERE, EuroSIDA and PENTA-ECS).</p>\n";
	$coverletter_body .= "<p>One of the objectives of WP4 is to conduct a comprehensive inventory of data items and biological material at both network and single cohort level within EuroCoord. This will help assessing feasibility of cross-network projects so that cost estimates and need for additional data collection can be readily identified.</p>\n";
	$coverletter_body .= "<p>The data inventory takes the format of an online survey. Please find enclosed an introductory document with the instructions on how to complete the survey. As \"$cohort_name\" is participating to at least one of the EuroCoord networks, you as the data manager of this cohort (or some other cohort representative) are kindly requested to complete the survey as soon as possible.</p>\n";
	$coverletter_body .= "<p>To access the survey, please follow this link:<br /><a href='$link'>$link</a></p>\n";
	$coverletter_body .= "<p>Please read the introductory document before starting filling-in items.</p>\n";
	$coverletter_body .= "<p>You are receiving this email because you have not responded to previous calls for this survey or because your percentage of completion is very low. If, for any reason, you will not be able to fill-in this survey or need further clarifications/assistance please contact Nikos Pantazis at&nbsp; <a href='mailto:npantaz@med.uoa.gr'>npantaz@med.uoa.gr</a>&nbsp; </p><br />\n";
	$coverletter_body .= "<p>Kind regards<br /><br />The WP4 team<br />&nbsp;&nbsp;&nbsp; Lead: Jesper Kjær</p>\n";
	$coverletter_body .= "<p>Data Inventory team<br />&nbsp;&nbsp;&nbsp; Nikos Pantazis<br />&nbsp;&nbsp;&nbsp; Ashley Olson</p>";
	// print_r($recipients);
	// echo $coverletter_body;
	echo "Emailed ".$row['id']." --> To: ".htmlentities($to).", Cc: ".htmlentities($cc)." \n";
	email($from, $recipients, $subject, $coverletter_body, $row['aa']);

}

echo "</pre>";
?>