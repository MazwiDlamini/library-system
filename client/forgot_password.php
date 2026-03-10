<?php

session_start();

include "../includes/config.php";
include "../includes/mailer.php";

$message="";

if(isset($_POST['reset'])){

$email=$_POST['email'];

$code=rand(100000,999999);

$expiry=date("Y-m-d H:i:s",strtotime("+15 minutes"));

mysqli_query($conn,"UPDATE users 
SET reset_code='$code', reset_expiry='$expiry' 
WHERE email='$email'");

if(sendResetEmail($email,$code)){

$message="Reset code sent to your email.";

}else{

$message="Email sending failed.";

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Forgot Password</title>

<style>

body{
font-family:Arial;
background:linear-gradient(135deg,#1e3a8a,#0ea5e9);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
color:white;
}

.box{
background:#0f172a;
padding:40px;
border-radius:10px;
width:350px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:6px;
}

button{
width:100%;
padding:10px;
background:#22c55e;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#16a34a;
}

</style>

</head>

<body>

<div class="box">

<h2>Forgot Password</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="email" name="email" placeholder="Enter your email" required>

<button name="reset">Send Reset Code</button>

</form>

<br>

<a href="reset_password.php">I have a reset code</a>

<br><br>

<a href="index.php">⬅ Back</a>

</div>

</body>

</html>