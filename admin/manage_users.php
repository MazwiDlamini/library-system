<?php
session_start();
require_once("../includes/db.php");

/* delete user */
if(isset($_GET['delete'])){

$id = intval($_GET['delete']);

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location: manage_users.php");
exit();

}

/* get users */
$result = mysqli_query($conn,"SELECT * FROM users WHERE role='client'");
?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Users</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.container{
width:1000px;
margin:auto;
margin-top:40px;
}

h2{
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th{
background:#1e293b;
color:white;
padding:12px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#f1f5f9;
}

button{
padding:6px 10px;
border:none;
border-radius:5px;
cursor:pointer;
}

.view{
background:#3b82f6;
color:white;
}

.delete{
background:#ef4444;
color:white;
}

.details{
display:none;
background:#f9fafb;
padding:10px;
}

.back{
display:inline-block;
margin-bottom:20px;
padding:10px 20px;
background:#333;
color:white;
text-decoration:none;
border-radius:6px;
}

</style>

<script>

function toggleDetails(id){

var row=document.getElementById("details"+id);

if(row.style.display==="none"){
row.style.display="table-row";
}else{
row.style.display="none";
}

}

</script>

</head>

<body>

<div class="container">

<a href="dashboard.php" class="back">⬅ Back</a>

<h2>Manage Clients</h2>

<table>

<tr>

<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Actions</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone'] ?? "N/A"; ?></td>

<td>

<button class="view" onclick="toggleDetails(<?php echo $row['id']; ?>)">View</button>

<a href="manage_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?')">

<button class="delete">Delete</button>

</a>

</td>

</tr>

<tr id="details<?php echo $row['id']; ?>" class="details">

<td colspan="4">

<strong>Physical Address:</strong> <?php echo $row['physical_address'] ?? "Not provided"; ?><br>

<strong>Postal Address:</strong> <?php echo $row['postal_address'] ?? "Not provided"; ?><br>

<strong>Chief Code:</strong> <?php echo $row['chief_code'] ?? "Not provided"; ?><br>

<strong>Phone:</strong> <?php echo $row['phone'] ?? "Not provided"; ?><br>

<strong>Registered:</strong> <?php echo $row['created_at']; ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>