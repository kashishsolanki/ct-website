<?php
$recipient_email = "vraj@codetheorem.co"; // recipient's email address
$from_email = "admin@codetheorem.co"; // sender's email address

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER['REQUEST_METHOD'] === 'POST') {

	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$usercompany = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
	$userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
	$content = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

	$subject = "Code Theorem Inquiry : From " . $name;

	// Construct the message body to be sent to recipient
	$message_body = "Name: $name\n";
	$message_body .= "Company: $usercompany\n";
	$message_body .= "Email: $userEmail\n";
	$message_body .= "Phone: $phone\n";
	$message_body .= "Message: $content\n";

	// Generate a unique boundary for the message
	$boundary = md5("sanwebe.com");

	// Construct the message headers
	$headers = "From: $from_email\r\n";
	$headers .= "Reply-To: $userEmail\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

	// Construct the message body
	$body = "--$boundary\r\n";
	$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
	$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
	$body .= $message_body;

	// Send the email
	$sentMail = mail($recipient_email, $subject, $body, $headers);

	if ($sentMail) {
		echo "Mail Sent.";
	} else {
		echo "Problem in Sending Mail.";
	}
}
else {
	die('Sorry, Request must be Ajax POST');
}
?>
