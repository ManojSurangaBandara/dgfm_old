
<?php
/**
* This example shows settings to use when sending via Google's Gmail servers.
*/
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Colombo');

require ('PHPMailerAutoload.php');

$mail = new PHPMailer;

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
//$mail->Host = 'smtp.gmail.com';
$mail->Host = '172.16.0.18'; //AHQ Email server IP
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls'; // GMAIL required this feature, but ARMY do not
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Add following lines ONLY use with the ARMY email server
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
//END

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'pradeep.s'; //'ahis'; 

//Password to use for SMTP authentication
$mail->Password = 'PERA@nadee1984'; //'hospital2017';

?>