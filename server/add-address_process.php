<?php
session_start();
include "connection.php";

$labelalamat = $_POST['labelalamat'];
$alamat = $_POST['alamat'];
$area = $_POST['area'];
$telepon = $_POST['telepon'];

$query = "INSERT INTO users (labelalamat, alamat, area, telepon) 
              VALUES('$labelalamat', '$name', '$email', '$password')";
mysqli_query($connect, $query);
header('location: ../login.php');
