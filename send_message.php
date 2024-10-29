<?php
error_reporting(1);
ini_set('display_errors', 1);
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$email = $_POST['email'];
$phone = $_POST['phone'];

$subject = $_POST['subject'];

$message = $_POST['message'];

$name = $first_name . " " . $last_name;

$message2 = "New message from " . $name . " " . "(" . $email . ")" . "\r\n\r\n" . $subject . "\r\n\r\n" . $message . "\r\n\r\n" . $phone;

require_once 'lib/swift_required.php';
try
{
	//Generating the Email Content
	$message = Swift_Message::newInstance()
	->setFrom(array("bf8ltd@gmail.com" => 'Bf8 Form'))
	->setTo(array("g@bf8.com" => "George"))
	->setSubject("New Message")
	->setBody("$message2");
	
	// Create the Mail Transport Configuration
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
	->setUsername('bf8ltd@gmail.com')
	->setPassword('73#$druyucEW')
	->setStreamOptions(array(
			'ssl' => array(
					'allow_self_signed' => true,
					'verify_peer' => false)));
	
	//local domain sending
	$transport->setLocalDomain('[127.0.0.1]');
	
	$mailer = Swift_Mailer::newInstance($transport);
	
	//Send the email
	$sentFlag = $mailer->send($message);
}
catch (Exception $e)
{
	echo $e->getMessage();
}

?>