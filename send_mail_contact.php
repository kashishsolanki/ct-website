<?php

	define("RECAPTCHA_V3_SECRET_KEY", '6Lf0b7MeAAAAANXPVbXBH3A_vQ4BLQ6Ymjt29ptd');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'includes/Exception.php';
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';

	//SMTP configuration
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->Mailer = "smtp";

	// $mail->SMTPDebug  = 1;  
	$mail->SMTPAuth   = TRUE;
	// $mail->SMTPSecure = "tls";
	$mail->Port       = 465;
	$mail->Host       = "ssl://smtp.gmail.com";
	$mail->Username   = "ctforms.18@gmail.com";
	$mail->Password   = "ctForms@1818";
    $mail->Password   = "zfmbhfnmfyjwlivm";

	$mail->IsHTML(true);
	$mail->AddAddress("vraj@codetheorem.co", "Vraj Trivedi");
	// $mail->AddAddress("dimple@codetheorem.co", "Code Theorem Team");
	$mail->SetFrom("admin@codetheorem.co", "Code Theorem Team"); 

    // $recipient_email = "dimple@codetheorem.co"; //recepient Isko mail milega hello@codetheorem.co
    // $from_email = "admin@codetheorem.co"; //from email using site domain.

	$error_output = '';
	$success_output = '';
    
	// print_r($mail);
	// exit();

if ($_POST) {

	$token = $_POST['token'];
	$action = $_POST['action'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$arrResponse = json_decode($response, true);
	
	// verify the response
	if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
		// valid submission
        $services_list = filter_var($_POST["services"], FILTER_SANITIZE_STRING);
		$sender_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING); //capture sender name
		$sender_email = filter_var($_POST["email"], FILTER_SANITIZE_STRING); //capture sender email
		$sender_phone = filter_var($_POST["phoneno"], FILTER_SANITIZE_STRING); //capture sender phone
		$subject = "Code Theorem Inquiry : From  " . $sender_name;
		
		$form_subject = filter_var($_POST["description"], FILTER_SANITIZE_STRING); //capture message
		$companyname = filter_var($_POST["companyname"], FILTER_SANITIZE_STRING); //capture company name
		//$websiteurl = filter_var($_POST["url"], FILTER_SANITIZE_STRING);

        if (strlen($companyname) < 1) {
            $cmpname = "-";
        }else{
			$cmpname = $companyname;
		}

        foreach ($_POST['services'] as $selected) {
            $service_mes .= " " . $selected . ",";
        }
		$service_mes = rtrim($service_mes, ',');
		$attachments = array();
		
		// Email subject 
		$mail->Subject = $subject;

		// Set email format to HTML 
		$mail->isHTML(true);

		//construct a message body to be sent to recipient
		$message_body .= "Hello, <br> You have received a new inquiry on your site. Kindly find the details for the same.<br>";
		$message_body .= "<b>Name</b>: $sender_name<br>";
		$message_body .= "<b>Email</b>: $sender_email<br>";
		$message_body .= "<b>Phone</b>: $sender_phone<br>";
		$message_body .= "<b>Subject</b>: $form_subject<br>";
        $message_body .= "<b>Company Name</b>: $companyname <br>";
        $message_body .= "<b>Services Interested in</b>: $service_mes<br>";
		$message_body .= "<br><br> Thank You,<br> Team Code Theorem";

	// 	$message_body .= '<!DOCTYPE html>
    // <html lang="en">
    // <head>
    //     <meta charset="UTF-8">
    //     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    //     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //     <title>Query</title>
    //     <link rel="preconnect" href="https://fonts.googleapis.com">
    //     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    //     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    //     <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    //     <style>
    //         .txt{
    //             padding-top: 43px;
    //             font-weight: 400;
    //             font-size: 15px;
    //             color: #414141;
    //         }
    //         .data{
    //             font-size: 17px;
    //             font-weight: 500;
    //             padding-top: 40px;
    //             color: #010101;
    //         }
    //         table td{
    //           padding-left: 2rem;
    //           padding-right: 2rem;
    //         }
    //     </style>
    // </head>
    // <body style="font-family: Montserrat;">
    //   <div class="container" style="width: 600px;height: auto;padding: 2rem;background-color: #fff;box-shadow: 0px 0px 10px -7px;">
    //     <section class="logo" id="logo" style="text-align: center; margin-top: 56px; margin-bottom: 57.81px;">
    //       <img src="images/codetheorem_logo_horizontal.svg" alt="code theorem logo">
    //     </section>
    //     <section class="text-section" style="margin-bottom: 40px;">
    //         <span style="font-weight: 400; font-size: 17px; top: 137px;">Hello Team</span>
    //         <p style="font-weight: 400; font-size: 17px; margin-top: 12px;">You have received an inquiry. The details of the Client are listed below:</p>
    //     </section>
    //     <section class="details" style="background-color: #01000612; height: 45rem; margin-bottom: 5rem;"> 
    //         <table style="width: 100%; padding: 41px 54px 48px 32px">
    //             <tr>
    //               <td class="txt">Interested in...</td>
    //               <td class="data" id="interest">'.$service_mes.'</td>
    //             </tr>
    //             <tr>
    //               <td class="txt">Client Name</td>
    //               <td class="data" id="name">'.$sender_name.'</td>
    //             </tr>
    //             <tr>
    //                 <td class="txt">Company Name</td>
    //                 <td class="data" id="company-name">'.$cmpname.'</td>
    //               </tr>
    //               <tr>
    //                 <td class="txt">Email ID</td>
    //                 <td class="data" id="email">'.$sender_email.'</td>
    //               </tr>
    //               <tr>
    //                 <td class="txt">Phone No.</td>
    //                 <td class="data" id="contact-number">'.$sender_phone.'</td>
    //               </tr>
    //               <tr>
    //                 <td class="txt" style="float: left;">Project Details</td>
    //                 <td><div class="message data" style="width: 201px; height: 244px;">'.$form_subject.'</div>
    //                     <div class="line"><hr style="width: 206px; float: left; margin-top: 5rem;"></div>     
    //                 </td>
    //             </tr>
    //           </table>
    //     </section>
    //     <p class="text-center" style="font-size: 14px; font-weight: 400;">© codetheorem '.date("Y").'</p>
    //   </div>
    // </body>
    // </html>';

		$mail->Body = $message_body; 

		
        // $headers = "From:" . $from_email . "\r\n" .
		// "Reply-To: " . $sender_email . "\n" .
		// "X-Mailer: PHP/" . phpversion();
        // $headers .= "MIME-Version: 1.0\r\n";
        // $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		// $body = $message_body;

        //$sentMail = mail($recipient_email, $subject, $body, $headers);
		// Send email 
		if($mail->send()){ 
			$success_output = "Your message sent successfully"; 
		}else{ 
			$error_output = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
		}

	} else {
		// spam submission
		//header('Location: contact-us.html');
		$error_output = 'Message could not be sent.';
	}

	$output = array(
		'error'     =>  $error_output,
		'success'   =>  $success_output
	);
	
	echo json_encode($output);
}
?>