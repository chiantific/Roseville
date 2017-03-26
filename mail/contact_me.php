<?php
require 'PHPMailer/PHPMailerAutoload.php';

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = 'info@roseville.ch';
$email_subject = "Roseville Escape contact from:  $name";
$email_body = "You have received a new message from the Roseville Escape contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";

$mail = new PHPMailer;
$mail->AddReplyTo($email_address);
$mail->setFrom('noreply@roseville.ch');
$mail->addAddress($to);
$mail->Subject = $email_subject;
$mail->Body = $email_body;
$mail->CharSet = 'UTF-8';

$mail->send();
return true;			
?>
