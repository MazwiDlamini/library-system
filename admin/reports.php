<?php
require_once("../includes/db.php");

$books=mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM books"))[0];
$users=mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users"))[0];
$res=mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM reservations"))[0];
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Reports</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{
width:900px;
margin:auto;
}

canvas{
margin-top:40px;
}

.back{
display:inline-block;
margin-top:20px;
padding:10px 20px;
background:#333;
color:white;
text-decoration:none;
border-radius:6px;
}

</style>

</head>

<body>

<div class="container">

<h2>System Reports</h2>

<canvas id="barChart"></canvas>

<canvas id="pieChart"></canvas>

<a href="dashboard.php" class="back">Back</a>

</div>

<script>

const dataValues=[<?php echo $books ?>,<?php echo $users ?>,<?php echo $res ?>];

new Chart(document.getElementById('barChart'),{

type:'bar',

data:{
labels:['Books','Users','Reservations'],
datasets:[{
label:'Library Data',
data:dataValues,
backgroundColor:['#3b82f6','#22c55e','#f59e0b']
}]
}

});

new Chart(document.getElementById('pieChart'),{

type:'pie',

data:{
labels:['Books','Users','Reservations'],
datasets:[{
data:dataValues,
backgroundColor:['#3b82f6','#22c55e','#f59e0b']
}]
}

});

</script>

</body>
</html>