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
                        <a href="saran-komplain.php" class="nav-link text-truncate text-white active">
                            <i class="fs-4 bi-chat-left-dots-fill"></i> <span class="ms-1 d-none d-sm-inline">Saran dan Komplain</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>