<?php
session_start();
include "../koneksi.php";

if ($_SESSION['role'] != 'penyewa') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['sewa'])) {
    $id_user = $_SESSION['id_user'];
    $id_mobil = $_POST['id_mobil'];
    $lama_sewa = $_POST['lama_sewa'];

    $cek = mysqli_query($koneksi, "SELECT status FROM mobil WHERE id_mobil='$id_mobil'");
    $m = mysqli_fetch_assoc($cek);

    if ($m['status'] == 'tersedia' && $lama_sewa > 0) {
        mysqli_query($koneksi, "CALL sewa_mobil('$id_user', '$id_mobil', '$lama_sewa')");
        $pesan = "Mobil berhasil disewa.";
        $tipe_alert = "success";
    } else {
        $pesan = "Mobil sedang tidak tersedia.";
        $tipe_alert = "danger";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>🚗 Daftar Mobil</h2>
        <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
    </div>

    <?php if (isset($pesan)) { ?>
        <div class="alert alert-<?= $tipe_alert; ?>">
            <?= $pesan; ?>
        </div>
    <?php } ?>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Mobil Rental</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Mobil</th>
                        <th>Nomor Plat</th>
                        <th>Harga per Hari</th>
                        <th>Status</th>
                        <th>Sewa</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT *, status_mobil(status) AS status_text FROM mobil");

                while ($m = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $m['nama_mobil']; ?></td>
                        <td><?= $m['nomor_plat']; ?></td>
                        <td>Rp <?= number_format($m['harga_per_hari']); ?> / hari</td>
                        <td>
                            <?php if ($m['status_text'] == 'Tersedia') { ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Disewa</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($m['status'] == 'tersedia') { ?>
                                <form method="post" class="d-flex gap-2 align-items-center">
                                    <input type="hidden" name="id_mobil" value="<?= $m['id_mobil']; ?>">

                                    <input type="number"
                                           name="lama_sewa"
                                           class="form-control form-control-sm"
                                           style="width: 120px;"
                                           min="1"
                                           placeholder="Hari"
                                           required>

                                    <button type="submit" name="sewa" class="btn btn-success btn-sm">
                                        Sewa
                                    </button>
                                </form>
                            <?php } else { ?>
                                <span class="text-danger">Tidak tersedia</span>
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