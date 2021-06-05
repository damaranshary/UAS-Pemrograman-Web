<?php
session_start();
include "connection.php";

print_r($_POST);
$id = $_POST['id_saran'];
$respon = $_POST['respon'];
$status = $_POST['status'];

$query_updatesaran = mysqli_query($connect, "UPDATE saran_komplain SET responPesan='$respon', statusPesan='$status' WHERE id='$id'");

header('location: ../saran-komplain.php');
