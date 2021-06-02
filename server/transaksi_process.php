<?php
include "connection.php";
session_start();

$id_alamat = $_POST['id-alamat'];
$id_users = $_POST['id-pengguna'];
$instruksi = $_POST['instruksi'];
$meeting_time = $_POST['meeting_time'];
$total = $_POST['total'];
$status = "Proses";
echo "$id_alamat";
echo "$instruksi";
echo "$meeting_time";
echo "$total";
echo "$id_users";

$datecreate = date_create($meeting_time);
$datetime = date_format($datecreate, 'Y-m-d H:i:s');
echo "$datetime";

$insert_transaksi = mysqli_query($connect, "CALL insertTransaksi('$id_users', '$id_alamat', '$instruksi', '$datetime', '$total', '$status')");
$test1 = mysqli_query($connect, "SELECT LAST_INSERT_ID() AS id");
$data_getprofile = mysqli_fetch_assoc($test1);
$id = $data_getprofile['id'];

echo "$id";

$isikeranjang = array();
$query_getcart = mysqli_query($connect, "CALL getKeranjang('$id_users')");
while ($data_getcart = mysqli_fetch_array($query_getcart)) {
}
$ukuran = count($isikeranjang);

echo "$ukuran";

for ($i = 0; $i < 1; $i++) {
    $detil_transaksi = mysqli_query($connect, "INSERT INTO detil_transaksi (id_transaksi, id_barang, kuantitas) VALUES ('10', '10', '10')");
}

// simpan data detail pemesanan  
// for ($i = 0; $i < $jml; $i++){
//     mysqli_query("INSERT INTO detail_beli(id_beli, id_produk, jumlah) VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
//   }
//   // setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang
//   for ($i = 0; $i < $jml; $i++) { 
//       mysqli_query("DELETE FROM keranjang WHERE id_belanja = {$isikeranjang[$i]['id_belanja']}");
//     }
//header('location: ../index.php');
