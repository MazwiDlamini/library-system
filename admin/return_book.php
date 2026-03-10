<?php
session_start();
require_once("../includes/db.php");

$result=mysqli_query($conn,"
SELECT br.id,u.name,b.title
FROM borrowings br
JOIN users u ON u.id=br.user_id
JOIN books b ON b.id=br.book_id
WHERE br.status='borrowed'
");

if(isset($_GET['return'])){

$id=$_GET['return'];

mysqli_query($conn,"
UPDATE borrowings
SET status='returned',
return_date=CURDATE()
WHERE id='$id'
");

$book=mysqli_query($conn,"SELECT book_id FROM borrowings WHERE id='$id'");
$book=mysqli_fetch_assoc($book);

mysqli_query($conn,"UPDATE books SET available=1 WHERE id=".$book['book_id']);

header("Location: return_book.php");

}
?>

<h2>Return Books</h2>

<table border="1">

<tr>

<th>Client</th>
<th>Book</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['title']; ?></td>

<td>

<a href="?return=<?php echo $row['id']; ?>">Mark Returned</a>

</td>

</tr>

<?php } ?>

</table>