<?php
$to = 'paul@delightadventures.co.ke';
$subject = 'Message from Website';
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message']; 

//Validate first
if(empty($name)||empty($visitor_email)||empty($phone)) 
{
    echo "Name, email and phone are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = "site@saferiders.co.ke";
$message_body = "Message: ". $message;
$headers = "From: $email_from \r\n";
$headers = "Phone: $phone \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
$headers .= "Cc: faith@saferiders.co.ke \r\n";

// Sending email
if(mail($to, $subject, $message_body, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}

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