<?php
include "connection.php";
// insert ke tabel transaksi
$jumlah = $_POST['jumlah'];
$email = mysqli_real_escape_string($connect, $_GET['email']);

$query_getid = mysqli_query($connect, "SELECT id FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($query_getid);
$id_pengguna = $row['id'];
$id_barang = mysqli_real_escape_string($connect, $_GET['id']);
$query = "CALL insertKeranjang('$id_pengguna', '$id_barang', '$jumlah')";
mysqli_query($connect, $query);

header('location: ../index.php');
