<?php
session_start();
if ($_SESSION['role'] != 'penyewa') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penyewa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">🚗 Rental Mobil - Penyewa</span>
        <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="alert alert-info">
        Selamat datang, <b><?php echo $_SESSION['nama']; ?></b>
    </div>

    <!-- Menu -->
    <div class="row">

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">🚗 Lihat Mobil</h5>
                    <p class="card-text">Lihat daftar mobil yang tersedia.</p>
                    <a href="mobil.php" class="btn btn-primary">Masuk</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">🛒 Sewa Mobil</h5>
                    <p class="card-text">Lakukan penyewaan mobil.</p>
                    <a href="mobil.php" class="btn btn-success">Sewa Sekarang</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>