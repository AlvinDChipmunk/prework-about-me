<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}

/*
name="sName"
name="sEmail"
name="sPhone"
name="sSubject"
name="sMessage"
*/

/*
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
*/

$sName    = $_POST['sName'];
$sEmail   = $_POST['sEmail'];
$sPhone   = $_POST['sPhone'];
$sSubject = $_POST['sSubject'];
$sMessage = $_POST['sMessage'];

/*
$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

or:

$age['Peter'] = "35";
$age['Ben'] = "37";
$age['Joe'] = "43";

$incomingData['sName']    = $sName;
$incomingData['sEmail']   = $sEmail;
$incomingData['sPhone']   = $sPhone;
$incomingData['sSubject'] = $sSubject;
$incomingData['sMessage'] = $sMessage;

*/

$incomingData['Name']    = $sName;
$incomingData['Email']   = $sEmail;
$incomingData['Phone']   = $sPhone;
$incomingData['Subject'] = $sSubject;
$incomingData['Message'] = $sMessage;

/*

$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

foreach($age as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}

*/

$isEmptyData['Name']       = true;
$isEmptyData['Email']      = true;
$isEmptyData['Phone']      = true;
$isEmptyData['Subject']    = true;
$isEmptyData['Message']    = true;

$isInjectedData['Name']    = true;
$isInjectedData['Email']   = true;
$isInjectedData['Phone']   = true;
$isInjectedData['Subject'] = true;
$isInjectedData['Message'] = true;

$countFalseEmptyValues    = 0; 
$countFalseInjectedValues = 0; 

//Validate first
/* 
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}
*/

// Validation:  1 - checklist for first empty data then injected data, including counting errors 
foreach($incomingData as $valueName => $actualValue) { 
	if(!empty($actualValue)) { 
		$isEmptyData[$valueName] = false;
		$countFalseEmptyValues ++; 
	}
	
	if !(IsInjected($actualValue)) {
		$isInjectedData[$valueName] = false; 
		$countFalseInjectedValues ++; 
	}
}

// Validation: 2 - Generate error message for missing data items 
$missingDataItems = "Your form is missing the following information: \r\n"; 

foreach($isEmptyData as $valueName => $actualValue) { 
	if($actualValue == true) { 
		$missingDataItems .= " - "
		$missingDataItems .= $valueName;
		$missingDataItems .= "/r/n"; 
	}
}

// Validation: 2 - if no empty data value errors then clear out error message 
if ($countFalseEmptyValues == 0) { 
	$missingDataItems = ""; // clears out error message for empty data values 
}

// Validation: 3 - Generate error message for invalid or otherwise "injected" data items 
$injectedDataItems = "Your form contains invalid information in the following locations: \r\n"; 

foreach($isInjectedData as $valueName => $actualValue) { 
	if($actualValue == true) { 
		$missingDataItems .= " - "
		$missingDataItems .= $valueName;
		$missingDataItems .= "/r/n"; 
	}
}

// Validation: 3 - if no injected data value errors then clear out error message 
if ($countFalseInjectedValues == 0) { 
	$injectedDataItems = ""; // clears out error message for empty data values 
}

$totalErrorMessages  = $missingDataItems; 
$totalErrorMessages .= "\r\n\r\n"; 
$totalErrorMessages .= $injectedDataItems; 

// Validation: 4 - Get total count of errors of both types, empty and injection attacks 
$totalCounts = $countFalseEmptyValues + $countFalseInjectedValues; 

// Error displaying - if there are at least one error, print out error message then exit 
if ($totalCounts != 0) {
	echo $totalErrorMessages; 
	exit;
}

/* 
Now that we bypassed exiting early due to errors, we can now formally process and 
deliver email messages 
*/

/*
$incomingData['sName']    = $sName;
$incomingData['sEmail']   = $sEmail;
$incomingData['sPhone']   = $sPhone;
$incomingData['sSubject'] = $sSubject;
$incomingData['sMessage'] = $sMessage;
*/

$email_from     = $incomingData['sEmail'];
$email_to       = "cinemason@yahoo.com";

$email_subject  = "Cinemason web form feedback - ";
$email_subject .= $incomingData['sSubject'];

$email_body     = "You have received a new message from the user: "; 
$email_body    .= $incomingData['sName'];
$email_body    .= "\r\n\r\n"; 

$email_body    .= $incomingData['sName'];
$email_body    .= "'s E-Mail Address: "; 
$email_body    .= $incomingData['sEmail'];
$email_body    .= "\r\n\r\n"; 

$email_body    .= $incomingData['sName'];
$email_body    .= "'s Phone Numer: "; 
$email_body    .= $incomingData['sPhone'];
$email_body    .= "\r\n\r\n"; 

$email_body    .= "Here is the message:\r\n\r\n"; 
$email_body    .= $incomingData['sMessage']; 
    
$headers = "From: "; 
$headers .= $email_from;
$headers .= "\r\n";
$headers .= "Reply-To: ";
$headers .= $email_from;
$headers .= "\r\n";
$headers .= "Cc: alvinrevilas@yahoo.com";

//Send the email!
mail($email_to, $email_subject, $email_body, $headers);

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