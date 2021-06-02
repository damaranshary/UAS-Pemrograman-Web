<?php
include "connection.php";
session_start();


$id = mysqli_real_escape_string($connect, $_GET['id']);
$query_hapuscart = mysqli_query($connect, "CALL deleteKeranjangID('$id')");

header('location: ../checkout.php');
