<?php
include "../server/connection.php";
$query_gettransaksi = mysqli_query($connect, "SELECT * FROM transaksi");
$data_countgettransaksi = mysqli_num_rows($query_gettransaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Transaksi</title>
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
                        <a href="transaksi.php" class="nav-link text-truncate text-white active">
                            <i class="fs-4 bi-cart-fill"></i> <span class="ms-1 d-none d-sm-inline">Transaksi</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="saran-komplain.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-chat-left-dots-fill"></i> <span class="ms-1 d-none d-sm-inline">Saran dan Komplain</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <table class="table mb-5">
            <?php
            if ($data_countgettransaksi == 0) {
                echo "<div class='text-center py-5'>";
                echo "<h5>Belum Ada Transaksi</h5>";
                echo "</div>";
            } else {
            ?>
                <thead>
                    <tr>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">ID Pengguna</th>
                        <th scope="col">ID Alamat</th>
                        <th scope="col">Instruksi</th>
                        <th scope="col">Waktu Pengambilan</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $nomor = 0;
                while ($data_gettransaksi = mysqli_fetch_array($query_gettransaksi)) {
                    echo "<tr>";
                    echo "<th scope=row>$data_gettransaksi[id_transaksi]</th>";
                    echo "<td>$data_gettransaksi[id_alamat]</td>";
                    echo "<td>$data_gettransaksi[id_users]</td>";
                    echo "<td>$data_gettransaksi[intruksi]</td>";
                    echo "<td>$data_gettransaksi[waktu_pengambilan]</td>";
                    echo "<td>Rp. $data_gettransaksi[total]</td>";
                    echo "<td>
                    <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#exampleModal$nomor'>$data_gettransaksi[status]</button>
                    </td>";
                    echo "</tr>";
                    echo "<div class='modal fade' id='exampleModal$nomor' tabindex=-1 aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                    echo '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Update Proses</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<div class="list-group">';
                    echo "<a href='server/update-transaksi_process.php?status=Proses&id=$data_gettransaksi[id_transaksi]' class='list-group-item list-group-item-action'>Proses</a>";
                    echo "<a href='server/update-transaksi_process.php?status=Pengembalian&id=$data_gettransaksi[id_transaksi]' class='list-group-item list-group-item-action'> Pengembalian</a>";
                    echo "<a href='server/update-transaksi_process.php?status=Selesai&id=$data_gettransaksi[id_transaksi]' class='list-group-item list-group-item-action'>Selesai</a>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    // echo '<div class="mb-3">';
                    // echo "<input type=text class='form-control d-none' name=id_jasa id=id_jasa value='$data_getjasa[id]' required>";
                    // echo '<label for="nama_jasa" class="form-label">Nama</label>';
                    // echo "<input type=text class=form-control name=nama_jasa id=nama_jasa value='$data_getjasa[nama]' required>";
                    // echo '</div>';
                    // echo '<div class="mb-3">';
                    // echo '<label class="form-label" for="jenis">Jenis</label>';
                    // echo '<select class="form-select" aria-label="Default select example" name="jenis" id="jenis" required>';
                    // echo "<option value='$data_getjasa[jenis]' selected>$data_getjasa[jenis]</option>";
                    // echo '<option value="Permak">Permak</option>';
                    // echo '<option value="Jahit Baru">Jahit Baru</option>';
                    // echo '</select>';
                    // echo '</div>';
                    // echo '<div class="mb-3">';
                    // echo '<label class="form-label" for="filefoto">File Foto/Gambar</label>';
                    // echo "<input type='text' class='form-control' name=filefoto id='filefoto' value='$data_getjasa[image]' required>";
                    // echo '</div>';
                    // echo '<div class="mb-3">';
                    // echo '<label class="form-label" for="keterangan">Keterangan</label>';
                    // echo "<textarea class='form-control' rows='4' name='keterangan' id='keterangan' style='resize: none;' required>$data_getjasa[keterangan]</textarea>";
                    // echo '</div>';
                    // echo '<div class="mb-3">';
                    // echo '<label class="form-label" for="harga">Harga</label>';
                    // echo "<input type=text class=form-control name=harga id=harga value='$data_getjasa[harga]' required>";
                    // echo '</div>';
                    // echo '<button type="submit" class="btn btn-primary me-2">Ubah</button>';
                    // echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>';
                    // echo '</div>';
                    // echo '</div>';
                    // echo '</div>';
                    // echo '</div>';
                    $nomor++;
                }
            }
                ?>
                </tbody>
        </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>