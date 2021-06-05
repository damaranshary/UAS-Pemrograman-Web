<?php
session_start();
include "connection.php";

// print_r($_POST);
// $id_transaksi = $_POST['id_transaksi'];
// $nama_jasa = $_POST['nama_jasa'];
// $jenis = $_POST['jenis'];
// $filefoto = $_POST['filefoto'];
// $keterangan = $_POST['keterangan'];
// $harga = $_POST['harga'];

$id_transaksi = mysqli_real_escape_string($connect, $_GET['id']);
$status = mysqli_real_escape_string($connect, $_GET['status']);

if (empty($status && $id_transaksi)) {
    // $query_insertJasa = mysqli_query($connect, "INSERT INTO jasa (nama, jenis, image, keterangan, harga) VALUES ('$nama_jasa', '$jenis', '$filefoto', '$keterangan', '$harga')");
    echo "data kosong";
} else{
    // echo "$id_transaksi";
    // echo "$status";
    $query_updatetransaksi = mysqli_query($connect, "UPDATE transaksi SET status='$status' WHERE id_transaksi='$id_transaksi'");
}

header('location: ../transaksi.php');