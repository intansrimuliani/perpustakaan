<?php
if (isset($_POST['simpan'])) {
    // Retrieve form data
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);

    // Include required files
    include("../../database/config.php");
    include("../../class/buku.php");

    try {
        // Create a database connection
        $pdo = Config::connect();
        // Get an instance of the buku class
        $buku = buku::getInstance($pdo);
        // Tambah the new buku
        if ($buku->add($judul, $pengarang, $penerbit)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php?page=buku';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } catch (Exception $e) {
        // Handle exceptions
        echo "<script>alert('Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Tambah buku</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukkan judul buku" required>
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input id="pengarang" name="pengarang" class="form-control" placeholder="Masukkan pengarang" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input id="penerbit" name="penerbit" type="text" class="form-control" placeholder="Masukkan penerbit" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=buku" class="btn btn-secondary">Kembali</a>
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
