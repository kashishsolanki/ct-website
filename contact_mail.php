<?php
$recipient_email = "marketplace026@gmail.com"; //recepient Isko mail milega hello@codetheorem.co
$from_email = "marketplace026@gmail.com"; //from email using site domain. - isse mail jaega

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	die('Sorry Request must be Ajax POST'); //exit script
}

if ($_POST) {

	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_STRING); //capture sender email
	$subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING); //capture sender email
	$subject_new = "Code Theorem Inquiry : From  " . $subject;
	$content = filter_var($_POST["content"], FILTER_SANITIZE_STRING); //capture message

	$boundary = md5("sanwebe.com");
	//construct a message body to be sent to recipient
	$message_body = "Name: $username\n";
	$message_body = "Email: $userEmail\n";
	$message_body = "Message: $content\n";


	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "From:" . $from_email . "\r\n";
	$headers .= "Reply-To: " . $userEmail . "" . "\r\n";
	$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

			//message text
	$body = "--$boundary\r\n";
	$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
	$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
	$body .= chunk_split(base64_encode($message_body));
	

	$sentMail = mail($recipient_email, $subject_new, $body, $headers);
	if ($sentMail) //output success or failure messages
	{
		print "<p class='success'>Mail Sent.</p>";
	} else {
		print "<p class='Error'>Problem in Sending Mail.</p>";
	}
}
?>