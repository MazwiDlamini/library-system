<?php

session_start();
include "../includes/config.php";

$message="";

if(isset($_POST['change'])){

$email=$_POST['email'];
$code=$_POST['code'];
$newpass=$_POST['password'];

$result=mysqli_query($conn,"SELECT * FROM users 
WHERE email='$email' AND reset_code='$code'");

if(mysqli_num_rows($result)>0){

mysqli_query($conn,"UPDATE users 
SET password='$newpass', reset_code=NULL, reset_expiry=NULL 
WHERE email='$email'");

$message="Password changed successfully.";

}else{

$message="Invalid code.";

}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Reset Password</title>

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

<h2>Reset Password</h2>

<?php if($message!=""){ echo "<p>$message</p>"; } ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="code" placeholder="Reset Code" required>

<input type="password" name="password" placeholder="New Password" required>

<button name="change">Change Password</button>

</form>

</div>

</body>

</html>