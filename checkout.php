<?php
session_start();
include "server/connection.php";
if (!isset($_SESSION['email'])) {
    header("location: login.php");
}

$email = $_SESSION['email'];
$query_getprofile = mysqli_query($connect, "SELECT id, name, email FROM users WHERE email='$email'");
$data_getprofile = mysqli_fetch_array($query_getprofile);
$query_permak = mysqli_query($connect, "SELECT * FROM jasa WHERE jenis = 'Permak'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/checkout.css">
    <title>Hello, world!</title>
    <title>Document</title>
</head>

<body>
    <?php
    include "assets/components/navbar-alt.php"
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="heading">
                        <h3>Detil Alamat<h3>
                    </div>
                    <div class="col">
                        <div class="p-3 card card-custom">
                            <div class="card-body">
                                <?php
                                $id = $data_getprofile['id'];
                                $query_getalamat = mysqli_query($connect, "SELECT * from alamat WHERE id_pengguna = '$id'");
                                $alamat_status = mysqli_num_rows($query_getalamat);
                                $data_getalamat = mysqli_fetch_array($query_getalamat);
                                echo "<div class=col>";
                                echo "<h5 class=card-title>$data_getalamat[label]</h5>";
                                echo "<p class=card-text>
                                        Nama Penerima : $data_getalamat[nama_penerima]<br>
                                        Telepon       : $data_getalamat[telepon]<br>
                                        Alamat        : $data_getalamat[alamat]<br>
                                        Area          : $data_getalamat[area]<br>
                                        Kode Pos      : $data_getalamat[kodepos]<br>
                                        </p>";
                                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeAddress'>Ganti Alamat</button>";
                                echo "</div>";
                                echo "</p>";
                                ?>
                                <div class="col justify-content-end">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pengiriman</button>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='#'>Action</a></li>
                                        <li><a class='dropdown-item' href='#'>Action</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal fade' id='changeAddress' tabindex='-1' aria-labelledby='changeAddressLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='changeAddressLabel'>Ganti Alamat</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    Nothing here
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                    <button type='button' class='btn btn-primary'>Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="heading">
                        <h3>Detil Barang</h3>
                    </div>
                    <div class=col>
                        <div class="p-3 card card-custom">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="assets/img/kaos-jahitbaru.png" class="card-img" alt=...>
                                    </div>
                                    <div class="col-8">
                                        <h5 class=card-title>Kaos - Jahit Baru</h5>
                                        <p class=card-text>
                                            1 buah <br>
                                            Rp. 200000 <br>
                                        </p>
                                    </div>
                                    <span class="border-bottom"></span>
                                    <div class="col-4">
                                        <img src="assets/img/kemejapendek-permak.png" class="card-img" alt=...>
                                    </div>
                                    <div class="col-8">
                                        <h5 class=card-title>Kemeja Pendek - Permak</h5>
                                        <p class=card-text>
                                            2 buah <br>
                                            Rp. 180000
                                        </p>
                                    </div>
                                    <span class="border-bottom"></span>
                                </div>
                                <div class="row">
                                    <div class="col-auto me-auto">Total Harga</div>
                                    <div class="col-auto">Rp. 380000</div>
                                </div>
                                <div class="row">
                                    <div class="col-auto me-auto">Harga Pengiriman</div>
                                    <div class="col-auto">Rp. 17000</div>
                                    <span class="border-bottom"></span>
                                </div>
                                <div class="row">
                                    <div class="col-auto me-auto"><br>
                                        <h5>Total Harga</h5>
                                    </div>
                                    <div class="col-auto"><br>
                                        <h5 style="color: #198754">Rp. 397000</h5>
                                    </div>
                                </div>

                            </div>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#payment'>Pilih Pembayaran</button>
                            <div class='modal fade' id='payment' tabindex='-1' aria-labelledby='paymentLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='paymentLabel'>Pilih Pembayaran</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            Nothing here
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            <button type='button' class='btn btn-primary'>Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "assets/components/footer.php";
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>