<?php
session_start();
require_once("../includes/db.php");

$error="";
$success="";

if(isset($_POST['register'])){

$name=trim($_POST['name']);
$physical=trim($_POST['physical_address']);
$postal=trim($_POST['postal_address']);
$chief=trim($_POST['chief_code']);
$phone=trim($_POST['phone']);
$email=trim($_POST['email']);
$password=$_POST['password'];

if(!preg_match("/^[a-zA-Z ]+$/",$name)){
$error="Name must contain letters only";
}

elseif(!preg_match("/^[0-9]{8,15}$/",$phone)){
$error="Phone must contain numbers only";
}

elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$error="Invalid email address";
}

else{

$check=mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0){
$error="Email already registered";
}

else{

$hash=password_hash($password,PASSWORD_DEFAULT);

mysqli_query($conn,"
INSERT INTO users
(name,physical_address,postal_address,chief_code,phone,email,password)
VALUES
('$name','$physical','$postal','$chief','$phone','$email','$hash')
");

$success="Registration successful. You can login now.";

}

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<style>

body{
font-family:Arial;
background:#0f172a;
color:white;
}

.container{
width:450px;
margin:auto;
margin-top:60px;
background:#1e293b;
padding:30px;
border-radius:10px;
}

input{
width:100%;
padding:10px;
margin-bottom:10px;
border-radius:6px;
border:none;
}

button{
padding:10px;
background:#22c55e;
border:none;
color:white;
width:100%;
border-radius:6px;
}

.error{color:#ef4444}
.success{color:#22c55e}

</style>
</head>

<body>

<div class="container">

<h2>Client Registration</h2>

<?php if($error!="") echo "<p class='error'>$error</p>"; ?>
<?php if($success!="") echo "<p class='success'>$success</p>"; ?>

<form method="POST">

<input name="name" placeholder="Full Name" required>

<input name="physical_address" placeholder="Physical Address" required>

<input name="postal_address" placeholder="Postal Address">

<input name="chief_code" placeholder="Chief Code">

<input name="phone" placeholder="Phone Number" required>

<input name="email" type="email" placeholder="Email Address" required>

<input name="password" type="password" placeholder="Password" required>

<button name="register">Register</button>

</form>

</div>

</body>
</html>