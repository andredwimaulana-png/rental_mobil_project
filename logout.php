<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Auto redirect -->
    <meta http-equiv="refresh" content="2;url=login.php">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">

        <div class="alert alert-success">
            Anda berhasil logout
        </div>

        <div class="spinner-border text-primary"></div>
        <p class="mt-2">Mengalihkan ke halaman login...</p>

    </div>
</div>

</body>
</html>