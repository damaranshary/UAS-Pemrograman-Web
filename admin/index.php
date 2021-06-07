<?php
include "../server/connection.php";
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['status'])) {
    header("location: ../login.php");
} else if ($_SESSION['email'] != "admin@yukadmin.com") {
    header("location: ../login.php");
} else if ($_SESSION['email'] == "admin@yukadmin.com") {

    $query_jmlhtransaksi = mysqli_query($connect, "SELECT count(id_transaksi) AS jumlah FROM transaksi_lengkap");
    $data_jmlhtransaksi = mysqli_fetch_assoc($query_jmlhtransaksi);
    $jmlhTransaksi = $data_jmlhtransaksi['jumlah'];

    $query_jmlhjasa = mysqli_query($connect, "SELECT count(id) AS jumlah FROM jasa");
    $data_jmlhjasa = mysqli_fetch_assoc($query_jmlhjasa);
    $jmlhJasa = $data_jmlhjasa['jumlah'];

    $query_jmlhsaran = mysqli_query($connect, "SELECT count(id) AS jumlah FROM saran_komplain WHERE statusPEsan='Belum direspon'");
    $data_jmlhsaran = mysqli_fetch_assoc($query_jmlhsaran);
    $jmlhSaranKomplain = $data_jmlhsaran['jumlah'];

    $query_jmlhtransaksi = mysqli_query($connect, "SELECT count(id_transaksi) AS jumlah FROM transaksi_lengkap");
    $data_jmlhtransaksi = mysqli_fetch_assoc($query_jmlhtransaksi);
    $jmlhTransaksi = $data_jmlhtransaksi['jumlah'];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include "assets/components/header.php"
        ?>
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Halaman Admin</title>
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
                            <a href="index.php" class="nav-link text-truncate text-white active">
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
                            <a href="saran-komplain.php" class="nav-link text-truncate text-white">
                                <i class="fs-4 bi-chat-left-dots-fill"></i> <span class="ms-1 d-none d-sm-inline">Saran dan Komplain</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card h-100 p-4">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="120" height="120" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#2a4f96">
                                            <path d="M94.6,78.83333c-2.86667,7.16667 -8.6,12.9 -15.76667,16.48333v48.01667h64.5v-64.5z" opacity="0.3"></path>
                                            <path d="M64.5,28.66667c-19.7902,0 -35.83333,16.04313 -35.83333,35.83333c0,19.7902 16.04313,35.83333 35.83333,35.83333c19.7902,0 35.83333,-16.04313 35.83333,-35.83333c0,-19.7902 -16.04313,-35.83333 -35.83333,-35.83333z" opacity="0.3"></path>
                                            <path d="M114.66667,43l21.5,-14.33333v28.66667zM57.33333,129l-21.5,-14.33333v28.66667zM100.33333,71.66667c-1.43333,5.01667 -4.3,10.03333 -7.16667,14.33333h43v50.16667h-50.16667v-43.71667c-4.3,2.86667 -9.31667,5.01667 -14.33333,5.73333v37.98333c0,7.88333 6.45,14.33333 14.33333,14.33333h50.16667c7.88333,0 14.33333,-6.45 14.33333,-14.33333v-50.16667c0,-7.88333 -6.45,-14.33333 -14.33333,-14.33333zM68.08333,47.3l-16.48333,6.45v9.31667l7.16667,-2.86667v21.5h11.46667v-34.4z"></path>
                                            <path d="M64.5,107.5c-23.65,0 -43,-19.35 -43,-43c0,-23.65 19.35,-43 43,-43c23.65,0 43,19.35 43,43c0,23.65 -19.35,43 -43,43zM64.5,35.83333c-15.76667,0 -28.66667,12.9 -28.66667,28.66667c0,15.76667 12.9,28.66667 28.66667,28.66667c15.76667,0 28.66667,-12.9 28.66667,-28.66667c0,-15.76667 -12.9,-28.66667 -28.66667,-28.66667zM100.33333,100.33333h21.5v14.33333h-21.5z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-4 text-muted">Total Transaksi</h6>
                                    <h3 class="card-title mb-4"><?php echo "$jmlhTransaksi Transaksi" ?></h3>
                                    <a href="transaksi.php"><button type="button" class="btn btn-primary">Lihat</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-4">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="120" height="120" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g>
                                            <path d="M86,157.66667c-39.517,0 -71.66667,-32.14967 -71.66667,-71.66667c0,-39.517 32.14967,-71.66667 71.66667,-71.66667c39.517,0 71.66667,32.14967 71.66667,71.66667c0,39.517 -32.14967,71.66667 -71.66667,71.66667z" fill="#2a4f96"></path>
                                            <path d="M75.25,64.5c0,5.934 -4.816,10.75 -10.75,10.75c-5.934,0 -10.75,-4.816 -10.75,-10.75c0,-5.934 4.816,-10.75 10.75,-10.75c5.934,0 10.75,4.816 10.75,10.75zM118.25,64.5c0,5.934 -4.816,10.75 -10.75,10.75c-5.934,0 -10.75,-4.816 -10.75,-10.75c0,-5.934 4.816,-10.75 10.75,-10.75c5.934,0 10.75,4.816 10.75,10.75zM75.25,107.5c0,5.934 -4.816,10.75 -10.75,10.75c-5.934,0 -10.75,-4.816 -10.75,-10.75c0,-5.934 4.816,-10.75 10.75,-10.75c5.934,0 10.75,4.816 10.75,10.75zM118.25,107.5c0,5.934 -4.816,10.75 -10.75,10.75c-5.934,0 -10.75,-4.816 -10.75,-10.75c0,-5.934 4.816,-10.75 10.75,-10.75c5.934,0 10.75,4.816 10.75,10.75z" fill="#1a237e"></path>
                                            <path d="M68.08333,107.55733c-0.9245,0 -1.83467,-0.35117 -2.53342,-1.03558c-1.40108,-1.40108 -1.40108,-3.66575 0,-5.08117l35.83333,-35.89067c1.40108,-1.40108 3.66575,-1.40108 5.06683,0c1.40108,1.40108 1.40108,3.66575 0,5.06683l-35.83333,35.89067c-0.69875,0.69875 -1.60892,1.04992 -2.53342,1.04992z" fill="#ffffff"></path>
                                            <path d="M103.91667,107.55733c0.9245,0 1.83467,-0.35117 2.53342,-1.03558c1.40108,-1.40108 1.40108,-3.66575 0,-5.08117l-35.83333,-35.89067c-1.40108,-1.40108 -3.66575,-1.40108 -5.06683,0c-1.40108,1.40108 -1.40108,3.66575 0,5.06683l35.83333,35.89067c0.69875,0.69875 1.60892,1.04992 2.53342,1.04992z" fill="#ffffff"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-4 text-muted">Jumlah Jasa</h6>
                                    <h3 class="card-title mb-4"><?php echo "$jmlhJasa Jasa" ?></h3>
                                    <a href="jasa.php"><button type="button" class="btn btn-primary">Lihat</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card h-100 p-4">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="120" height="120" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#2a4f96">
                                            <path d="M137.6,0c-18.96816,0 -34.4,15.43184 -34.4,34.4c0,6.95568 2.06153,13.59881 5.97969,19.32985l-5.805,17.42172c-0.46096,1.376 -0.00661,2.89153 1.13547,3.78937c0.62264,0.49192 1.37305,0.73906 2.12985,0.73906c0.63296,0 1.26006,-0.17318 1.82078,-0.52406l15.02985,-9.39281c4.45136,2.01584 9.19017,3.03687 14.10937,3.03687c18.96816,0 34.4,-15.43184 34.4,-34.4c0,-18.96816 -15.43184,-34.4 -34.4,-34.4zM134.84531,17.2h5.50937c0.344,0 0.68531,0.34131 0.68531,0.68531v19.26937c0,0.344 -0.34131,0.68531 -0.68531,0.68531h-5.50937c-0.344,0 -0.68531,-0.34131 -0.68531,-0.68531v-19.26937c0,-0.344 0.34131,-0.68531 0.68531,-0.68531zM63.27719,24.03297c-11.7476,0.21328 -20.33669,3.80658 -25.53797,10.66938c-6.09224,8.04272 -7.2384,20.16017 -3.41312,36.04609c-1.41728,1.78536 -2.44874,4.48995 -2.02906,7.99531c0.83592,6.88 3.57851,9.78084 5.8386,10.9986c1.02168,5.23912 3.66118,11.51121 6.55078,14.57969c0.00344,1.61336 0.00984,3.10202 0.02016,4.6225c0.01376,1.91952 0.03015,3.88892 0.03359,6.235c-1.9952,4.19336 -8.57151,6.73632 -15.52031,9.4264c-12.39776,4.7988 -27.82197,10.77322 -28.98469,29.9925l-0.22172,3.64828h127.23969l-0.215,-3.64828c-1.15928,-19.21928 -16.58693,-25.26943 -28.98469,-30.13359c-6.93848,-2.72104 -13.51479,-5.30368 -15.52031,-9.4936c0.04472,-4.2312 0.05375,-7.21438 0.05375,-10.86422c2.88616,-3.04096 5.52238,-9.21157 6.54406,-14.36469c2.26352,-1.21432 5.00612,-4.11188 5.8386,-10.99188c0.41968,-3.43656 -0.559,-6.09901 -1.935,-7.88781c1.8576,-6.35024 5.53249,-22.36231 -0.90031,-32.72703c-2.74168,-4.41696 -6.88651,-7.20374 -12.34235,-8.29766c-3.05472,-3.75992 -8.81253,-5.805 -16.51469,-5.805zM134.84531,44.72h5.50937c0.344,0 0.68531,0.34131 0.68531,0.68531v5.50937c0,0.344 -0.34131,0.68531 -0.68531,0.68531h-5.50937c-0.344,0 -0.68531,-0.34131 -0.68531,-0.68531v-5.50937c0,-0.344 0.34131,-0.68531 0.68531,-0.68531z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-4 text-muted">Saran dan Komplain</h6>
                                    <h3 class="card-title mb-4"><?php echo "$jmlhSaranKomplain belum di respon" ?></h3>
                                    <a href="saran-komplain.php"><button type="button" class="btn btn-primary">Lihat</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 p-4">
                        <div class="row">
                            <div class="col text-center my-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="120" height="120" viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                        <g fill="#2a4f96">
                                            <path d="M28.44271,14.33333c-3.83417,0 -6.94271,3.10854 -6.94271,6.94271v111.30729c0,13.83167 9.64633,25.08333 21.5,25.08333h93.16667c11.85367,0 21.5,-11.25167 21.5,-25.08333c0,-13.83167 -9.64633,-25.08333 -21.5,-25.08333v-86.22396c0,-3.83417 -3.10854,-6.94271 -6.94271,-6.94271h-9.46224c-2.37217,0 -4.78991,1.09807 -5.86491,3.2194c-1.17533,2.33633 -3.60181,3.94727 -6.39681,3.94727c-2.795,0 -5.22148,-1.61093 -6.39681,-3.94727c-1.075,-2.12133 -3.49274,-3.2194 -5.86491,-3.2194h-4.14322c-2.37217,0 -4.78991,1.09807 -5.86491,3.2194c-1.17533,2.33633 -3.60181,3.94727 -6.39681,3.94727c-2.795,0 -5.22148,-1.61093 -6.39681,-3.94727c-1.075,-2.12133 -3.49274,-3.2194 -5.86491,-3.2194h-4.14323c-2.37217,0 -4.78991,1.09807 -5.86491,3.2194c-1.17533,2.33633 -3.60181,3.94727 -6.39681,3.94727c-2.795,0 -5.22148,-1.61093 -6.39681,-3.94727c-1.075,-2.12133 -3.49274,-3.2194 -5.86491,-3.2194zM50.16667,43h57.33333c3.956,0 7.16667,3.21067 7.16667,7.16667c0,3.956 -3.21067,7.16667 -7.16667,7.16667h-57.33333c-3.956,0 -7.16667,-3.21067 -7.16667,-7.16667c0,-3.956 3.21067,-7.16667 7.16667,-7.16667zM50.16667,71.66667h35.83333c3.956,0 7.16667,3.21067 7.16667,7.16667c0,3.956 -3.21067,7.16667 -7.16667,7.16667h-35.83333c-3.956,0 -7.16667,-3.21067 -7.16667,-7.16667c0,-3.956 3.21067,-7.16667 7.16667,-7.16667zM43,121.83333c3.81267,0 7.16667,5.02383 7.16667,10.75c0,5.72617 -3.354,10.75 -7.16667,10.75c-3.81267,0 -7.16667,-5.02383 -7.16667,-10.75c0,-5.72617 3.354,-10.75 7.16667,-10.75zM62.3444,121.83333h73.82227c3.81267,0 7.16667,5.02383 7.16667,10.75c0,5.72617 -3.354,10.75 -7.16667,10.75h-73.82227c1.34172,-3.27055 2.1556,-6.88864 2.1556,-10.75c0,-3.86283 -0.81543,-7.482 -2.1556,-10.75z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-4 text-muted">Log Transaksi</h6>
                                    <h3 class="card-title mb-4">Daftar Log Transaksi </h3>
                                    <a href="history-update-transaksi.php"><button type="button" class="btn btn-primary">Lihat</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
}
?>