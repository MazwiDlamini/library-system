<?php
session_start();
require_once(__DIR__ . "/../includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT b.title, r.due_date
FROM reservations r
JOIN books b ON b.id = r.book_id
WHERE r.user_id = '$user_id'
ORDER BY r.due_date ASC
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Notifications</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.container{
width:800px;
margin:auto;
margin-top:50px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

h2{
text-align:center;
}

.notification{
padding:15px;
margin-bottom:15px;
border-left:6px solid orange;
background:#fff3cd;
border-radius:5px;
}

.overdue{
border-left:6px solid red;
background:#ffe5e5;
}

.back{
display:inline-block;
margin-top:20px;
padding:10px 20px;
background:#333;
color:white;
text-decoration:none;
border-radius:5px;
}

</style>
</head>

<body>

<div class="container">

<h2>🔔 Notifications</h2>

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

$today = date("Y-m-d");

if($row['due_date'] < $today){

echo "<div class='notification overdue'>";
echo "⚠ OVERDUE: Return <b>".$row['title']."</b>. Due date was <b>".$row['due_date']."</b>";
echo "</div>";

}else{

echo "<div class='notification'>";
echo "Reminder: <b>".$row['title']."</b> is due on <b>".$row['due_date']."</b>";
echo "</div>";

}

}

}else{

echo "<div class='notification'>No notifications available.</div>";

}

?>

<a href="dashboard.php" class="back">⬅ Back</a>

</div>

</body>
</html>