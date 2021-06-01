<?php
include "server/connection.php";
session_start();

$email = $_SESSION['email'];
$query_getprofile = mysqli_query($connect, "CALL getUserEmail('$email')");
$data_getprofile = mysqli_fetch_array($query_getprofile);
$id = $data_getprofile['id'];
mysqli_next_result($connect);
$query_getalamat = mysqli_query($connect, "CALL getAlamatID('$id')");
$alamat_status = mysqli_num_rows($query_getalamat);

//username & role sessionnya kosong!
if (empty($_SESSION['email']) and empty($_SESSION['status'])) {
    header("location: login.php");
} else {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <?php
        include "assets/components/header.php"
        ?>
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Profil</title>
    </head>

    <body>
        <?php
        include "assets/components/navbar-profil.php"
        ?>
        <main>
            <div class="container my-5">
                <a href="index.php" class="text-black-50 mt-5" style="text-decoration: none;"><i class="fas fa-chevron-left me-2"></i>Kembali ke halaman utama</a>
                <h3 class="mt-4">Profile</h3>
                <form class="mt-4">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama :</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data_getprofile['name'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Email :</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $data_getprofile['email'] ?>">
                        </div>
                    </div>
                </form>
                <h3 class="mb-4">Alamat</h3>
                <?php
                if ($alamat_status == 0) {
                    echo "<div class=col style='max-width: 200px'>";
                    echo "<div class='card card-custom'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class=card-title>Tidak ada alamat</h5>";
                    echo "<p class=card-text>Alamat Kosong</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='row row-cols-2 row-cols-md-4 g-4'>";
                    $nomor = 0;
                    while ($data_getalamat = mysqli_fetch_array($query_getalamat)) {
                        echo "<div class=col>";
                        echo "<div class='card card-custom'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class=card-title>$data_getalamat[label]</h5>";
                        echo "<p class=card-text>
                        Nama Penerima : $data_getalamat[nama_penerima]<br>
                        Telepon       : $data_getalamat[telepon]<br>
                        Alamat        : $data_getalamat[alamat]<br>
                        Area          : $data_getalamat[area]<br>
                        Kode Pos      : $data_getalamat[kodepos]<br>
                        </p>";
                        echo "<button class='btn btn-danger'>Hapus</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $nomor++;
                    }
                    echo "</div>";
                }
                ?>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Alamat
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="server/add-address_process.php" method="POST">
                                    <!-- Name input -->
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="labelalamat">Label Alamat</label>
                                        <input type="text" name="label" id="label" class="form-control" required />
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="telepon">Nama Penerima</label>
                                                <input type="text" name="namapenerima" id="namapenerima" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="telepon">Telepon</label>
                                                <input type="text" name="telepon" id="telepon" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea type="text" name="alamat" id="alamat" class="form-control" rows="3" style="resize: none;" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="area">Area</label>
                                                <!-- <input type="text" name="area" id="area" class="form-control" required /> -->
                                                <select class="form-select" aria-label="Default select example" name="area" id="area" required>
                                                    <option selected>...</option>
                                                    <option value="Cibiru">Cibiru</option>
                                                    <option value="Cileunyi">Cileunyi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="telepon">Kode Pos</label>
                                                <input type="text" name="kodepos" id="kodepos" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-grid">
                                                <button data-bs-dismiss="modal" class="btn btn-outline-primary">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>
<?php
}
?>