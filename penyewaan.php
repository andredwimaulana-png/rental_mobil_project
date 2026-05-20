<?php
include "../koneksi.php";

if (isset($_GET['kembali'])) {
    mysqli_query($koneksi, "CALL pengembalian_mobil('$_GET[kembali]')");
    header("Location: penyewaan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📋 Data Penyewaan</h2>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Daftar Penyewaan</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penyewa</th>
                        <th>Mobil</th>
                        <th>Nomor Plat</th>
                        <th>Lama Sewa</th>
                        <th>Total Biaya</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT penyewaan.*, user.nama, mobil.nama_mobil, mobil.nomor_plat
                FROM penyewaan
                JOIN user ON penyewaan.id_user = user.id_user
                JOIN mobil ON penyewaan.id_mobil = mobil.id_mobil
                ORDER BY id_sewa DESC");

                while ($p = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= $p['nama_mobil']; ?></td>
                        <td><?= $p['nomor_plat']; ?></td>
                        <td><?= $p['lama_sewa']; ?> hari</td>
                        <td>Rp <?= number_format($p['total_biaya']); ?></td>
                        <td><?= $p['tanggal_sewa']; ?></td>
                        <td><?= $p['tanggal_kembali'] ?: '-'; ?></td>
                        <td>
                            <?php if ($p['status'] == 'disewa') { ?>
                                <span class="badge bg-warning text-dark">Disewa</span>
                            <?php } else { ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($p['denda'] > 0) { ?>
                                <span class="text-danger">Rp <?= number_format($p['denda']); ?></span>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($p['status'] == 'disewa') { ?>
                                <a href="penyewaan.php?kembali=<?= $p['id_sewa']; ?>"
                                   class="btn btn-primary btn-sm"
                                   onclick="return confirm('Yakin ingin mengembalikan mobil?')">
                                   Kembalikan
                                </a>
                            <?php } else { ?>
                                <span class="text-success">✔ Selesai</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>