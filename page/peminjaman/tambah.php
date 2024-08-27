<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Tambah Peminjaman</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_anggota">Nama Anggota</label>
                        <input id="nama_anggota" name="nama_anggota" type="text" class="form-control" placeholder="Masukkan Nama anggota" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_buku">Nama Buku</label>
                        <input id="nama_buku" name="nama_buku" type="text" class="form-control" placeholder="Masukkan Nama Buku" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peminjaman">Jumlah Peminjaman</label>
                        <input id="jumlah_peminjaman" name="jumlah_peminjaman" class="form-control" placeholder="Masukkan Jumlah " required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_peminjaman">tanggal Peminjaman</label>
                        <input id="tanggal_peminjaman" name="tanggal_peminjaman" type="text" class="form-control" placeholder="Masukkan Tanggal " required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=peminjaman" class="btn btn-secondary">Kembali</a>
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
    $nama_buku = $_POST['nama_buku'];
    $jumlah_peminjaman = $_POST['jumlah_peminjaman'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];

    // Include required files
    include("../../database/config.php");
    include("../../class/peminjaman.php");

    try {
        // Create a database connection
        $pdo = Config::connect();
        // Get an instance of the peminjaman class
        $peminjaman = peminjaman::getInstance($pdo);
        // tambah the new peminjaman
        if ($peminjaman->tambah($nama_anggota, $nama_buku, $jumlah_peminjaman, $tanggal_peminjaman)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php?page=peminjaman';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } catch (Exception $e) {
        // Handle exceptions
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
}
?>
