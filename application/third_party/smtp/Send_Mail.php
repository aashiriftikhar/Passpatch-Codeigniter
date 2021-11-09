<?php
function Send_Mail($to,$from_email,$body,$subject)
//function Send_Mail($to,$from_email,$body)
{
require_once 'class.phpmailer.php';
$from       = $from_email;//"canopus.info@gmail.com"; //from email is sending 
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->Host       = "temp.canopusinfosystemsportal.com"; // Amazon SES server, note "tls://" protocol
$mail->Host       = "passpatchllc.com";
$mail->Port       =  25;                    // set the SMTP port
$mail->Username   = "temp@passpatchllc.com"; // SMTP  username
$mail->Password   = "HT,.]Um=_hsm";// SMTP password
$mail->SetFrom($from, $from_email);
$mail->AddReplyTo($from,'From Name');
//$mail->AddEmbeddedImage('https://www.mail-signatures.com/articles/wp-content/themes/emailsignatures/images/twitter-35x35.gif', 'pic-twitter', 'twitter.jpg ');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

$mail->Send();   
return true;

}
?>

