# How to Send an Email in PHP (OOP)

Here you will be creating OOP PHP Scripts for sending emails so that you can easily send emails throughout your project.

Create your `config.php` file this will store the credentials of your SMTP Server.
You just need to create a constant variable for SMTP Credentials. Which consist of the following:

- SMTP_HOST — this is usually the domain name of the server using the prefix smtp. Ex. smtp.gmail.com, smtp.example.com
- SMTP_USER — this is usually the email account.
- SMTP_PASS — this is usually the email account password
- SMTP_SECURITY — this can be SSL or TLS both are security protocols that can be used by - SMTP servers. SSL came after TLS.
- SMTP_PORT — this depends on the SMTP Server you are using every server can use a different port. Commonly they used 587, 25.

```
<?php
define("SMTP_HOST", "smtp.gmail.com");
define("SMTP_USER", "<your gmail account>");
define("SMTP_PASS", "<your gmail account password>");
define("SMTP_SECURITY", "tls");
define("SMTP_PORT", "587");
?>
```
Create `index.php`, this will be your main file where you will send your email.
We need to include your `config.php` on the `index.php` so that, you could access the constant variable you created for SMTP Credentials.

```
include 'config.php';
```
After that, you need to include the packages of PHPMailer Library.
```
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
```
Then initialized the PHPMailer Object.
```
//Create an instance; passing `true` enables exceptions
$phpMailer = new PHPMailer(true);
```
Create your class file for Send Mail. Just name it sendMail.php.
```
<?php
 
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
```
Once you have set up your SendMail class, go back to your `index.php` file.

Include and initialized your SendMail class, and pass the $phpMailer object to your SendMail class.

```
include 'sendMail.php';
	
$sendMail = new SendMail($phpMailer);
```

### Sending Email
Using your index.php file, you can now try sending emails.

```
//initialize data
$recipient = 'myMail@gmail.com';
$fromEmail = 'noreply@example.com';
$fromName = 'Example Company';
$message = 'Hello, <br> 
This is your email send thru PHP.';
$subject = 'Your PHP Mail';
$sendMail->send($recipient, $fromEmail, $fromName, $message, $subject);
```
