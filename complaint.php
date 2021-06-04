<?php
session_start();
include "server/connection.php";
$email = $_SESSION['email'];
//Pakai prosedur getUserProfile
$query_getprofile = mysqli_query($connect, "CALL getUserEmail('$email')");
$data_getprofile = mysqli_fetch_array($query_getprofile);
$id = $data_getprofile['id'];
mysqli_next_result($connect);
$query_getsarankomplain = mysqli_query($connect, "CALL getSaranKomplainID('$id')");
$data_querysarankomplain = mysqli_num_rows($query_getsarankomplain);
mysqli_next_result($connect);
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
    <title>Saran dan Komplain</title>
</head>

<body>
    <?php
    include "assets/components/navbar-profil.php"
    ?>
    <div class="container mt-5 mb-5">
        <a href="index.php" class="text-black-50 mt-5" style="text-decoration: none;"><i class="fas fa-chevron-left me-2"></i>Kembali ke halaman utama</a>
        <div class="heading mb-4 mt-4">
            <h3>Tambahkan Saran/Komplain</h3>
        </div>
        <table class="table">
            <?php
            if ($data_querysarankomplain == 0) {
                echo "<div class='text-center py-5'>";
                echo "<h5>Saran dan Komplain anda masih kosong</h5>";
                echo "<p>Tambahkan saran dan komplain anda</p>";
                echo "</div>";
            } else {
            ?>
                <thead>
                    <tr>
                        <th scope="col">Id Transaksi</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Waktu Submit</th>
                        <th scope="col">Subyek</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $nomor = 0;
                while ($data_getsarankomplain = mysqli_fetch_array($query_getsarankomplain)) {
                    echo "<tr>";
                    echo "<th scope=row>$data_getsarankomplain[id_transaksi]</th>";
                    echo "<td>$data_getsarankomplain[jenis]</td>";
                    echo "<td>$data_getsarankomplain[waktu]</td>";
                    echo "<td>$data_getsarankomplain[subyek]</td>";
                    echo "<td>$data_getsarankomplain[statusPesan]</td>";
                    echo "<td><button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#exampleModal$nomor'>Lihat</button></td>";
                    echo "</tr>";
                    echo "<div class='modal fade' id='exampleModal$nomor' tabindex='-1' aria-labelledby=exampleModalLabel aria-hidden=true>";
                    echo '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Lihat detil</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="subjek">Pesan</label>';
                    echo "<input type='text' class='form-control' name='subjek' id='subjek'  required readonly value=$data_getsarankomplain[pesan]>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="subjek">Subjek</label>';
                    if (empty($data_getsarankomplain['responPesan'])) {
                        echo "<input type='text' class='form-control' name='subjek' id='subjek'  required readonly value='Pesan belum dibalas'>";
                    } else {
                        echo "<input type='text' class='form-control' name='subjek' id='subjek'  required readonly  value=$data_getsarankomplain[responPesan]>";
                    }
                    //echo "<input type='text' class='form-control' name='subjek' id='subjek'  required value=$data_getsarankomplain[responPesan]>";
                    echo '</div>';
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
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambahkan
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="server/add-sarankomplain_process.php">
                            <div class="mb-3">
                                <input class="d-none" value="1" required id="idpengguna" name="idpengguna">
                                <label for="idtransaksi" class="form-label">ID Transaksi</label>
                                <select class="form-select" aria-label="Default select example" name="idtransaksi" id="idtransaksi" required>
                                    <?php
                                    $query_gettransaksi = mysqli_query($connect, "CALL getTransaksiID('$id')");
                                    while ($data_gettransaksi = mysqli_fetch_array($query_gettransaksi)) {
                                        echo "<option value=$data_gettransaksi[id_transaksi]>$data_gettransaksi[id_transaksi]</option>";
                                    }
                                    ?>
                                </select>
                                <div id="emailHelp" class="form-text">Silahkan lihat ID transaksi anda di halaman Histori Transaksi</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis">Jenis</label>
                                <select class="form-select" aria-label="Default select example" name="jenis" id="jenis" required>
                                    <option selected>...</option>
                                    <option value="Saran">Saran</option>
                                    <option value="Komplain">Komplain</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="subjek">Subjek</label>
                                <input type="text" class="form-control" name="subjek" id="subjek" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="pesan">Pesan yang disampaikan</label>
                                <textarea class="form-control" rows="4" name="pesan" id="pesan" style="resize: none;" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <?php
    include "assets/components/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>