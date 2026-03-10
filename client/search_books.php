<?php

include "../includes/config.php";
include "../includes/functions.php";

requireLogin();

/* search keyword */
$search = "";

if(isset($_GET['search'])){
    $search = esc($_GET['search']);
}

$sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR authors LIKE '%$search%'";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Search Books</title>

<style>

body{
font-family:Arial;
background:#0f172a;
color:white;
margin:0;
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

input{
padding:10px;
width:300px;
border-radius:6px;
border:none;
}

button{
padding:8px 14px;
background:#22c55e;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

.book{
background:#1e293b;
padding:20px;
margin-top:20px;
border-radius:10px;
display:flex;
gap:20px;
align-items:center;
}

img{
width:80px;
border-radius:6px;
}

.reserve{
background:#3b82f6;
padding:8px 12px;
border-radius:6px;
text-decoration:none;
color:white;
margin-right:10px;
}

.favorite{
background:#f59e0b;
padding:8px 12px;
border:none;
border-radius:6px;
color:white;
cursor:pointer;
}

</style>

</head>

<body>

<div class="header">

<h3>🔎 Search Books</h3>

<a href="javascript:history.back()" class="back-btn">⬅ Back</a>

</div>

<div class="container">

<form method="GET">

<input type="text" name="search" placeholder="Search by title or author" value="<?php echo $search; ?>">

<button type="submit">Search</button>

</form>

<?php

if(mysqli_num_rows($result) == 0){
echo "<p>No books found.</p>";
}

while($book = mysqli_fetch_assoc($result)){

?>

<div class="book">

<img src="../assets/images/<?php echo $book['cover_image']; ?>">

<div>

<h3><?php echo $book['title']; ?></h3>

<p>Author: <?php echo $book['authors']; ?></p>

<p>Category: <?php echo $book['category']; ?></p>

<p>
Status:
<?php
if($book['available'] > 0){
echo "Available";
}else{
echo "Not Available";
}
?>
</p>

<a class="reserve" href="reserve_book.php?book_id=<?php echo $book['id']; ?>">
Reserve
</a>

<form method="POST" action="add_favorite.php" style="display:inline;">
<input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
<button class="favorite">⭐ Favorite</button>
</form>

</div>

</div>

<?php } ?>

</div>

</body>

</html>