<?php
include "../koneksi.php";

$where = "";
if (isset($_GET['tanggal']) && $_GET['tanggal'] != "") {
    $tanggal = $_GET['tanggal'];
    $where = "WHERE penyewaan.tanggal_sewa='$tanggal'";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>📊 Laporan Penyewaan per Tanggal</h4>
        </div>

        <div class="card-body">

            <a href="dashboard.php" class="btn btn-secondary mb-3">⬅ Kembali</a>

            <form method="get" class="row g-3 mb-3">
                <div class="col-auto">
                    <input type="date" name="tanggal" class="form-control"
                           value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penyewa</th>
                        <th>Mobil</th>
                        <th>Nomor Plat</th>
                        <th>Lama Sewa</th>
                        <th>Total Biaya</th>
                        <th>Tanggal Sewa</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT penyewaan.*, user.nama, mobil.nama_mobil, mobil.nomor_plat
                FROM penyewaan
                JOIN user ON penyewaan.id_user = user.id_user
                JOIN mobil ON penyewaan.id_mobil = mobil.id_mobil
                $where
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
                    </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>