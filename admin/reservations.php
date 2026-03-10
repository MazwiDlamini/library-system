<?php
session_start();
include "../includes/config.php";

if(isset($_GET['approve'])){
$id=$_GET['approve'];
mysqli_query($conn,"UPDATE reservations SET status='Approved' WHERE id=$id");
}

if(isset($_GET['deny'])){
$id=$_GET['deny'];
mysqli_query($conn,"UPDATE reservations SET status='Denied' WHERE id=$id");
}

$res=mysqli_query($conn,"
SELECT reservations.*,users.name,books.title
FROM reservations
JOIN users ON users.id=reservations.user_id
JOIN books ON books.id=reservations.book_id
");
?>

<h2>Reservations</h2>

<table border="1">

<tr>
<th>User</th>
<th>Book</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($r=mysqli_fetch_assoc($res)){ ?>

<tr>

<td><?php echo $r['name'];?></td>
<td><?php echo $r['title'];?></td>
<td><?php echo $r['status'];?></td>

<td>

<a href="?approve=<?php echo $r['id'];?>">Approve</a>

<a href="?deny=<?php echo $r['id'];?>">Deny</a>

</td>

</tr>

<?php } ?>

</table>