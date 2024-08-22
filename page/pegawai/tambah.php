<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Tambah pegawai</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_pegawai">Nama</label>
                        <input id="nama_pegawai" name="nama_pegawai" type="text" class="form-control" placeholder="Masukkan Nama pegawai" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_pegawai">Alamat</label>
                        <input id="alamat_pegawai" name="alamat_pegawai" class="form-control" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=pegawai" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
    // Retrieve form data
    $nama_pegawai = $_POST['nama_pegawai'];
    $alamat_pegawai = $_POST['alamat_pegawai'];

    // Include required files
    include("../../database/config.php");
    include("../../class/pegawai.php");

    try {
        // Create a database connection
        $pdo = Config::connect();
        // Get an instance of the pegawai class
        $pegawai = pegawai::getInstance($pdo);
        // Add the new member
        if ($pegawai->tambah($nama_pegawai, $alamat_pegawai)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php?page=pegawai';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } catch (Exception $e) {
        // Handle exceptions
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
}
?>
