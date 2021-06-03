<?php

include "server/connection.php";
session_start();
$email = $_SESSION['email'];
//Pakai prosedur getUserProfile
$query_getprofile = mysqli_query($connect, "CALL getUserEmail('$email')");
$data_getprofile = mysqli_fetch_array($query_getprofile);
$id = $data_getprofile['id'];
mysqli_next_result($connect);
$query_gethistory = mysqli_query($connect, "CALL getHistoriTransaksi('$id')");
$data_counthistory = mysqli_num_rows($query_gethistory);
mysqli_next_result($connect);
if (empty($_SESSION['email']) and empty($_SESSION['status'])) {
    header("location: login.php");
} else {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <?php
        include "assets/components/header.php";
        ?>
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Histori Transaksi</title>
    </head>

    <body>
        <?php
        include "assets/components/navbar-profil.php";
        ?>
        <main>
            <div class="container mt-5">
                <a href="index.php" class="text-black-50" style="text-decoration: none;"><i class="fas fa-chevron-left me-2"></i>Kembali ke halaman utama</a>
                <div class="heading mt-4">
                    <h3>Histori Transaksi</h3>
                </div>
                <div class="my-5">
                    <table class="table">
                        <?php
                        if ($data_counthistory == 0) {
                            echo "<div class=text-center>";
                            echo "<h5>Histori transaksi masih kosong</h5>";
                            echo "<p>Selesaikan transaksi anda</p>";
                            echo "</div>";
                        } else {
                        ?>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Jasa</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Waktu Pengambilan</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($data_gethistory = mysqli_fetch_array($query_gethistory)) {
                                echo "<tr>";
                                echo "<th scope=row>$data_gethistory[id]</th>";
                                echo "<td>$data_gethistory[nama] - $data_gethistory[jenis]</td>";
                                echo "<td>$data_gethistory[jumlah]</td>";
                                echo "<td>$data_gethistory[waktu_pengambilan]</td>";
                                echo "<td>Rp. $data_gethistory[total]</td>";
                                echo "<td>$data_gethistory[status]</td>";
                                echo "</tr>";
                            }
                        }
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </main>
        <?php
        include "assets/components/footer.php";
        ?>
        <script>
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                return !(charCode > 31 && (charCode < 48 || charCode > 57));
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    </body>

    </html>
<?php
}
?>