<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHPMailer - GMail SMTP test</title>
</head>
<body>
<?php
require("class.phpmailer.php");
require("class.smtp.php");
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "rathnarajus96@gmail.com";
$mail->Password = "rathnaraju123";
$mail->SetFrom("rathnarajus96@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("rathnarajus96@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
?>
</body>
</html>