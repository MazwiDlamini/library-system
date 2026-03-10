<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#1e3a8a">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manzini Public Library</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0f172a;
color:white;
transition:0.3s;
}

header{
background:#1e293b;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
}

header h2{
margin:0;
}

nav a{
color:white;
margin-left:20px;
text-decoration:none;
}

nav a:hover{
color:#38bdf8;
}

.hero{
display:flex;
height:80vh;
}

.hero-left{
flex:1;
display:flex;
justify-content:center;
align-items:center;
background:black;
}

.hero-left img{
width:90%;
border-radius:10px;
}

.hero-right{
flex:1;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
text-align:center;
}

.buttons button{
padding:12px 20px;
margin:10px;
border:none;
border-radius:6px;
cursor:pointer;
}

.client-btn{
background:#2563eb;
color:white;
}

.admin-btn{
background:#16a34a;
color:white;
}

.modal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.7);
justify-content:center;
align-items:center;
}

.modal-content{
background:white;
color:black;
padding:30px;
border-radius:10px;
width:350px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

.login-btn{
background:#1e293b;
color:white;
border:none;
padding:10px;
width:100%;
}

.settings{
cursor:pointer;
font-size:22px;
}

.social a{
color:white;
margin:10px;
text-decoration:none;
}

footer{
text-align:center;
padding:20px;
border-top:1px solid #334155;
}

.highcontrast{
background:black;
color:yellow;
}

</style>

</head>

<body>

<header>

<h2>📚 Manzini Public Library</h2>

<nav>

<a href="about.php">About</a>

<a href="hours.php">Hours</a>

<a href="location.php">Location</a>

<span class="settings" onclick="openSettings()">⚙</span>

</nav>

</header>


<div class="hero">

<div class="hero-left">

<img src="../assets/manzini_library.jpg" alt="Manzini Public Library">

</div>

<div class="hero-right">

<h1>Welcome to Manzini Public Library</h1>

<p>Access books, learning resources and digital resources.</p>

<div class="buttons">

<button class="client-btn" onclick="openClient()">Client Login</button>

<button class="admin-btn" onclick="openAdmin()">Admin Login</button>

</div>

<div class="social">

<a href="https://facebook.com" target="_blank">Facebook</a>

<a href="https://instagram.com" target="_blank">Instagram</a>

</div>

</div>

</div>


<!-- CLIENT LOGIN -->

<div class="modal" id="clientModal">

<div class="modal-content">

<h2>Client Login</h2>

<form method="POST" action="login.php">

<input type="hidden" name="role" value="client">

<input type="text" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button class="login-btn">Login</button>

</form>

<p>
<a href="register.php">Register</a> |
<a href="forgot_password.php">Forgot Password?</a>
</p>

</div>

</div>


<!-- ADMIN LOGIN -->

<div class="modal" id="adminModal">

<div class="modal-content">

<h2>Admin Login</h2>

<form method="POST" action="login.php">

<input type="hidden" name="role" value="admin">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button class="login-btn">Login</button>

</form>

</div>

</div>


<!-- SETTINGS -->

<div class="modal" id="settingsModal">

<div class="modal-content">

<h2>Settings</h2>

<h3>Accessibility</h3>

<label>Font Size</label>

<select onchange="changeFont(this.value)">
<option>Small</option>
<option>Medium</option>
<option>Large</option>
</select>

<br><br>

<label>High Contrast</label>

<input type="checkbox" onclick="toggleContrast()">

<h3>Language</h3>

<select>
<option>English</option>
<option>siSwati</option>
</select>

</div>

</div>


<footer>

Manzini Library System © 2026

</footer>


<script>

function openClient(){
document.getElementById("clientModal").style.display="flex";
}

function openAdmin(){
document.getElementById("adminModal").style.display="flex";
}

function openSettings(){
document.getElementById("settingsModal").style.display="flex";
}

window.onclick=function(e){

if(e.target.className=="modal"){
e.target.style.display="none";
}

}

function changeFont(size){

if(size=="Small"){document.body.style.fontSize="14px";}

if(size=="Medium"){document.body.style.fontSize="18px";}

if(size=="Large"){document.body.style.fontSize="22px";}

}

function toggleContrast(){

document.body.classList.toggle("highcontrast");

}

</script>
<script>
if ('serviceWorker' in navigator) {
navigator.serviceWorker.register('/service-worker.js');
}
</script>
</body>

</html>