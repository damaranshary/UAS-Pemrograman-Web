<?php
session_start();
include "connection.php";

$email = $_SESSION['email'];
$label = $_POST['label'];
$namapenerima = $_POST['namapenerima'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$area = $_POST['area'];
$kodepos = $_POST['kodepos'];


$query_getid = mysqli_query($connect, "SELECT id FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($query_getid);
$id_pengguna = $row['id'];

$query_getalamat = mysqli_query($connect, "SELECT getJumlahAlamat('$id_pengguna', '$label') AS getJumlahAlamat");
$jumlahAlamat = mysqli_fetch_assoc($query_getalamat);
$alamat_status = $jumlahAlamat['getJumlahAlamat'];
//$alamat_status = mysqli_num_rows($query_getalamat);

if ($alamat_status == 0) {
    mysqli_query($connect, "CALL insertAlamat('$id_pengguna', '$label', '$namapenerima',  '$telepon', '$alamat', '$area', '$kodepos')");
    header('location: ../profile.php');
} else {
    header('location: ../profile.php?status=fail');
}

//echo "$id_pengguna, $email, $label, $namapenerima, $telepon, $alamat, $area, $kodepos";
