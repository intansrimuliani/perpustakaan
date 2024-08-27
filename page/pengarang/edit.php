<?php 
include("../../database/config.php");

// Cek apakah id_pengarang ada
if (empty($_GET['id_pengarang'])) {
    echo "<script> window.location.href = 'index.php?page=pengarang' </script> ";
    exit();
}

$id_pengarang = $_GET['id_pengarang'];

// Validasi ID pengarang
if (!ctype_digit($id_pengarang)) {
    echo "<script> window.location.href = 'index.php?page=pengarang' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_pengarang = $_POST['nama_pengarang'];
    $alamat_pengarang = $_POST['alamat_pengarang'];

    $pdo = config::connect();
    $sql = "UPDATE pengarang SET nama_pengarang = ?, alamat_pengarang = ? WHERE id_pengarang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_pengarang, $alamat_pengarang, $id_pengarang));

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=pengarang' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM pengarang WHERE id_pengarang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_pengarang));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=pengarang' </script> ";
        exit();
    }

    $nama_pengarang = $data['nama_pengarang'];
    $alamat_pengarang = $data['alamat_pengarang'];
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit pengarang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit pengarang</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama pengarang</label>
                <input name="nama_pengarang" type="text" class="form-control" placeholder="Nama pengarang" required value="<?php echo htmlspecialchars($nama_pengarang); ?>">
            </div>

            <div class="form-group">
                <label>Alamat pengarang</label>
                <input name="alamat_pengarang" type="text" class="form-control" placeholder="Alamat pengarang" required value="<?php echo htmlspecialchars($alamat_pengarang); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengarang" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
