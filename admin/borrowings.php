<?php
session_start();
require_once("../includes/db.php");

/* get users */
$users=mysqli_query($conn,"SELECT id,name,email FROM users WHERE role='client'");

/* get books */
$books=mysqli_query($conn,"SELECT id,title FROM books WHERE available=1");

$msg="";

if(isset($_POST['borrow'])){

$user_id=$_POST['user_id'];
$book_id=$_POST['book_id'];
$borrow_date=$_POST['borrow_date'];
$due_date=$_POST['due_date'];

mysqli_query($conn,"
INSERT INTO borrowings
(user_id,book_id,borrow_date,due_date,status)
VALUES
('$user_id','$book_id','$borrow_date','$due_date','borrowed')
");

/* mark book unavailable */

mysqli_query($conn,"UPDATE books SET available=0 WHERE id='$book_id'");

$msg="Book borrowing recorded successfully";

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Record Borrowing</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{
width:500px;
margin:auto;
margin-top:50px;
background:white;
padding:30px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

input,select{
width:100%;
padding:10px;
margin-bottom:10px;
}

button{
padding:10px;
background:#22c55e;
color:white;
border:none;
width:100%;
border-radius:6px;
}

.back{
display:inline-block;
margin-bottom:15px;
text-decoration:none;
background:#333;
color:white;
padding:8px 15px;
border-radius:5px;
}

.success{
color:green;
}

</style>

</head>

<body>

<div class="container">

<a href="dashboard.php" class="back">⬅ Back</a>

<h2>Record Book Borrowing</h2>

<?php if($msg!="") echo "<p class='success'>$msg</p>"; ?>

<form method="POST">

<label>Select Client</label>

<select name="user_id" required>

<option value="">Choose Client</option>

<?php while($u=mysqli_fetch_assoc($users)){ ?>

<option value="<?php echo $u['id']; ?>">

<?php echo $u['name']." (".$u['email'].")"; ?>

</option>

<?php } ?>

</select>

<label>Select Book</label>

<select name="book_id" required>

<option value="">Choose Book</option>

<?php while($b=mysqli_fetch_assoc($books)){ ?>

<option value="<?php echo $b['id']; ?>">

<?php echo $b['title']; ?>

</option>

<?php } ?>

</select>

<label>Borrow Date</label>

<input type="date" name="borrow_date" required>

<label>Due Date</label>

<input type="date" name="due_date" required>

<button name="borrow">Record Borrowing</button>

</form>

</div>

</body>

</html>