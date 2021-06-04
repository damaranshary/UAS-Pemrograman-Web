<?php
session_start();
include "server/connection.php";
if (!isset($_SESSION['email'])) {
    header("location: login.php");
}

$email = $_SESSION['email'];
//Pakai prosedur getUserProfile
$query_getprofile = mysqli_query($connect, "CALL getUserEmail('$email')");
$data_getprofile = mysqli_fetch_array($query_getprofile);
$id = $data_getprofile['id'];
mysqli_next_result($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/checkout.css">
    <title>Checkout</title>
</head>

<body>
    <p class="d-none"><?php $status_transaksi = mysqli_real_escape_string($connect, $_GET['status_transaksi']); ?></p>
    <?php
    include "assets/components/navbar-checkout.php";
    if (empty($status_transaksi)) {
        $alert = "";
    } else {
        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Keranjang anda kosong
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>
    <main class="mt-5">
        <form id="checkout-form" method="POST" action="server/transaksi_process.php"></form>
        <div class="container">
            <?php echo "$alert" ?>
            <div class="row">
                <div class="col me-3">
                    <div class="row ms-3 ms-md-auto">
                        <div class="heading mb-4">
                            <h3>Detail Alamat<h3>
                        </div>
                        <div class="px-3 py-2 card" style="border-radius: 10px; transition: 0.3s;">
                            <div class="card-body">
                                <p class="d-none"><?php $id_alamat = mysqli_real_escape_string($connect, $_GET['id_alamat']); ?></p>
                                <?php
                                if (empty($id_alamat)) {
                                    $query_getalamat_default = mysqli_query($connect, "CALL getAlamatID('$id')");
                                    $data_getalamat_default = mysqli_fetch_array($query_getalamat_default);
                                    $alamat_status = mysqli_num_rows($query_getalamat_default);
                                    mysqli_next_result($connect);
                                    if ($alamat_status == 0) {
                                        echo "<h5>Alamat kosong</h5>";
                                        echo "<p>Silahkan isi alamat anda pada halaman profil</p>";
                                    } else {
                                        echo "<div class=col>";
                                        echo "<h5 class=card-title>$data_getalamat_default[label]</h5>";
                                        echo "<p class=card-text>
                                        Nama Penerima : $data_getalamat_default[nama_penerima]<br>
                                        Telepon       : $data_getalamat_default[telepon]<br>
                                        Alamat        : $data_getalamat_default[alamat]<br>
                                        Area          : $data_getalamat_default[area]<br>
                                        Kode Pos      : $data_getalamat_default[kodepos]
                                        </p>";
                                        echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeAddress'>Ganti Alamat</button>";
                                        echo "<input class='d-none' name=id-alamat form=checkout-form value=$data_getalamat_default[id_alamat]>";
                                        echo "</div>";
                                    }
                                } else {
                                    $query_getalamat = mysqli_query($connect, "CALL getAlamatID2('$id', '$id_alamat')");
                                    $data_getalamat = mysqli_fetch_array($query_getalamat);
                                    mysqli_next_result($connect);
                                    echo "<div class=col>";
                                    echo "<h5 class=card-title>$data_getalamat[label]</h5>";
                                    echo "<p class=card-text>
                                        Nama Penerima : $data_getalamat[nama_penerima]<br>
                                        Telepon       : $data_getalamat[telepon]<br>
                                        Alamat        : $data_getalamat[alamat]<br>
                                        Area          : $data_getalamat[area]<br>
                                        Kode Pos      : $data_getalamat[kodepos]
                                        </p>";
                                    echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#changeAddress'>Ganti Alamat</button>";
                                    echo "</div>";
                                    echo "<input class='d-none' name=id-alamat form=checkout-form value=$data_getalamat[id_alamat]>";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-2 ms-3 ms-md-auto">
                        <div class="heading mb-4">
                            <h3>Instruksi<h3>
                        </div>
                        <div class="p-1">
                            <p>Masukan detail pengerjaan untuk jasa yang anda pilih</p>
                        </div>
                        <textarea class="form-control" name="instruksi" form="checkout-form" id="exampleFormControlTextarea1" rows="4" style="resize: none;" required></textarea>
                    </div>

                    <div class="row mt-2 mb-5 ms-3 ms-md-auto">
                        <div class="heading mb-4">
                            <h3>Waktu Pengambilan</h3>
                        </div>
                        <div class="p-1">
                            <p>Tentukan waktu pengambilan pakaian untuk jasa yang anda gunakan</p>
                        </div>
                        <input class="form-control" type="datetime-local" form="checkout-form" id="meeting_time" name="meeting_time" required>

                    </div>

                    <div class='modal fade' id='changeAddress' tabindex='-1' aria-labelledby='changeAddressLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='changeAddressLabel'>Ganti Alamat</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <?php
                                    $id = $data_getprofile['id'];
                                    echo "<input class='d-none' name=id-pengguna form=checkout-form value=$id>";
                                    $query_getalamat = mysqli_query($connect, "CALL getAlamatID('$id')");
                                    mysqli_next_result($connect);
                                    echo "<div class='row row-cols-2 g-4'>";
                                    $nomor = 0;
                                    while ($data_getalamat = mysqli_fetch_array($query_getalamat)) {
                                        echo "<div class=col>";
                                        echo "<form method=POST action=checkout.php?id_alamat=$data_getalamat[id_alamat] class=mb-2>";
                                        echo "<button type=submit class='btn btn-primary'>Pilih alamat ini</button>";
                                        echo "</form>";
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
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        $nomor++;
                                    }
                                    echo "</div>";
                                    ?>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col ms-3 mb-5">
                    <div class="heading mb-4">
                        <h3>Detail Barang</h3>
                    </div>
                    <div class=col>
                        <div class="p-3 card" style="border-radius: 10px; transition: 0.3s;">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $pengiriman = 5000;
                                    //
                                    $query_getcart = mysqli_query($connect, "CALL getKeranjang('$id')");
                                    $data_countcart = mysqli_num_rows($query_getcart);
                                    mysqli_next_result($connect);
                                    $biayajasa = 0;
                                    if ($data_countcart == 0) {
                                        echo "<div class=text-center>";
                                        echo "<h5>Keranjang masih kosong</h5>";
                                        echo "<p>Tambahkan jasa ke keranjang anda</p>";
                                        echo "</div>";
                                    } else {
                                        while ($data_getcart = mysqli_fetch_array($query_getcart)) {
                                            echo "<div class=col-4>";
                                            echo "<img src='https://storage.googleapis.com/uaspweb/img/$data_getcart[image].png' class='card-img' alt=...>";
                                            echo "</div>";
                                            echo "<div class=col-8>";
                                            echo "<h5 class=card-title>$data_getcart[nama] - $data_getcart[jenis]</h5>";
                                            echo "<p class=card-text>";
                                            echo "$data_getcart[jumlah] buah <br>";
                                            echo "Rp. $data_getcart[harga] <br></p>";
                                            echo "<form method=POST action=server/deletecart_process.php?id=$data_getcart[id_keranjang]>";
                                            echo "<button class='btn btn-primary' type=submit>Hapus</button>";
                                            echo "</form>";
                                            echo "</div>";
                                            echo "<span class=border-bottom></span>";
                                            $biayajasa = $biayajasa + $data_getcart['harga'];
                                        }
                                    }
                                    $query_getpromo = mysqli_query($connect, "CALL getTransaksiID('$id')");
                                    $data_getpromo = mysqli_num_rows($query_getpromo);
                                    mysqli_next_result($connect);
                                    if ($data_getpromo == 0) {
                                        $diskon = $biayajasa * 5 / 100;
                                        $biayaakhir = $biayajasa - $diskon;
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'>Total Harga <p style ='color: #198754'>(5% Diskon)</p></div>";
                                        echo "<div class='col-auto'>Rp. $biayajasa<p style ='color: #198754'>- Rp. $diskon</p></div>";
                                        echo "</div>";
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'>Harga Pengiriman</div>";
                                        echo "<div class='col-auto'>Rp. $pengiriman</div>";
                                        echo "<span class='border-bottom'></span>";
                                        echo "</div>";
                                    } else if ($data_getpromo > 0 && $data_getpromo % 5 == 0) {
                                        $biayaakhir = $biayajasa;
                                        $pengiriman = 0;
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'>Total Harga</div>";
                                        echo "<div class='col-auto'>Rp. $biayaakhir</div>";
                                        echo "</div>";
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'><p style='color: #198754'>Harga Pengiriman (Free Ongkir)</p></div>";
                                        echo "<div class='col-auto'><p style='color: #198754'>Rp. $pengiriman</p></div>";
                                        echo "<span class= 'border-bottom'></span>";
                                        echo "</div>";
                                    } else {
                                        $biayaakhir = $biayajasa;
                                        $pengiriman = 5000;
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'>Total Harga</div>";
                                        echo "<div class='col-auto'>Rp. $biayaakhir</div>";
                                        echo "</div>";
                                        echo "<div class='row'>";
                                        echo "<div class='col-auto me-auto'>Harga Pengiriman</div>";
                                        echo "<div class='col-auto'>Rp. $pengiriman</div>";
                                        echo "<span class= 'border-bottom'></span>";
                                        echo "</div>";
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-auto me-auto"><br>
                                            <h5>Total Harga</h5>
                                        </div>
                                        <div class="col-auto"><br>
                                            <h5 style="color: #198754"><?php $total = $biayaakhir + $pengiriman;
                                                                        echo "Rp. $total"; ?></h5>
                                            <input class="d-none" name="total" form="checkout-form" value="<?php echo "$total" ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type='button' class='btn btn-primary' form="checkout-form" data-bs-toggle="modal" data-bs-target="#exampleModal">Lakukan Transaksi</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Konfirmasi lakukan transaksi? Transaksi yang telah dilakukan tidak dapat dibatalkan.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type='submit' class='btn btn-primary' form="checkout-form">Konfimasi</button>
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