<?php
session_start();
include "connection.php";

print_r($_POST);
$id_pengguna = $_POST['idpengguna'];
$id_transaksi = $_POST['idtransaksi'];
$jenis = $_POST['jenis'];
$subjek = $_POST['subjek'];
$pesan = $_POST['pesan'];
$status = "Belum direspon";


$query_insertSaranKomplain = mysqli_query($connect, "CALL insertSaranKomplainID('$id_pengguna', '$id_transaksi', '$jenis', '$subjek', '$pesan', '$status')");
mysqli_next_result($connect);

header('location: ../complaint.php');
