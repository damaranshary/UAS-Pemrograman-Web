<?php
    session_start();
    include "server/connection.php";
    if (!isset($_SESSION['email'])){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "assets/components/header.php"
        ?>
        <link rel="stylesheet" href="assets/css/style.css">h
        <title>Hello, world!</title>
    <title>Document</title>
</head>
<body>
    <?php
    include "assets/components/navbar-alt.php"
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="heading">
                <h3>Detil Alamat<h3>
                </div>
            </div>
            <div class=" col">
                <div class="heading">
                <h3>Detil Barang</h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>