<?php
session_start();
include "../includes/functions.php";

if(!isset($_SESSION['user_id'])){
header("Location: index.php");
exit();
}

$user = getUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<title>Manzini Library Dashboard</title>

<style>

body{
margin:0;
font-family:Arial, sans-serif;
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

h1{margin:0;}

button{
padding:10px 15px;
border:none;
cursor:pointer;
border-radius:6px;
margin-left:10px;
background:#2563eb;
color:white;
}

button:hover{
background:#1d4ed8;
}

/* MAIN CONTAINER */

.container{
padding:40px;
}

/* IMAGE SPACE */

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

/* CARD */

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

/* FOOTER */

footer{
text-align:center;
padding:20px;
border-top:1px solid #1e40af;
margin-top:40px;
background:#0f172a;
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

<div>
<h1>📚 Manzini Library System</h1>
</div>

<div>
<button onclick="toggleDark()">🌙 Dark Mode</button>
<a href="logout.php"><button>Logout</button></a>
</div>

</header>

<div class="container">

<h2>Welcome, <?php echo $user['name']; ?></h2>
<p>Email: <?php echo $user['email']; ?></p>
<p>Library Branch: Manzini</p>

<br>

<!-- IMAGE SPACE -->

<div class="banner">

<p>Place Library Image Here</p>

</div>

<div class="grid">

<a href="search_books.php">
<div class="card">
<div class="icon">🔎</div>
<h3>Search Books</h3>
</div>
</a>

<a href="my_reservations.php">
<div class="card">
<div class="icon">📖</div>
<h3>My Reservations</h3>
</div>
</a>

<a href="borrow_history.php">
<div class="card">
<div class="icon">📜</div>
<h3>Borrow History</h3>
</div>
</a>

<a href="favourites.php">
<div class="card">
<div class="icon">⭐</div>
<h3>Favourite Books</h3>
</div>
</a>

<a href="rate_books.php">
<div class="card">
<div class="icon">👍</div>
<h3>Rate Books</h3>
</div>
</a>

<a href="notifications.php">
<div class="card">
<div class="icon">🔔</div>
<h3>Notifications</h3>
</div>
</a>

</div>

</div>

<footer>

Manzini Library System © 2026

</footer>

</body>
</html>