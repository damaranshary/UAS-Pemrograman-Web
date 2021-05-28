<?php include "server/connection.php";
session_start();
?>
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
                
                </form>
            </div>
        </div>

    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>