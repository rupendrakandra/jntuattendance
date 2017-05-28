<?php
//Functin to Send Test Email
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