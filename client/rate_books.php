<?php
include "../includes/config.php";
include "../includes/functions.php";
isLoggedIn();
$user_id = $_SESSION['user_id'];

// Handle rating submission
if(isset($_POST['rate'])){
    $book_id = (int)$_POST['book_id'];
    $rating = (int)$_POST['rating'];
    $comment = sanitize($_POST['comment']);

    $check = mysqli_query($conn,"SELECT * FROM ratings WHERE user_id='$user_id' AND book_id='$book_id'");
    if(mysqli_num_rows($check)>0){
        mysqli_query($conn,"UPDATE ratings SET rating='$rating', comment='$comment' WHERE user_id='$user_id' AND book_id='$book_id'");
    } else {
        mysqli_query($conn,"INSERT INTO ratings(user_id,book_id,rating,comment) VALUES('$user_id','$book_id','$rating','$comment')");
    }
    header("Location:rate_books.php");
}

// Fetch all books
$books = mysqli_query($conn,"SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head>
<title>Rate Books</title>
<style>
body{background:#0f172a;color:white;font-family:Arial;}
.container{max-width:900px;margin:20px auto;padding:20px;}
.card{background:#1e293b;padding:20px;border-radius:12px;margin-bottom:20px;border:1px solid #334155;}
.card:hover{background:#334155;box-shadow:0 0 20px rgba(0,0,0,0.5);}
.card img{width:100%;height:150px;object-fit:cover;border-radius:8px;float:left;margin-right:15px;}
.card h3{margin:0;}
form{margin-top:10px;}
input[type=number]{width:60px;padding:5px;border-radius:6px;border:none;margin-right:10px;}
textarea{width:90%;padding:5px;border-radius:6px;border:none;margin-top:5px;}
.btn{padding:6px 10px;border-radius:6px;background:#3498db;color:white;border:none;cursor:pointer;transition:0.3s;}
.btn:hover{background:#2c80b5;}
.clearfix::after{content:"";clear:both;display:table;}
</style>
</head>
<body>
<div class="container">
<h2>Rate Books</h2>
<?php while($b=mysqli_fetch_assoc($books)){ ?>
<div class="card clearfix">
<img src="../images/<?php echo $b['cover_image'];?>" alt="<?php echo $b['title'];?>">
<h3><?php echo $b['title'];?></h3>
<p><?php echo $b['author'];?></p>

<form method="post">
<input type="hidden" name="book_id" value="<?php echo $b['id'];?>">
<label>Rating (1-5):</label>
<input type="number" name="rating" min="1" max="5" required>
<br>
<textarea name="comment" placeholder="Leave a comment (optional)"></textarea>
<br>
<input type="submit" name="rate" value="Submit" class="btn">
</form>
</div>
<?php } ?>
<a href="dashboard.php" class="btn">Back to Dashboard</a>
</div>
</body>
</html>