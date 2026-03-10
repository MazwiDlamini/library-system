<?php

include "../includes/config.php";

session_start();

$user_id=$_SESSION['user_id'];

$book_id=$_POST['book_id'];

mysqli_query($conn,"
DELETE FROM favorites
WHERE user_id='$user_id'
AND book_id='$book_id'
");

header("Location: favorite_books.php");