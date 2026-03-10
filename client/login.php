<?php
session_start();
include "../includes/config.php";

/* CLIENT LOGIN */

if(isset($_POST['role']) && $_POST['role']=="client"){

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($query) == 1){

$user = mysqli_fetch_assoc($query);

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];

header("Location: dashboard.php");
exit();

}else{

echo "Wrong password";

}

}else{

echo "User not found";

}

}


/* ADMIN LOGIN */

if(isset($_POST['role']) && $_POST['role']=="admin"){

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "admin" && $password == "1234"){

$_SESSION['admin_logged_in'] = true;

header("Location: ../admin/dashboard.php");
exit();

}else{

echo "Invalid admin login";

}

}
?>