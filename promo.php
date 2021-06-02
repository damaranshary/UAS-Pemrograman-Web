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
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/promo.css">
    <title>Promo</title>
</head>

<body>
    <?php
    include "assets/components/navbar-promo.php"
    ?>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <img src="assets/img/promo.jpg" class="card-img-top" alt="...">
                        <h5 class="card-title">Promo New Member</h5>
                        <p class="card-text">Promo spesial bagi member baru yang pertama kali menggunakan jasa Kami. Potongan harga sebesar 5%</p>
                        <a href="index.php" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <img src="assets/img/ongkir.jpg" class="card-img-top" alt="...">
                        <h5 class="card-title">Promo Gratis Ongkir</h5>
                        <p class="card-text">Promo spesial bagi member yang telah berlangganan menggunakan jasa kami. Setiap lima kali pembelian, Gratis biaya pengiriman</p>
                        <a href="index.php" class="btn btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "assets/components/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>