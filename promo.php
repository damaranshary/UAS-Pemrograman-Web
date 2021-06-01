<?php
session_start();
include "server/connection.php";
if (!isset($_SESSION['email'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/promo.css">
    <title>Promo</title>
</head>
<body>
    <?php
    include "assets/components/navbar-promo.php"
    ?>
    <div class="row align-items-center h-md-100 p-5 justify-content-center">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <img src="assets/img/promo.jpg" class="card-img-top" alt="...">
                <h5 class="card-title">Promo New Member</h5>
                <p class="card-text">Promo spesial bagi member baru yang pertama kali menggunakan jasa Kami. Potongan harga sebesar 5%</p>
                <a href="index.php" class="btn btn-primary">Pesan Sekarang</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <img src="assets/img/ongkir.jpg" class="card-img-top" alt="...">
                <h5 class="card-title">Promo Gratis Ongkir</h5>
                <p class="card-text">Promo spesial bagi member yang telah memnggunakan jasa kami sebanyak lima kali. Gratis biaya pengiriman sebanyak satu kali</p>
                <a href="index.php" class="btn btn-primary">Pesan Sekarang</a>
            </div>
            </div>
        </div>
    </div>
        <div class="row my-2 align-items-center h-md-100 p-5">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <img src="assets/img/promo.jpg" class="card-img-top" alt="...">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Pesan Sekarang</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <img src="assets/img/promo.jpg" class="card-img-top" alt="...">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Pesan Sekarang</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>