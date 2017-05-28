<?php
//
// This function was originally a part of phpBB2 (http://www.phpbb.com).
//
function smtp_mail($to, $subject, $message, $headers = '')
{
    $recipients = explode(',', $to);
    $user = 'bhashahussain@gmail.com';
    $pass = 'hussain@72999';
    // The server details that worked for you in the above step
    $smtp_host = 'ssl://smtp.gmail.com';
    //The port that worked for you in the above step
    $smtp_port = 465;
 
    if (!($socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 15)))
    {
      echo "Error connecting to '$smtp_host' ($errno) ($errstr)";
    }
 
    server_parse($socket, '220');
 
    fwrite($socket, 'EHLO '.$smtp_host."\r\n");
    server_parse($socket, '250');
 
    fwrite($socket, 'AUTH LOGIN'."\r\n");
    server_parse($socket, '334');
 
    fwrite($socket, base64_encode($user)."\r\n");
    server_parse($socket, '334');
 
    fwrite($socket, base64_encode($pass)."\r\n");
    server_parse($socket, '235');
 
    fwrite($socket, 'MAIL FROM: <'.$user.'>'."\r\n");
    server_parse($socket, '250');
 
    foreach ($recipients as $email)
    {
        fwrite($socket, 'RCPT TO: <'.$email.'>'."\r\n");
        server_parse($socket, '250');
    }
 
    fwrite($socket, 'DATA'."\r\n");
    server_parse($socket, '354');
 
    fwrite($socket, 'Subject: '
      .$subject."\r\n".'To: <'.implode('>, <', $recipients).'>'
      ."\r\n".$headers."\r\n\r\n".$message."\r\n");
 
    fwrite($socket, '.'."\r\n");
    server_parse($socket, '250');
 
    fwrite($socket, 'QUIT'."\r\n");
    fclose($socket);
 
    return true;
}
 
//Functin to Processes Server Response Codes
function server_parse($socket, $expected_response)
{
    $server_response = '';
    while (substr($server_response, 3, 1) != ' ')
    {
        if (!($server_response = fgets($socket, 256)))
        {
          echo 'Error while fetching server response codes.', __FILE__, __LINE__;
        }            
    }
 
    if (!(substr($server_response, 0, 3) == $expected_response))
    {
      echo 'Unable to send e-mail."'.$server_response.'"', __FILE__, __LINE__;
    }
}

function send_test_email()
{
  if(smtp_mail('bhashahussain@gmail.com', 'Test Mail Subject', 'Test email subject.'))
  {
    echo "Email Sent Successfully.";
  }
    
  else
  {
    echo "Oops! Error Sending Email.";
  }
}

send_test_email();

?>