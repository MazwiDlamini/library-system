<?php

include "config.php";

/* sanitize input */
function esc($str){
    global $conn;
    return mysqli_real_escape_string($conn, trim($str));
}

/* check if email exists */
function emailExists($email){
    global $conn;

    $email = esc($email);

    $sql = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    return mysqli_num_rows($result) > 0;
}

/* register user */
function registerUser($name,$email,$password){

    global $conn;

    $name = esc($name);
    $email = esc($email);

    $password = password_hash($password,PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name,email,password)
            VALUES ('$name','$email','$password')";

    return mysqli_query($conn,$sql);
}

/* LOGIN USER (THIS FIXES YOUR ERROR) */
function loginUser($email,$password){

    global $conn;

    $email = esc($email);

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            return true;
        }

    }

    return false;
}

/* check if user logged in */
function isLoggedIn(){
    return isset($_SESSION['user_id']);
}

/* require login for client pages */
function requireLogin(){
    if(!isLoggedIn()){
        header("Location: index.php");
        exit();
    }
}

/* admin login check */
function adminLoggedIn(){
    if(!isset($_SESSION['admin'])){
        header("Location: login.php");
        exit();
    }
}

/* get user info */
function getUser($id){
    global $conn;

    $id = intval($id);

    $result = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");

    return mysqli_fetch_assoc($result);
}

/* get books */
function getBooks(){
    global $conn;

    return mysqli_query($conn,"SELECT * FROM books ORDER BY created_at DESC");
}

/* get notifications */
function getNotifications($user_id){

    global $conn;

    $user_id = intval($user_id);

    return mysqli_query($conn,
        "SELECT * FROM notifications
        WHERE user_id=$user_id
        ORDER BY created_at DESC"
    );
}

?>