<?php
/*
name="name"
name="email"
name="phone"
name="subject"
name="message"
*/

if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name          = $_POST['name'];
$visitor_email = $_POST['email'];
$phone         = $_POST['phone'];
$subject       = $_POST['subject'];
$message       = $_POST['message'];

//below are "up front" variables, so no need to hunt for them in the below code
//this is a convenience step
//also, each email address listed within each set of double quotes must be separated 
//by a comma and trailing space
//example:  "abc@yahoo.com, nobody@microsoft.com, jill@example.com"

//this is the main receiver of the message
$main_email_recepient = "cinemason@cinemasonproductions.cognosislabs.com"; 

//any other accounts that need to receive the message and are allowed to be visible
$CC_email_recepient   = "cinemason@yahoo.com"; 

//any other accounts that need to receive the message, but need to be hidden
$BCC_email_recepient  = "ninja@ninja.com, samurai@samurai.com"; 

//end of "up front" variables

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($name))
{
    echo "Bad name value!";
    exit;
}
if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}
if(IsInjected($phone))
{
    echo "Bad phone value!";
    exit;
}
if(IsInjected($subject))
{
    echo "Bad subject value!";
    exit;
}

//not sure why this is throwing an error??
/*
if(IsInjected($message))
{
    echo "Bad message value!";
    exit;
}
*/

$to            = $main_email_recepient; 

$email_from    = $visitor_email;

$email_subject = $subject;

$email_body    = "You have received a new message from the user " . $name;
$email_body   .= "\r\n" . "User's Phone Number:" . $phone;
$email_body   .= "\r\n" . "User's Email Address:" . $email_from;
$email_body   .= "\r\n\r\n" . "Here is the message:" . "\r\n" . $message;

$headers       = "From: "     . $email_from         . "\r\n";
$headers      .= "Reply-To: " . $email_from         . "\r\n";
$headers      .= "Cc: "       . $CC_email_recepient . "\r\n";

//un comment the below line to include BCCs / Blind carbon copies
//$headers      .= "Bcc: " . $BCC_email_recepient . " \r\n";

//Send the email!

try { 
	mail($to, $email_subject, $email_body, $headers);
} catch (Exception $e) { 
	echo "Mail function went bad!\r\n"; 
	echo "Error Message: ",  $e->getMessage(), "\n";
	exit; 
}

//done. redirect to thank-you page.
header('Location: cinemason-thanks.html');

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 