<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function sendResetEmail($toEmail,$code){

$mail = new PHPMailer(true);

try{

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->Username = 'mazwinkhocy@gmail.com';  
$mail->Password = 'ofkwbwhekpjnpjce';    

$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('yourgmail@gmail.com','Manzini Public Library');
$mail->SMTPDebug = 2;  // 0=off, 2=client+server debug output
$mail->Debugoutput = 'html';
$mail->addAddress($toEmail);

$mail->isHTML(true);

$mail->Subject = 'Library Password Reset';

$mail->Body = "
<h2>Password Reset Request</h2>

<p>Your password reset code is:</p>

<h1>$code</h1>

<p>This code expires in 15 minutes.</p>

<p>Manzini Public Library System</p>
";

$mail->send();

return true;

}catch(Exception $e){

return false;

}

}