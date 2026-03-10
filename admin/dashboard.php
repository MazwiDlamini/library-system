<?php
session_start();

if(!isset($_SESSION['admin_logged_in'])){
header("Location: ../client/index.php");
exit();
}

include "../includes/config.php";
include "../includes/functions.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#1e3a8a,#0ea5e9);
color:white;
transition:0.3s;
}

/* HEADER */

header{
background:#0f172a;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
border-bottom:2px solid #1e40af;
}

h2{
margin:0;
}

/* BUTTON */

button{
padding:10px 15px;
border:none;
cursor:pointer;
border-radius:6px;
background:#2563eb;
color:white;
}

button:hover{
background:#1d4ed8;
}

/* CONTAINER */

.container{
padding:40px;
}

/* BANNER */

.banner{
width:100%;
height:220px;
background:#1e293b;
border-radius:12px;
display:flex;
align-items:center;
justify-content:center;
margin-bottom:30px;
border:2px dashed #60a5fa;
}

.banner p{
opacity:0.7;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
}

/* CARDS */

.card{
background:#0f172a;
padding:30px;
border-radius:12px;
text-align:center;
transition:0.3s;
border:1px solid #1e40af;
cursor:pointer;
}

.card:hover{
transform:scale(1.05);
background:#1e293b;
box-shadow:0 0 20px rgba(0,0,0,0.6);
}

.icon{
font-size:40px;
margin-bottom:15px;
}

a{
text-decoration:none;
color:white;
}

/* DARK MODE */

.darkmode{
background:#f1f5f9;
color:black;
}

.darkmode header{
background:#e2e8f0;
color:black;
}

.darkmode .card{
background:white;
color:black;
}

</style>

<script>

function toggleDark(){
document.body.classList.toggle("darkmode");
}

</script>

</head>

<body>

<header>

<h2>📚 Library Admin</h2>

<div>
<button onclick="toggleDark()">🌙 Dark Mode</button>
<a href="../client/logout.php"><button>Logout</button></a>
</div>

</header>

<div class="container">

<!-- IMAGE SPACE -->

<div class="banner">

<p>Place Library Banner Image Here</p>

</div>

<div class="grid">

<a href="manage_books.php">
<div class="card">
<div class="icon">📚</div>
<h3>Manage Books</h3>
</div>
</a>

<a href="manage_users.php">
<div class="card">
<div class="icon">👥</div>
<h3>Manage Users</h3>
</div>
</a>

<a href="reservations.php">
<div class="card">
<div class="icon">📖</div>
<h3>Reservations</h3>
</div>
</a>

<a href="borrowings.php">
<div class="card">
<div class="icon">📜</div>
<h3>Borrowings</h3>
</div>
</a>

<a href="reports.php">
<div class="card">
<div class="icon">📊</div>
<h3>Reports</h3>
</div>
</a>

</div>

</div>

</body>
</html>