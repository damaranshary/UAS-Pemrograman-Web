<?php
session_start();
include "connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");
$jum_data = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);
$solve_password = $row["password"];

if ($jum_data > 0) {
    if (password_verify($password, $solve_password)) {
        # code...
        $_SESSION['email'] = $email;
        $_SESSION['status'] = "Login success!";

        setcookie($_SESSION['email'], $email, time() + 60000);

        header("location: ../index.php");
    } else {
        header("location: ../login.php?login_attempt=failed");
    }
} else {
    header("location: ../login.php?login_attempt=failed");
}
