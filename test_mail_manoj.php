<?php

namespace PHPMailer\PHPMailer;
require_once ('PHPMailer/PHPMailer.php');
require_once ('PHPMailer/SMTP.php');
require_once ('PHPMailer/Exception.php');



//Gmail -------------------------------------------------------
// $phpmailer = new PHPMailer();
// $phpmailer->isSMTP();
// $phpmailer->Host = 'smtp.gmail.com';
// $phpmailer->SMTPAuth = true;
// $phpmailer->Port = 587;
// $phpmailer->SMTPSecure = 'tls'; // Use 'ssl' if you have an older version of PHPMailer
// $phpmailer->Username = 'manojbandara12@gmail.com';
// $phpmailer->Password = 'ohpvqddiitdesibn';
// $phpmailer->setFrom('manoj@suranga.com', 'Manoj Bandara');
// $phpmailer->addAddress('manojband7@gmail.com');           // Add a recipient
// $phpmailer->Subject = 'My subject google';
// $phpmailer->Body    = 'My body google';
// $attachment = 'excel/0AgeAnalys_Report.xls';
// $phpmailer->addAttachment($attachment, 'RenamedFile.xls');
//-------------------------------------------------------------



//Army Mail ---------------------------------------------------
// $phpmailer = new PHPMailer();
// $phpmailer->isSMTP();
// $phpmailer->Host = '172.16.0.18';
// $phpmailer->SMTPAuth = true;
// $phpmailer->Port = 587;
// $phpmailer->SMTPSecure = 'tls'; // Use 'ssl' if you have an older version of PHPMailer
// // $phpmailer->SMTPOptions = array(
// // 'ssl' => array(
// // 'verify_peer' => false,
// // 'verify_peer_name' => false,
// // 'allow_self_signed' => true
// // )
// // );
// $phpmailer->Username = 'pradeep.s';
// $phpmailer->Password = 'Army@1234';
// $phpmailer->setFrom('pradeep.s@army.lk', 'Pradeep S');
// $phpmailer->addAddress('suranga@army.lk');           // Add a recipient
// $phpmailer->Subject = 'My Email subject';
// $phpmailer->Body    = 'My Email body';
// $attachment = 'excel/0AgeAnalys_Report.xls';
// $phpmailer->addAttachment($attachment, 'RenamedFile.xls');
//-------------------------------------------------------------



//Mailtrap ---------------------------------------------------
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '8370157732f009';
$phpmailer->Password = '1a47e215521cc9';
$phpmailer->setFrom('manoj@army.lk', 'Pradeep S');
$phpmailer->addAddress('suranga@army.lk');           // Add a recipient
$phpmailer->Subject = 'My Email subject';
$phpmailer->Body    = 'My Email body';
$attachment = 'excel/0AgeAnalys_Report.xls';
$phpmailer->addAttachment($attachment, 'RenamedFile.xls');
//-------------------------------------------------------------



if(!$phpmailer->send()) 
{
    echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
} 
else 
{
    echo 'Message has been sent';
}

?>