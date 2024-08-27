<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5"> 
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Tambah pengembalian</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_anggota">Nama</label>
                        <input id="nama_anggota" name="nama_anggota" type="text" class="form-control" placeholder="Masukkan Nama anggota" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kembali">Alamat</label>
                        <input id="tanggal_kembali" name="tanggal_kembali" class="form-control" placeholder="Masukkan tanggal kembali" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=pengembalian" class="btn btn-secondary">Kembali</a>
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
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Include required files
    include("../../database/config.php");
    include("../../class/pengembalian.php");

    try {
        // Create a database connection
        $pdo = Config::connect();
        // Get an instance of the pengembalian class
        $pengembalian = pengembalian::getInstance($pdo);
        // Add the new member
        if ($pengembalian->tambah($nama_anggota, $tanggal_kembali)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php?page=pengembalian';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } catch (Exception $e) {
        // Handle exceptions
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
}
?>
