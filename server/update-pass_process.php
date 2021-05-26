<?php
include "connection.php";
$email = $_POST['email'];
$new_pass = $_POST["new_pass"];

$query_find = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
$user_status = mysqli_num_rows($query_find);

if ($user_status == 1) {
    $password = password_hash($new_pass, PASSWORD_DEFAULT);
    $query_update = "UPDATE users SET password='$password' WHERE  username='$username' AND email='$email'";
    mysqli_query($connect, $query_update);
    //header("location: ../resources/pages/login.php");
} else {
    echo "Error";
}
