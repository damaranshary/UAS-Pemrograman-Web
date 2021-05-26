<?php
include "server/connection.php";
session_start();

//$query_permak = mysqli_query($connect, "SELECT * FROM users");
$query_permak = mysqli_query($connect, "SELECT nama, image, keterangan, harga FROM jasa WHERE jenis = 'permak'");
$query_buat = mysqli_query($connect, "SELECT nama, image, keterangan, harga FROM jasa WHERE jenis = 'jahitbaru'");

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/index.css" <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Hello, world!</title>
</head>

<body>
    <?php
    include "assets/components/navbar.php"
    ?>
    <main>
        <div class="container mt-5">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="card bg-dark text-white" style="height: 300px;">
                            <img src="assets/img/login.png" class="card-img" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-dark text-white" style="height: 300px;">
                            <img src="assets/img/login.png" class="card-img" alt="...">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card bg-dark text-white" style="height: 300px;">
                            <img src="assets/img/login.png" class="card-img" alt="...">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <section class="section">
            <div class="container mt-5">
                <h3>Popular Service</h3>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-5">
                <h3>All Service</h3>
                <ul class="nav nav-pills justify-content-center mt-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-permak-tab" data-bs-toggle="pill" data-bs-target="#pills-permak" type="button" role="tab" aria-controls="pills-permak" aria-selected="true">Permak</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-baru-tab" data-bs-toggle="pill" data-bs-target="#pills-baru" type="button" role="tab" aria-controls="pills-baru" aria-selected="false">Jahit Baru</button>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-permak" role="tabpanel" aria-labelledby="pills-permak-tab">
                        <div class="row my-4 row-cols-2 row-cols-md-4 g-4">
                            <?php
                            $nomor = 0;
                            while ($data_permak = mysqli_fetch_array($query_permak)) {
                                echo "<div class=col>";
                                echo "<div class=card>";
                                echo "<img src=assets/img/$data_permak[image] class=card-img-top alt=...>";
                                echo "<div class=card-body>";
                                echo "<h5 class=card-title>$data_permak[nama]</h5>";
                                echo "<p class=card-text>$data_permak[keterangan]</p>";
                                echo "<a href=# class='btn btn-primary'>Rp. $data_permak[harga]</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                $nomor++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-baru" role="tabpanel" aria-labelledby="pills-baru-tab">
                        <div class="row mt-4 row-cols-2 row-cols-md-4">
                            <?php
                            $loop1 = 0;
                            while ($data_buat = mysqli_fetch_array($query_buat)) {
                                echo "<div class=col>";
                                echo "<div class=card>";
                                echo "<img src=assets/img/$data_buat[image] class=card-img-top alt=...>";
                                echo "<div class=card-body>";
                                echo "<h5 class=card-title>$data_buat[nama]</h5>";
                                echo "<p class=card-text>$data_buat[keterangan]</p>";
                                echo "<a href=# class='btn btn-primary'>Rp. $data_buat[harga]</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                $loop1++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
    include "assets/components/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</body>

</html>