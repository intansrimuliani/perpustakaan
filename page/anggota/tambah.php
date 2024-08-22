<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Tambah Anggota</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_anggota">Nama</label>
                        <input id="nama_anggota" name="nama_anggota" type="text" class="form-control" placeholder="Masukkan Nama Anggota" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_anggota">Alamat</label>
                        <input id="alamat_anggota" name="alamat_anggota" class="form-control" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input id="no_telepon" name="no_telepon" type="text" class="form-control" placeholder="Masukkan No Telp" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=anggota" class="btn btn-secondary">Kembali</a>
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
    $nama_anggota = $_POST['nama_anggota'];
    $alamat_anggota = $_POST['alamat_anggota'];
    $no_telepon = $_POST['no_telepon'];

    // Include required files
    include("../../database/config.php");
    include("../../class/anggota.php");

    try {
        // Create a database connection
        $pdo = Config::connect();
        // Get an instance of the Anggota class
        $anggota = Anggota::getInstance($pdo);
        // Add the new member
        if ($anggota->tambah($nama_anggota, $alamat_anggota, $no_telepon)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php?page=anggota';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } catch (Exception $e) {
        // Handle exceptions
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
}
?>
