<?php
session_start();

$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Email is Invalid.');history.back();</script>";
   	exit;
}
require 'class.smtp.php';
require 'class.phpmailer.php';
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'weshootbabiesph@gmail.com';          // SMTP username
$mail->Password = 'weshootbabies1234'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom($email, $name);
$mail->addReplyTo($email, $name);
$mail->addAddress('weshootbabiesph@gmail.com');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
    body {
      font-family: sans-serif;
    }
    .con {
      padding: 10%;
      padding-top: 0;
      padding-bottom: 0;
      text-align: center;
    }
    a {
      text-decoration: none;
      color: black;
    }
    .header {
      padding-left: 10%;
      padding-right: 10%;
      padding-top: 1%;
      padding-bottom: 1%;
      margin-left: 20%;
      margin-right: 20%;
      text-align: center;
      background-color: rgba(222, 210, 210, 0.8);
      color: #ffebb6;
    }
    .details {
      padding-left: 3%;
      padding-top: 1%;
      padding-bottom: 1%;
      margin-left: 20%;
      margin-right: 20%;
      text-align: left;
      background-color: #ebebeb;
    }
    .announ {
      padding-left: 30px;
      padding-right: 30px;
      padding-top: 15px;
      padding-bottom: 15px;
      background-color: #dc0013;
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="con">
    <div class="header">
      <h1>WeShootBabiesPH Staff Leave Request</h1>
    </div>
    <br/><br/><h3>Hello, Admin!</h3>
    <p>Your employee, '.$name.', has sent a leave request.</p><br/>
    <div class="details">
      <p><b>Leave Request Details</b></p>
      <br><br>
      <p><b>Name: </b> '.$name.'</p>
      <br>
      <p><b>Email Address: </b> '.$email.'</p>
      <br>
      <p><b>Subject: </b> '.$subject.'</p>
      <p><b>Message: </b> '.$message.'</p>
    </div>
</body>
</html>

';

$mail->Subject = 'Leave Request';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo"<script>window.alert('Your leave request is sent! Admin will get back to you as soon as possible. Thank you catching up! :)');</script>";
	echo"<script>location.href='homeEmp.php';</script>";
}
?>
