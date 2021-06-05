<?php
include "../server/connection.php";
$query_getjasa = mysqli_query($connect, "SELECT * FROM jasa");
$data_countgetjasa = mysqli_num_rows($query_getjasa);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Jasa</title>
</head>

<body>
    <?php
    include "assets/components/navbar.php"
    ?>
    <div class="container mt-4">
        <div class="offcanvas offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-scroll="true" data-bs-backdrop="true">
            <div class="offcanvas-header" style="background-color: #2A4F96;">
                <span class="offcanvas-title fs-5 d-none d-sm-inline pt-2"><img src="assets/img/logo.svg" alt="" width="" height="25"></span>
            </div>
            <div class="offcanvas-body px-0" style="background-color: #2A4F96;">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-truncate text-white">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="jasa.php" class="nav-link text-truncate text-white active">
                            <i class="fs-4 bi-square-half"></i> <span class="ms-1 d-none d-sm-inline">Jasa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaksi.php" class="nav-link text-truncate text-white">
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
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <div class="heading">
                    <h3>Jasa</h3>
                </div>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-end h-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambahkan
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Jasa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="server/add-jasa_process.php">
                                    <div class="mb-3">
                                        <label for="nama_jasa" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama_jasa" id="nama_jasa" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="jenis">Jenis</label>
                                        <select class="form-select" aria-label="Default select example" name="jenis" id="jenis" required>
                                            <option selected>...</option>
                                            <option value="Permak">Permak</option>
                                            <option value="Jahit Baru">Jahit Baru</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="filefoto">File Foto/Gambar</label>
                                        <input type="text" class="form-control" name="filefoto" id="filefoto" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea class="form-control" rows="4" name="keterangan" id="keterangan" style="resize: none;" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="harga">Harga</label>
                                        <input type="text" class="form-control" name="harga" id="harga" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table mb-5">
            <?php
            if ($data_countgetjasa == 0) {
                echo "<div class='text-center py-5'>";
                echo "<h5>Jasa masih kosong</h5>";
                echo "<p>Tambahkan jasa anda</p>";
                echo "</div>";
            } else {
            ?>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $nomor = 0;
                while ($data_getjasa = mysqli_fetch_array($query_getjasa)) {
                    echo "<tr>";
                    echo "<th scope=row>$data_getjasa[id]</th>";
                    echo "<td>$data_getjasa[nama]</td>";
                    echo "<td>$data_getjasa[jenis]</td>";
                    echo "<td>$data_getjasa[image]</td>";
                    echo "<td>$data_getjasa[keterangan]</td>";
                    echo "<td>Rp. $data_getjasa[harga]</td>";
                    echo "<td>
                    <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#exampleModal$nomor'>Ubah</button>
                    </td>";
                    echo "</tr>";
                    echo "<div class='modal fade' id='exampleModal$nomor' tabindex=-1 aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                    echo '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="exampleModalLabel">Tambah Jasa</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form method="POST" action="server/add-jasa_process.php?status=update">';
                    echo '<div class="mb-3">';
                    echo "<input type=text class='form-control d-none' name=id_jasa id=id_jasa value='$data_getjasa[id]' required>";
                    echo '<label for="nama_jasa" class="form-label">Nama</label>';
                    echo "<input type=text class=form-control name=nama_jasa id=nama_jasa value='$data_getjasa[nama]' required>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="jenis">Jenis</label>';
                    echo '<select class="form-select" aria-label="Default select example" name="jenis" id="jenis" required>';
                    echo "<option value='$data_getjasa[jenis]' selected>$data_getjasa[jenis]</option>";
                    echo '<option value="Permak">Permak</option>';
                    echo '<option value="Jahit Baru">Jahit Baru</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="filefoto">File Foto/Gambar</label>';
                    echo "<input type='text' class='form-control' name=filefoto id='filefoto' value='$data_getjasa[image]' required>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="keterangan">Keterangan</label>';
                    echo "<textarea class='form-control' rows='4' name='keterangan' id='keterangan' style='resize: none;' required>$data_getjasa[keterangan]</textarea>";
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label class="form-label" for="harga">Harga</label>';
                    echo "<input type=text class=form-control name=harga id=harga value='$data_getjasa[harga]' required>";
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary me-2">Ubah</button>';
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