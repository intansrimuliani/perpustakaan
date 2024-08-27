<?php 
include("../../database/config.php");

// Cek apakah id_penerbit ada
if (empty($_GET['id_penerbit'])) {
    echo "<script> window.location.href = 'index.php?page=penerbit' </script> ";
    exit();
}

$id_penerbit = $_GET['id_penerbit'];

// Validasi ID penerbit
if (!ctype_digit($id_penerbit)) {
    echo "<script> window.location.href = 'index.php?page=penerbit' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $nama_penerbit = $_POST['nama_penerbit'];
    $alamat_penerbit = $_POST['alamat_penerbit'];

    $pdo = config::connect();
    $sql = "UPDATE penerbit SET nama_penerbit = ?, alamat_penerbit = ? WHERE id_penerbit = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_penerbit, $alamat_penerbit, $id_penerbit));

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=penerbit' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM penerbit WHERE id_penerbit = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_penerbit));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=penerbit' </script> ";
        exit();
    }

    $nama_penerbit = $data['nama_penerbit'];
    $alamat_penerbit = $data['alamat_penerbit'];
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit penerbit</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit penerbit</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama penerbit</label>
                <input name="nama_penerbit" type="text" class="form-control" placeholder="Nama penerbit" required value="<?php echo htmlspecialchars($nama_penerbit); ?>">
            </div>

            <div class="form-group">
                <label>Alamat penerbit</label>
                <input name="alamat_penerbit" type="text" class="form-control" placeholder="Alamat penerbit" required value="<?php echo htmlspecialchars($alamat_penerbit); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=penerbit" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
