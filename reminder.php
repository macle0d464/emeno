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
	// $mime -> addAttachment($file, $content_type, $file_name, 1);
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

$result = mysql_query("SELECT * FROM users WHERE emailed='0' AND completed=0; ");
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
	$coverletter_body .= "<p>This is a reminder that the closing date for the WP4 survey is Thursday December 22th, 2011.</p>\n";
	$coverletter_body .= "<p>We would appreciate it if you could meet this deadline.</p>\n";
	$coverletter_body .= "<br />\n";
	$coverletter_body .= "<p>Kind regards<br /><br />The WP4 team<br />&nbsp;&nbsp;&nbsp; Lead: Bruno Ledergerber</p>\n";
	$coverletter_body .= "<p>Data Inventory team<br />&nbsp;&nbsp;&nbsp; Nikos Pantazis<br />&nbsp;&nbsp;&nbsp; Ashley Olson</p>";
	// print_r($recipients);
	// echo $coverletter_body;
	echo "Emailed ".$row['id']." --> To: ".htmlentities($to).", Cc: ".htmlentities($cc)." \n";
	email($from, $recipients, $subject, $coverletter_body, $row['aa']);

}

echo "</pre>";
?>