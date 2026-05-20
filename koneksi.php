<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rental_mobil";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// set timezone (optional tapi bagus)
date_default_timezone_set('Asia/Jakarta');
?>