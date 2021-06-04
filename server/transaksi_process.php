<?php
include "connection.php";
session_start();

$id_alamat = $_POST['id-alamat'];
$id_users = $_POST['id-pengguna'];
$instruksi = $_POST['instruksi'];
$meeting_time = $_POST['meeting_time'];
$total = $_POST['total'];
$status = "Proses";

$datecreate = date_create($meeting_time);
$datetime = date_format($datecreate, 'Y-m-d H:i:s');

mysqli_query($connect, "SET autocommit = 0");
mysqli_query($connect, "START TRANSACTION");

$query_getcart = mysqli_query($connect, "CALL getKeranjang('$id_users')");
mysqli_next_result($connect);
$jumlah_keranjang = mysqli_num_rows($query_getcart);

if ($jumlah_keranjang == 0) {
    header('location: ../checkout.php?status_transaksi=gagal');
} else {
    $insert_transaksi = mysqli_query($connect, "CALL insertTransaksi('$id_users', '$id_alamat', '$instruksi', '$datetime', '$total', '$status')");
    mysqli_next_result($connect);

    $test1 = mysqli_query($connect, "SELECT LAST_INSERT_ID() AS id");
    mysqli_next_result($connect);

    $data_getprofile = mysqli_fetch_assoc($test1);
    $id = $data_getprofile['id'];

    while ($data_getcart = mysqli_fetch_array($query_getcart)) {
        mysqli_next_result($connect);
        $detil_transaksi = mysqli_query($connect, "INSERT INTO detil_transaksi (id_transaksi, id_barang, kuantitas) VALUES ('$id', '$data_getcart[id_jasa]', '$data_getcart[jumlah]')");
    }
    mysqli_next_result($connect);
    $query_deletecart = mysqli_query($connect, "DELETE FROM keranjang WHERE id_pengguna='$id_users'");

    mysqli_query($connect, "COMMIT");
    header('location: ../index.php?status_transaksi=selesai');
}
