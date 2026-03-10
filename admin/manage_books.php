<?php
session_start();
include "../includes/config.php";

if(!isset($_SESSION['admin_logged_in'])){
header("Location: ../client/index.php");
exit();
}

/* ADD BOOK */

if(isset($_POST['add_book'])){

$title=$_POST['title'];
$authors=$_POST['authors'];
$category=$_POST['category'];
$summary=$_POST['summary'];
$quantity=$_POST['quantity'];

mysqli_query($conn,"INSERT INTO books
(title,authors,category,summary,quantity,available)
VALUES
('$title','$authors','$category','$summary','$quantity','$quantity')");

}

/* DELETE BOOK */

if(isset($_GET['delete'])){

$id=$_GET['delete'];

mysqli_query($conn,"DELETE FROM books WHERE id='$id'");

header("Location: manage_books.php");
exit();

}

$books=mysqli_query($conn,"SELECT * FROM books");
?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Books</title>

<style>

body{
font-family:Arial;
margin:0;
background:linear-gradient(135deg,#1e3a8a,#0ea5e9);
color:white;
}

header{
background:#0f172a;
padding:20px;
display:flex;
justify-content:space-between;
}

.container{
padding:40px;
}

input,textarea{
width:100%;
padding:10px;
margin:8px 0;
border:none;
border-radius:6px;
}

button{
padding:10px 15px;
background:#22c55e;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#16a34a;
}

table{
width:100%;
margin-top:30px;
border-collapse:collapse;
background:#0f172a;
}

th,td{
padding:12px;
border-bottom:1px solid #334155;
text-align:left;
}

.delete{
background:#ef4444;
padding:6px 10px;
border-radius:6px;
color:white;
text-decoration:none;
}

.delete:hover{
background:#dc2626;
}

</style>

</head>

<body>

<header>

<h2>📚 Manage Books</h2>

<a href="dashboard.php" style="color:white;">⬅ Back</a>

</header>

<div class="container">

<h3>Add New Book</h3>

<form method="POST">

<input type="text" name="title" placeholder="Book Title" required>

<input type="text" name="authors" placeholder="Author" required>

<input type="text" name="category" placeholder="Category" required>

<textarea name="summary" placeholder="Book Summary"></textarea>

<input type="number" name="quantity" placeholder="Quantity" required>

<button name="add_book">Add Book</button>

</form>

<h3>Library Books</h3>

<table>

<tr>

<th>Title</th>
<th>Author</th>
<th>Category</th>
<th>Available</th>
<th>Action</th>

</tr>

<?php while($book=mysqli_fetch_assoc($books)){ ?>

<tr>

<td><?php echo $book['title']; ?></td>

<td><?php echo $book['authors']; ?></td>

<td><?php echo $book['category']; ?></td>

<td><?php echo $book['available']; ?></td>

<td>
<a class="delete" href="manage_books.php?delete=<?php echo $book['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>