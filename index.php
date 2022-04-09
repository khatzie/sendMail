<?php

/***
By: My Code Snippet
***/
	
	include 'config.php';
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require 'PHPMailer/vendor/autoload.php';
	
	//Create an instance; passing `true` enables exceptions
	$phpMailer = new PHPMailer(true);
	
	include 'sendMail.php';
	
	$sendMail = new SendMail($phpMailer);
	
	//initialize data
	$recipient = 'myMail@gmail.com';
	$fromEmail = 'noreply@example.com';
	$fromName = 'Example Company';
	$message = 'Hello, <br> 
	This is your email send thru PHP.';
	$subject = 'Your PHP Mail';
	
	$sendMail->send($recipient, $fromEmail, $fromName, $message, $subject);
	
?>