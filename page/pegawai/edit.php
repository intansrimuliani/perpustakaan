<?php 
include("../../database/config.php");

// Cek apakah id_pegawai ada
if (empty($_GET['id_pegawai'])) {
    echo "<script> window.location.href = 'index.php?page=pegawai' </script> ";
    exit();
}

$id_pegawai = $_GET['id_pegawai'];

// Validasi ID pegawai
if (!ctype_digit($id_pegawai)) {
    echo "<script> window.location.href = 'index.php?page=pegawai' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $alamat_pegawai = $_POST['alamat_pegawai'];

    $pdo = config::connect();
    $sql = "UPDATE pegawai SET nama_pegawai = ?, alamat_pegawai = ? WHERE id_pegawai = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_pegawai, $alamat_pegawai, $id_pegawai));

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=pegawai' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM pegawai WHERE id_pegawai = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_pegawai));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=pegawai' </script> ";
        exit();
    }

    $nama_pegawai = $data['nama_pegawai'];
    $alamat_pegawai = $data['alamat_pegawai'];
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit pegawai</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama pegawai</label>
                <input name="nama_pegawai" type="text" class="form-control" placeholder="Nama pegawai" required value="<?php echo htmlspecialchars($nama_pegawai); ?>">
            </div>

            <div class="form-group">
                <label>Alamat pegawai</label>
                <input name="alamat_pegawai" type="text" class="form-control" placeholder="Alamat pegawai" required value="<?php echo htmlspecialchars($alamat_pegawai); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pegawai" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
