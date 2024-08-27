<?php 
include("../../database/config.php");

// Cek apakah id_anggota ada
if (empty($_GET['id_anggota'])) {
    echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
    exit();
}

$id_anggota = $_GET['id_anggota'];

// Validasi ID anggota
if (!ctype_digit($id_anggota)) {
    echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $alamat_anggota = $_POST['alamat_anggota'];
    $no_telepon = $_POST['no_telepon'];

    $pdo = config::connect();
    $sql = "UPDATE anggota SET nama_anggota = ?, alamat_anggota = ?, no_telepon = ? WHERE id_anggota = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_anggota, $alamat_anggota, $no_telepon, $id_anggota));

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM anggota WHERE id_anggota = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_anggota));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
        exit();
    }

    $nama_anggota = $data['nama_anggota'];
    $alamat_anggota = $data['alamat_anggota'];
    $no_telepon = $data['no_telepon']; // Pastikan kolom ini ada di tabel
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit anggota</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit anggota</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama anggota" required value="<?php echo htmlspecialchars($nama_anggota); ?>">
            </div>

            <div class="form-group">
                <label>Alamat anggota</label>
                <input name="alamat_anggota" type="text" class="form-control" placeholder="Alamat anggota" required value="<?php echo htmlspecialchars($alamat_anggota); ?>">
            </div>

            <div class="form-group">
                <label>No Telp</label>
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_telepon); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=anggota" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.j
