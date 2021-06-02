<?php
include "server/connection.php";
$email = $_SESSION['email'];
$query = mysqli_query($connect, "SELECT name FROM users WHERE email='$email'");
$row = mysqli_fetch_assoc($query);
$name = $row["name"];

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container py-2 py-lg-3">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.svg" alt="" width="" height="80">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="py-2 py-lg-0">
                <ul class="navbar-nav">
                    <li class="nav-item me-4">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <i class="fas fa-home me-2"></i>Halaman Utama
                        </a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="promo.php"><i class="fas fa-percentage me-2"></i>Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">
                            <i class="fas fa-shopping-cart me-2"></i>Checkout
                        </a>
                    </li>
                    <li class="nav-item dropdown ms-lg-3">
                        <!-- <button class="btn button-primary btn-primary px-4 me-2" type="submit">Login</button> -->
                        <a class="nav-link" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user me-2"></i><?php echo "$name" ?></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                            <li><a class="dropdown-item" href="server/logout_process.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>