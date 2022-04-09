<?php
/***
By: My Code Snippet
***/
	
class SendMail{
	
	private $_mail;
	
	function __construct($mail){
		
		$this->_mail = $mail;
	}
	
	public function send($recipient, $fromEmail, $fromName, $message, $subject, $attachments = array()) {
		
	  $this->_mail->isSMTP(); # Set mailer to use SMTP
	  $this->_mail->Host = SMTP_HOST; # Specify main and backup SMTP servers
      $this->_mail->SMTPDebug = 0;
	  $this->_mail->SMTPAuth = true; # Enable SMTP authentication
	  $this->_mail->Username = SMTP_USER; # SMTP username
	  $this->_mail->Password = SMTP_PASS; # SMTP password
	  $this->_mail->SMTPSecure = SMTP_SECURITY; # Enable TLS encryption
	  $this->_mail->Port = SMTP_PORT; # TCP port to connect to
	  $this->_mail->IsHTML(true);
	  $this->_mail->CharSet = 'UTF-8';
	  $this->_mail->From = $fromEmail;
	  $this->_mail->FromName = $fromName;
	  $this->_mail->Subject = $subject;
	  $this->_mail->Body = $message;
	  
	  if(count($attachments) > 0){
	      foreach($attachments as $attachment) {
	          $this->_mail->AddAttachment($attachment['file'], $attachment['name']);
	       }
	  }
	  
	  $this->_mail->addAddress($recipient);
	  
      try {
          if(!empty($recipient)){
          	return $this->_mail->send();
          }else{
          	return false;
          }
      } catch (Exception $e) {
		  echo $e;
          return false;
      }
	  
	}
	
}
?>