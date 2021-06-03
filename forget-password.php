<?php include "server/connection.php";
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <p class="d-none"><?php $status_update = mysqli_real_escape_string($connect, $_GET['status']); ?></p>
    <?php
    if (empty($status_update)) {
        $alert = "";
    } else {
        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Email yang anda masukan salah
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>
    <div class="d-md-flex h-md-100 align-items-center">

        <!-- First Half -->

        <div class="col-md-6 p-0 h-md-100" style="background-color: #E2E7FB">
            <div class="d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
                <div class="logoarea pt-5 pb-5">
                    <img src="assets/img/login.svg" alt="" width="400px">
                </div>
            </div>
        </div>

        <!-- Second Half -->

        <div class="col-md-6 p-0 bg-white h-md-100 loginarea">
            <div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center">
                <form action="server/update-pass_process.php" method="POST" style="width: 350px;">
                    <div class="text-center">
                        <h2 class="mb-5">Ganti password anda</h2>
                        <?php echo "$alert" ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password baru</label>
                        <input type="password" class="form-control" name="new_pass" id="new_pass">
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Ganti Password</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <a href="login.php" class="btn btn-outline-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>