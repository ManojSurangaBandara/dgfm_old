<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Send EMil using XAMPP localhost</title>
</head>

<body>
<?php
//SOURCE: https://github.com/Synchro/PHPMailer/blob/master/examples/gmail.phps



require ('PHPMailer-master/my_config.php');

$client_msg = '<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>PHPMailer Test</title>
</head>
<body>
  <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
    <h1>This is a test of PHPMailer.</h1>
    <div align="center">
    
      <a href="https://github.com/PHPMailer/PHPMailer/"><img src="http://prasanga.eu5.org/mit/images/email_header.jpg" alt="PHPMailer rocks"></a>
      
    </div>
    <p>This example uses <strong>HTML</strong>.</p>
    <p>The PHPMailer image at the top has been embedded automatically.</p>
  </div>
</body>
</html>';

	$subject='Testing Emil ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	
		$client_name = $receiver_name;
		$client_email = 'pradeep.s@army.lk';
	//	$client_email = $receiver_email;
		$reply_to_addr = 'pradeep.s@army.lk'; //THis has to be changed according to the sender mailer server
		$reply_to_name = 'Reply To Me';
		$sender_email = 'pradeep.s@army.lk'; //THis has to be changed according to the sender mailer server
		$sender_name = 'DBFM';

//Set who the message is to be sent from
$mail->setFrom($sender_email,$sender_name);
//Set an alternative reply-to address
$mail->addReplyTo($reply_to_addr,$reply_to_name);
//Set who the message is to be sent to
$mail->addAddress($client_email, $client_name);
$mail->addAddress('pradeep.s@army.lk', 'Pradeep');
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($client_msg, dirname(__FILE__));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('PHPMailer-master/examples/images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message sent!";
}?>
</body>
</html>