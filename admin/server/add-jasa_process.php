<?php
session_start();
include "connection.php";

print_r($_POST);
$id_jasa = $_POST['id_jasa'];
$nama_jasa = $_POST['nama_jasa'];
$jenis = $_POST['jenis'];
$filefoto = $_POST['filefoto'];
$keterangan = $_POST['keterangan'];
$harga = $_POST['harga'];

$status = mysqli_real_escape_string($connect, $_GET['status']);

if (empty($status)) {
    $query_insertJasa = mysqli_query($connect, "INSERT INTO jasa (nama, jenis, image, keterangan, harga) VALUES ('$nama_jasa', '$jenis', '$filefoto', '$keterangan', '$harga')");
} else if ($status == "update") {
    $query_updateJasa = mysqli_query($connect, "UPDATE jasa SET nama='$nama_jasa', jenis='$jenis', image='$filefoto', keterangan='$keterangan', harga='$harga' WHERE id='$id_jasa'");
}

header('location: ../jasa.php');
