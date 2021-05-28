<?php
//function start lagi
session_start();

//cek apakah session terdaftar
if ($_SESSION['status'] = "Login success!") {

    //session terdaftar, saatnya logout
    session_unset();
    session_destroy();
    
    header("Location: ../login.php");
} else {

    //variabel session salah, user tidak seharusnya ada dihalaman ini. Kembalikan ke login
    header("Location: ../login.php");
}
