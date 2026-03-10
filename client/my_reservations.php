<?php

include "../includes/config.php";
include "../includes/functions.php";

requireLogin();

$user_id = $_SESSION['user_id'];

/* GET USER RESERVATIONS */
$reservations = mysqli_query($conn,"
SELECT r.*, b.title, b.authors, b.cover_image
FROM reservations r
JOIN books b ON r.book_id = b.id
WHERE r.user_id = '$user_id'
ORDER BY r.reserve_date DESC
");

?>

<!DOCTYPE html>
<html>

<head>

<title>My Reservations</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0f172a;
color:white;
}

.container{
padding:40px;
}

.book{
background:#1e293b;
padding:20px;
margin-bottom:20px;
border-radius:10px;
display:flex;
gap:20px;
align-items:center;
}

img{
width:80px;
border-radius:6px;
}

.status{
padding:5px 10px;
border-radius:6px;
background:#334155;
}

</style>

</head>

<body>

<div class="container">

<h2>📖 My Reservations</h2>

<?php

if(mysqli_num_rows($reservations) == 0){
echo "<p>No reservations yet.</p>";
}

while($row = mysqli_fetch_assoc($reservations)){

?>

<div class="book">

<img src="../assets/images/<?php echo $row['cover_image']; ?>">

<div>

<h3><?php echo $row['title']; ?></h3>

<p>Author: <?php echo $row['authors']; ?></p>

<p>Reserved on: <?php echo $row['reserve_date']; ?></p>

<p class="status">
Status: <?php echo $row['status']; ?>
</p>

</div>

</div>

<?php } ?>

</div>

</body>

</html>