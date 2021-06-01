<?php
include "connection.php";
session_start();


$id = mysqli_real_escape_string($connect, $_GET['id']);
$query_hapuscart = mysqli_query($connect, "DELETE FROM keranjang WHERE id='$id'");

header('location: ../checkout.php');
