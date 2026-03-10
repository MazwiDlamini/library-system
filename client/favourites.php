<?php

include "../includes/config.php";
include "../includes/functions.php";

requireLogin();

$user_id = $_SESSION['user_id'];

$favorites = mysqli_query($conn,"
SELECT f.*, b.title, b.authors, b.cover_image, b.category
FROM favorites f
JOIN books b ON f.book_id = b.id
WHERE f.user_id='$user_id'
ORDER BY f.created_at DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Favorite Books</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0f172a;
color:white;
}

.header{
background:#1e293b;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

.back-btn{
background:#334155;
color:white;
padding:8px 16px;
border-radius:6px;
text-decoration:none;
}

.container{
padding:40px;
}

.book{
background:#1e293b;
padding:20px;
border-radius:10px;
margin-bottom:20px;
display:flex;
gap:20px;
align-items:center;
}

.book img{
width:90px;
border-radius:6px;
}

.remove{
background:#ef4444;
border:none;
color:white;
padding:6px 12px;
border-radius:6px;
cursor:pointer;
}

.empty{
background:#1e293b;
padding:20px;
border-radius:8px;
text-align:center;
}

</style>

</head>

<body>

<div class="header">

<h3>⭐ Favorite Books</h3>

<a href="javascript:history.back()" class="back-btn">⬅ Back</a>

</div>

<div class="container">

<?php

if(mysqli_num_rows($favorites)==0){

echo "<div class='empty'>You have no favorite books yet.</div>";

}

while($row=mysqli_fetch_assoc($favorites)){

?>

<div class="book">

<img src="../assets/images/<?php echo $row['cover_image']; ?>">

<div>

<h3><?php echo $row['title']; ?></h3>

<p>Author: <?php echo $row['authors']; ?></p>

<p>Category: <?php echo $row['category']; ?></p>

<form method="POST" action="remove_favorite.php">

<input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">

<button class="remove">Remove</button>

</form>

</div>

</div>

<?php } ?>

</div>

</body>
</html>