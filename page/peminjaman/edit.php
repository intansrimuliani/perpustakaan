<?php
include("../../database/config.php");

// Cek apakah id_anggota ada
if (empty($_GET['id_peminjaman'])) {
    echo "<script> window.location.href = 'index.php?page=peminjaman' </script>";
    exit();
}

$id_peminjaman = $_GET['id_peminjaman'];

// Validasi ID peminjaman
if (!ctype_digit($id_peminjaman)) {
    echo "<script> window.location.href = 'index.php?page=peminjaman' </script>";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $nama_buku = $_POST['nama_buku'];
    $jumlah_peminjaman = $_POST['jumlah_peminjaman'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
     
    $pdo = config::connect();
    $sql = "UPDATE peminjaman SET nama_anggota = ?, nama_buku = ?, jumlah_peminjaman = ?, tanggal_peminjaman = ? WHERE id_peminjaman = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_anggota, $nama_buku, $jumlah_peminjaman, $tanggal_peminjaman, $id_peminjaman));

    echo "<script> window.location.href = 'index.php?page=peminjaman' </script>";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_peminjaman));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=peminjaman' </script>";
        exit();
    }

    $nama_anggota = $data['nama_anggota'];
    $nama_buku = $data['nama_buku'];
    $jumlah_peminjaman = $data['jumlah_peminjaman'];
    $tanggal_peminjaman = $data['tanggal_peminjaman'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Peminjaman</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota" required value="<?php echo htmlspecialchars($nama_anggota); ?>">
            </div>

            <div class="form-group">
                <label>Nama Buku</label>
                <input name="nama_buku" type="text" class="form-control" placeholder="Nama Buku" required value="<?php echo htmlspecialchars($nama_buku); ?>">
            </div>

            <div class="form-group">
                <label>Jumlah Peminjaman</label>
                <input name="jumlah_peminjaman" type="text" class="form-control" placeholder="Jumlah Peminjaman" required value="<?php echo htmlspecialchars($jumlah_peminjaman); ?>">
            </div>

            <div class="form-group">
                <label>Tanggal Peminjaman</label>
                <input name="tanggal_peminjaman" type="text" class="form-control" placeholder="Tanggal Peminjaman" required value="<?php echo htmlspecialchars($tanggal_peminjaman); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=peminjaman" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
