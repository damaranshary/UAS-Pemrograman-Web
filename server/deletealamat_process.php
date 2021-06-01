<?php
include "connection.php";
session_start();

$id = mysqli_real_escape_string($connect, $_GET['id']);
$query_hapusalamat = mysqli_query($connect, "CALL deleteAlamatID('$id')");

header('location: ../profile.php');
