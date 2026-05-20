<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Loading...</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Auto Redirect -->
    <meta http-equiv="refresh" content="2;url=<?php 
    if (isset($_SESSION['role'])) {
        echo ($_SESSION['role'] == 'admin') ? 'admin/dashboard.php' : 'penyewa/dashboard.php';
    } else {
        echo 'login.php';
    }
    ?>">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">

        <div class="spinner-border text-primary mb-3"></div>

        <h4>Loading Aplikasi Rental Mobil...</h4>
        <p class="text-muted">Mohon tunggu sebentar</p>

    </div>
</div>

</body>
</html>