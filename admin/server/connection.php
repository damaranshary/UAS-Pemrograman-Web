<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "uas_pweb";
$connect = mysqli_connect($host, $user, $password);
mysqli_select_db($connect, $db_name);

if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
