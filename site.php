<?php
session_start();
include "server/connection.php";

$id = mysqli_real_escape_string($connect, $_GET['kode_barang']);
//Remove LIMIT 1 to show/do this to all results.
$query = 'SELECT `content` FROM `pages` WHERE `id` = ' . $id . ' LIMIT 1';
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);

// Echo page content
echo $row['content'];
