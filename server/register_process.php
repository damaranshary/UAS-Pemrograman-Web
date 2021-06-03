<?php
include "connection.php";
// receive all input values from the form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$errors = array();


// first check the database to make sure 
// a user does not already exist with the same username and/or email
$query = mysqli_query($connect, "SELECT * FROM users WHERE email='$email' LIMIT 1");
$user_status = mysqli_num_rows($query);

if ($user_status > 0) { // if user exists
    header('location: ../register.php?status=failed');
}

// Finally, register user if there are no errors in the form
if ($user_status == 0) {
    $password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database

    $query = "CALL insertUsers('$name', '$email', '$password')";
    mysqli_query($connect, $query);
    //$_SESSION['success'] = "You are now logged in";
    //echo $username;
    header('location: ../login.php');
}
