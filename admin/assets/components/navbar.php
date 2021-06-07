<?php

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container py-2 py-lg-2">
        <a class="navbar-brand">
            <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                <i class="bi bi-list fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
            </button>
            <img src="assets/img/logo-admin.svg" alt="" width="" height="25">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="py-2 py-lg-0">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <!-- <button class="btn button-primary btn-primary px-4 me-2" type="submit">Login</button> -->
                        <a role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; text-decoration: none;"><i class="fas fa-user me-2"></i>Admin</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../server/logout_process.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>