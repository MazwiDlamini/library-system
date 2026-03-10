<?php

include "../includes/config.php";
include "../includes/functions.php";

adminLoggedIn();

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0f172a;
color:white;
}

header{
background:#1e293b;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.container{
padding:40px;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
}

.card{
background:#1e293b;
padding:30px;
border-radius:12px;
text-align:center;
transition:0.3s;
cursor:pointer;
}

.card:hover{
transform:scale(1.05);
background:#334155;
}

a{
text-decoration:none;
color:white;
}

</style>

</head>

<body>

<header>

<h2>📚 Library Admin Panel</h2>

<a href="logout.php">Logout</a>

</header>

<div class="container">

<h1>Welcome Admin</h1>

<div class="grid">

<a href="manage_books.php">
<div class="card">📚 Manage Books</div>
</a>

<a href="manage_users.php">
<div class="card">👥 Manage Users</div>
</a>

<a href="reservations.php">
<div class="card">📖 Reservations</div>
</a>

<a href="borrowings.php">
<div class="card">📜 Borrowings</div>
</a>

<a href="reports.php">
<div class="card">📊 Reports</div>
</a>

</div>

</div>

</body>
</html>