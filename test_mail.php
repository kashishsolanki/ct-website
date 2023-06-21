<?php

    $recipient_email = "aarohi.codetheorem@gmail.com"; //recepient Isko mail milega hello@codetheorem.co
    $from_email = "admin@codetheorem.co"; //from email using site domain.

    $error_output = '';
    $success_output = '';
    
    $headers = "From:" . $from_email . "\r\n" .
    "Reply-To: " . $sender_email . "\n" .
    "X-Mailer: PHP/" . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message_body .= '<!DOCTYPE html>
    <html lang="en">
    <head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Query</title>
      <link href="https://fonts.googleapis.com" rel="preconnect" />
      <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
      <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet" />
      <style type="text/css">.txt{
                padding-top: 43px;
                font-weight: 400;
                font-size: 15px;
                color: #414141;
            }
            .data{
                font-size: 17px;
                font-weight: 500;
                padding-top: 40px;
                color: #010101;
            }
            table td{
              padding-left: 2rem;
              padding-right: 2rem;
            }
      </style>
    </head>
    <body style="font-family: Montserrat;">
    <div class="container" style="width: 600px; height: auto; padding: 2rem;">
    <section class="logo" id="logo" style="text-align: center; margin-top: 56px; margin-bottom: 57.81px;"><img alt="code theorem logo" src="https://codetheorem.co/images/codetheorem_logo_horizontal.svg" width="291" /></section>
    
    <section class="text-section" style="margin-bottom: 40px;"><span style="font-weight: 400; font-size: 17px; top: 137px;">Hello Team</span>
    
    <p style="font-weight: 400; font-size: 17px; margin-top: 12px;">You have received an inquiry. The details of the Client are listed below:</p>
    </section>
    
    <section class="details" style="background-color: #FAFAFA; height: 45rem; margin-bottom: 5rem;">
    <table style="width: 100%; padding: 41px 54px 48px 32px">
      <tbody>
        <tr>
          <td class="txt">Interested in...</td>
          <td class="data" id="interest">Research &amp; Strategy</td>
        </tr>
        <tr>
          <td class="txt">Client Name</td>
          <td class="data" id="name">Anisha Kapoor</td>
        </tr>
        <tr>
          <td class="txt">Company Name</td>
          <td class="data" id="company-name">Author House</td>
        </tr>
        <tr>
          <td class="txt">Email ID</td>
          <td class="data" id="email">theanisha@kapoor.com</td>
        </tr>
        <tr>
          <td class="txt">Phone No.</td>
          <td class="data" id="contact-number">9588746746</td>
        </tr>
        <tr>
          <td class="txt" style="float: left;">Project Details</td>
          <td>
          <div class="message data" style="width: 201px; height: 244px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro ipsum qui est quis, aut ab quam nisi quasi fugiat eius modi esse ad molestiae at aliquam, exercitationem libero minima! Eveniet!</div>
    
          <div class="line">
          <hr style="width: 206px; float: left; margin-top: 5rem;" /></div>
          </td>
        </tr>
      </tbody>
    </table>
    </section>
    
    <p class="text-center" style="font-size: 14px; font-weight: 400;">&copy; codetheorem 2021</p>
    </div>
    </body>
    </html>';

    
    $body = $message_body;

    $sentMail = mail($recipient_email, $subject, $body, $headers);
    // Send email 
    if($sentMail){ 
        $success_output = "Your message sent successfully"; 
    }else{ 
        $error_output = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

	$output = array(
		'error'     =>  $error_output,
		'success'   =>  $success_output
	);
	
	echo json_encode($output);

?>