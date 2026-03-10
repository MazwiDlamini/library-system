<?php

/* DATABASE SETTINGS */
$host = "localhost";
$username = "root";
$password = "";
$database = "library_system_db";   // <-- your correct database name

/* CREATE CONNECTION */
$conn = mysqli_connect($host, $username, $password, $database);

/* CHECK CONNECTION */
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

/* SET CHARACTER SET */
mysqli_set_charset($conn, "utf8");

?>