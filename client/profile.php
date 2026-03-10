<?php
session_start();
include '../includes/config.php';
if(!isset($_SESSION['user_id'])){ header("Location: ../index.php"); exit(); }
$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE id=$user_id"));

// Update profile
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn,"UPDATE users SET name='$name', email='$email' WHERE id=$user_id");
    echo "<script>alert('Profile updated');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="header">
<h2>My Profile</h2>
<a href="dashboard.php" style="color:white; float:right; margin-top:-35px;">⬅ Back</a>
</header>

<div class="profile-card">
<form method="post">
<label>Name:</label><br>
<input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
<label>Email:</label><br>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
<input type="submit" name="update" value="Update Profile" class="btn">
</form>
</div>
</body>
</html>