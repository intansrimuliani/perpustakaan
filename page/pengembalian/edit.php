<?php 
include("../../database/config.php");

// Cek apakah id_pengembalian ada
if (empty($_GET['id_pengembalian'])) {
    echo "<script> window.location.href = 'index.php?page=pengembalian' </script> ";
    exit();
}

$id_pengembalian = $_GET['id_pengembalian'];

// Validasi ID pengembalian
if (!ctype_digit($id_pengembalian)) {
    echo "<script> window.location.href = 'index.php?page=pengembalian' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $pdo = config::connect();
    $sql = "UPDATE pengembalian SET nama_anggota = ?, tanggal_kembali = ? WHERE id_pengembalian = ?";
    $q = $pdo->prepare($sql);
    $q->execute([$nama_anggota, $tanggal_kembali, $id_pengembalian]);

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=pengembalian' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM pengembalian WHERE id_pengembalian = ?";
    $q = $pdo->prepare($sql);
    $q->execute([$id_pengembalian]);
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=pengembalian' </script> ";
        exit();
    }

    $nama_anggota = $data['nama_anggota'];
    $tanggal_kembali = $data['tanggal_kembali'];
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Pengembalian</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota" required value="<?php echo htmlspecialchars($nama_anggota); ?>">
            </div>

            <div class="form-group">
                <label>Tanggal Pengembalian</label>
                <input name="tanggal_kembali" type="text" class="form-control" placeholder="Tanggal kembali" required value="<?php echo htmlspecialchars($tanggal_kembali); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengembalian" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jq
