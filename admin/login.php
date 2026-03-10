<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../includes/config.php";

$error = "";

/* if already logged in */
if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "1234"){

        $_SESSION['admin'] = true;

        header("Location: dashboard.php");
        exit();

    }else{

        $error = "Invalid admin login";

    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<style>

body{
font-family:Arial;
background:#0f172a;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:#1e293b;
padding:40px;
border-radius:10px;
width:300px;
text-align:center;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:6px;
}

button{
padding:10px;
width:100%;
background:#22c55e;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#16a34a;
}

.error{
color:red;
}

</style>

</head>

<body>

<div class="box">

<h2>Admin Login</h2>

<?php if($error!=""){ echo "<p class='error'>$error</p>"; } ?>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>