<?php
session_start();
require_once("../includes/db.php");

$user_id=$_SESSION['user_id'];

$result=mysqli_query($conn,"
SELECT b.title,br.borrow_date,br.due_date,br.return_date,br.status
FROM borrowings br
JOIN books b ON b.id=br.book_id
WHERE br.user_id='$user_id'
ORDER BY br.borrow_date DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Borrowing History</title>

<style>

table{
width:90%;
margin:auto;
border-collapse:collapse;
}

th{
background:#1e293b;
color:white;
padding:10px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#f1f5f9;
}

.returned{
color:green;
font-weight:bold;
}

.borrowed{
color:red;
font-weight:bold;
}

</style>

</head>

<body>

<h2 style="text-align:center">My Borrowing History</h2>

<table>

<tr>

<th>Book</th>
<th>Borrow Date</th>
<th>Due Date</th>
<th>Returned</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['borrow_date']; ?></td>

<td><?php echo $row['due_date']; ?></td>

<td><?php echo $row['return_date'] ?? "Not yet"; ?></td>

<td class="<?php echo $row['status']; ?>">

<?php echo strtoupper($row['status']); ?>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>