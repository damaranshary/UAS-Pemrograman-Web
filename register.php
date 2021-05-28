<?php include "server/connection.php";
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "assets/components/header.php"
    ?>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Document</title>
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
                <form action="server/register_process.php" method="POST" style="width: 300px;">
                    <img class="mb-3" src="assets/img/logo.svg" alt="" width="100px">
                    <h2 class="mb-5">Create your account</h2>
                    <!-- Name input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required />
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary button-primary">Register</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <a href="login.php" class="btn button-secondary">Login</a>
                            </div>
                        </div>
                    </div>
                    <a href="index.php" class="text-black-50" style="text-decoration: none;"><i class="fas fa-chevron-left me-2"></i>Return to homepage</a>
                </form>
            </div>
        </div>

    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>