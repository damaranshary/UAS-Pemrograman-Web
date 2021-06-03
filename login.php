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
                <form action="server/login_process.php" method="POST" style="width: 350px;">
                    <div class="text-center">
                        <img class="mb-3" src="assets/img/logo.svg" alt="" width="120px">
                        <h2 class="mb-5">Selamat datang!</h2>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" minlength="8" required>
                    </div>

                    <p class="d-none"><?php $login_error = mysqli_real_escape_string($connect, $_GET['login_error']); ?></p>
                    <?php
                    if (empty($login_error)) {
                        $alert =" ";
                    }
                    else{
                        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Email atau Password anda salah.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                    ?>
                    
                    <div class="row mb-3">
                        <div class="col">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Masuk</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <a href="register.php" class="btn btn-outline-primary">Registrasi</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="forget-password.php" style="text-decoration: none; color: black;">Lupa Password</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>