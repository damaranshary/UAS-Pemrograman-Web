<?php
include "connection.php";
session_start();

$id_alamat = $_POST['id-alamat'];
$id_users = $_POST['id-pengguna'];
$instruksi = $_POST['instruksi'];
$meeting_time = $_POST['meeting_time'];
$total = $_POST['total'];
$status = "Proses";
// echo "$id_alamat";
// echo "$instruksi";
// echo "$meeting_time";
// echo "$total";
// echo "$id_users";

$datecreate = date_create($meeting_time);
$datetime = date_format($datecreate, 'Y-m-d H:i:s');
// echo "$datetime";

$insert_transaksi = mysqli_query($connect, "CALL insertTransaksi('$id_users', '$id_alamat', '$instruksi', '$datetime', '$total', '$status')");
mysqli_next_result($connect);
$test1 = mysqli_query($connect, "SELECT LAST_INSERT_ID() AS id");
mysqli_next_result($connect);
$data_getprofile = mysqli_fetch_assoc($test1);
$id = $data_getprofile['id'];

// echo "$id";


$query_getcart = mysqli_query($connect, "CALL getKeranjang('$id_users')");
mysqli_next_result($connect);
$jumlah_keranjang = mysqli_num_rows($query_getcart);
while ($data_getcart = mysqli_fetch_array($query_getcart)) {
    mysqli_next_result($connect);
    $detil_transaksi = mysqli_query($connect, "INSERT INTO detil_transaksi (id_transaksi, id_barang, kuantitas) VALUES ('$id', '$data_getcart[id_jasa]', '$data_getcart[jumlah]')");
}
mysqli_next_result($connect);
$query_deletecart = mysqli_query($connect, "DELETE FROM keranjang WHERE id_pengguna='$id_users'");


// echo "$ukuran";




// simpan data detail pemesanan  
// for ($i = 0; $i < $jml; $i++){
//     mysqli_query("INSERT INTO detail_beli(id_beli, id_produk, jumlah) VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
//   }
//   // setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang
//   for ($i = 0; $i < $jml; $i++) { 
//       mysqli_query("DELETE FROM keranjang WHERE id_belanja = {$isikeranjang[$i]['id_belanja']}");
//     }
header('location: ../index.php?status_transaksi=selesai');
