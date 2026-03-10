<?php
session_start();
include("../includes/db.php");

/* Check if user is logged in */
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Check if book id exists */
if(isset($_GET['book_id'])){

    $book_id = intval($_GET['book_id']);

    /* Check if already in favorites */
    $check = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id='$user_id' AND book_id='$book_id'");

    if(mysqli_num_rows($check) == 0){

        mysqli_query($conn, "INSERT INTO favorites (user_id, book_id) VALUES ('$user_id','$book_id')");

        $_SESSION['message'] = "Book added to favorites successfully!";
    }
    else{
        $_SESSION['message'] = "Book already exists in favorites.";
    }

}

/* Redirect back to search books page */
header("Location: search_books.php");
exit();
?>