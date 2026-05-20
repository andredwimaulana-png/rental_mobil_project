<?php
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mobil WHERE id_mobil='$id'");
$m = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE mobil SET
        nama_mobil='$_POST[nama_mobil]',
        nomor_plat='$_POST[nomor_plat]',
        harga_per_hari='$_POST[harga_per_hari]',
        status='$_POST[status]'
        WHERE id_mobil='$id'");
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Edit Mobil</h4>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nama Mobil</label>
                    <input type="text" name="nama_mobil" class="form-control"
                        value="<?= $m['nama_mobil']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Plat</label>
                    <input type="text" name="nomor_plat" class="form-control"
                        value="<?= $m['nomor_plat']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga per Hari</label>
                    <input type="number" name="harga_per_hari" class="form-control"
                        value="<?= $m['harga_per_hari']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Mobil</label>
                    <select name="status" class="form-control" required>
                        <option value="tersedia" <?= ($m['status'] == 'tersedia') ? 'selected' : ''; ?>>
                            Tersedia
                        </option>
                        <option value="disewa" <?= ($m['status'] == 'disewa') ? 'selected' : ''; ?>>
                            Disewa
                        </option>
                    </select>
                </div>

                <button type="submit" name="update" class="btn btn-success">
                    💾 Update
                </button>

                <a href="mobil.php" class="btn btn-secondary">
                    ⬅ Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>