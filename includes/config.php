<?php
// Start session if not already started
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Check if we are on Railway (env variables exist)
if(isset($_ENV['MYSQLHOST'])) {
    $conn = new mysqli(
        $_ENV['MYSQLHOST'],
        $_ENV['MYSQLUSER'],
        $_ENV['MYSQLPASSWORD'],
        $_ENV['MYSQLDATABASE'],
        $_ENV['MYSQLPORT']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
} else {
    // Local XAMPP testing
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "library_system_db";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if(!$conn){
        die("Local database connection failed: " . mysqli_connect_error());
    }
}
?>