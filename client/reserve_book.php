<?php
session_start();
require_once(__DIR__ . "/../includes/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$user_id = $_SESSION['user_id'];

if(!isset($_GET['book_id'])){
echo "Invalid book.";
exit();
}

$book_id = intval($_GET['book_id']);

$query = "
SELECT *
FROM books
WHERE id = '$book_id'
";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) == 0){
echo "Book not found.";
exit();
}

$book = mysqli_fetch_assoc($result);

$message = "";

if(isset($_POST['reserve'])){

$check = mysqli_query($conn,"
SELECT * FROM reservations
WHERE user_id='$user_id'
AND book_id='$book_id'
");

if(mysqli_num_rows($check) > 0){

$message = "You already reserved this book.";

}else{

$due_date = date("Y-m-d", strtotime("+7 days"));

mysqli_query($conn,"
INSERT INTO reservations (user_id,book_id,due_date)
VALUES ('$user_id','$book_id','$due_date')
");

$message = "Book reserved successfully. Due date: ".$due_date;

}

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Reserve Book</title>

<style>

body{
font-family:Arial;
background:#0f172a;
color:white;
margin:0;
}

.container{
padding:40px;
}

.book{
background:#1e293b;
padding:25px;
border-radius:10px;
display:flex;
gap:20px;
align-items:center;
}

img{
width:120px;
border-radius:6px;
}

button{
padding:10px 20px;
background:#22c55e;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

.back{
display:inline-block;
margin-bottom:20px;
color:white;
text-decoration:none;
background:#334155;
padding:8px 15px;
border-radius:6px;
}

.message{
margin-top:20px;
color:#22c55e;
}

</style>

</head>

<body>

<div class="container">

<a href="search_books.php" class="back">⬅ Back</a>

<h2>Reserve Book</h2>

<div class="book">

<img src="../assets/images/<?php echo $book['cover_image']; ?>">

<div>

<h3><?php echo $book['title']; ?></h3>

<p>Author: <?php echo $book['authors']; ?></p>

<p>Category: <?php echo $book['category']; ?></p>

<p><?php echo $book['summary']; ?></p>

<form method="POST">

<button name="reserve">Reserve Book</button>

</form>

</div>

</div>

<?php if($message!=""){ ?>

<p class="message"><?php echo $message; ?></p>

<?php } ?>

</div>

</body>
</html>