<?php
include "../server/connection.php";
$query_getsaran = mysqli_query($connect, "SELECT * FROM saran_komplain");
$data_countgetsaran = mysqli_num_rows($query_getsaran);
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['status'])) {
    header("location: ../login.php");
} else if ($_SESSION['email'] != "admin@yukadmin.com") {
    header("location: ../login.php");
} else if ($_SESSION['email'] == "admin@yukadmin.com") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Saran dan Komplain</title>
</head>

<body>
    <?php
    include "assets/components/navbar.php"
    ?>
    <div class="container mt-4">
        <div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-scroll="true" data-bs-backdrop="true">
            <div class="offcanvas-header" style="background-color: #2A4F96;">
                <!-- <h6 class="offcanvas-title d-none d-sm-block text-white" id="offcanvas">Menu</h6> -->
                <span class="offcanvas-title fs-5 d-none d-sm-inline pt-2"><img src="assets/img/logo.svg" alt="" width="" height="25"></span>
                <!-- <button type="button" class="btn-close text-reset pt-2" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
            </div>
            <div class="offcanvas-body px-0" style="background-color: #2A4F96;">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="jasa.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-square-half"></i> <span class="ms-1 d-none d-sm-inline">Jasa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaksi.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-cart-fill"></i> <span class="ms-1 d-none d-sm-inline">Transaksi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="history-update-transaksi.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-archive-fill"></i> <span class="ms-1 d-none d-sm-inline">Histori Update Transaksi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="saran-komplain.php" class="nav-link text-truncate text-white active">
                            <i class="fs-4 bi-chat-left-dots-fill"></i> <span class="ms-1 d-none d-sm-inline">Saran dan Komplain</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <div class="heading">
                    <h3>Saran dan Komplain</h3>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <table class="table mb-5">
            <?php
            if ($data_countgetsaran == 0) {
                echo "<div class='text-center py-5'>";
                echo "<h5>Saran dan Komplain anda masih kosong</h5>";
                echo "<p>Tambahkan saran dan komplain anda</p>";
                echo "</div>";
            } else {
            ?>
                <thead>
                    <tr>
                        <th scope="col">Id Pengguna</th>
                        <th scope="col">Id Transaksi</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Subjek</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $nomor = 0;
                while ($data_getsaran = mysqli_fetch_array($query_getsaran)) {
                    echo "<tr>";
                    echo "<th scope=row>$data_getsaran[id_pengguna]</th>";
                    echo "<td>$data_getsaran[id_transaksi]</td>";
                    echo "<td>$data_getsaran[jenis]</td>";
                    echo "<td>$data_getsaran[waktu]</td>";
                    echo "<td>$data_getsaran[subyek]</td>";
                    echo "<td>$data_getsaran[statusPesan]</td>";
                    echo "<td>
                    <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#exampleModal$nomor'>Ubah</button>
                    </td>";
                    echo "</tr>";
                    echo "<div class='modal fade' id='exampleModal$nomor' tabindex=-1 aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                    echo '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Respon</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form method="POST" action="server/update-komplain_process.php">';
                    echo '<div class="mb-3">';
                    echo "<input type=text class='form-control d-none' name=id_saran id=id_saran value='$data_getsaran[id]' required>";
                    echo '<label for="pesan" class="form-label">Pesan</label>';
                    echo "<textarea class='form-control' rows='5' style='resize: none;' name=pesan id=pesan required readonly>$data_getsaran[pesan]</textarea>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label for="respon" class="form-label">Respon</label>';
                    echo "<textarea class='form-control' rows='5' style='resize: none;' name=respon id=respon required></textarea>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="status">Jenis</label>';
                    echo '<select class="form-select" aria-label="Default select example" name="status" id="status" required>';
                    echo "<option value='$data_getsaran[statusPesan]' selected>$data_getsaran[statusPesan]</option>";
                    echo '<option value="Sudah di respon">Sudah di respon</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary me-2">Tambahkan</button>';
                    echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $nomor++;
                }
            }
                ?>
                </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>
<?php
}
?>