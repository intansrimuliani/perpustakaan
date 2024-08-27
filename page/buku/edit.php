<?php 
include("../../database/config.php");

// Cek apakah id_buku ada
if (empty($_GET['id_buku'])) {
    echo "<script> window.location.href = 'index.php?page=buku' </script> ";
    exit();
}

$id_buku = $_GET['id_buku'];

// Validasi ID buku
if (!ctype_digit($id_buku)) {
    echo "<script> window.location.href = 'index.php?page=buku' </script> ";
    exit();
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];

    $pdo = config::connect();
    $sql = "UPDATE buku SET judul = ?, pengarang = ?, penerbit = ? WHERE id_buku = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($judul, $pengarang, $penerbit, $id_buku));

    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();

    echo "<script> window.location.href = 'index.php?page=buku' </script> ";
    exit();
} else {
    $pdo = config::connect();
    $sql = "SELECT * FROM buku WHERE id_buku = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_buku));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=buku' </script> ";
        exit();
    }

    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $penerbit = $data['penerbit']; // Pastikan kolom ini ada di tabel
    // Tidak perlu panggil disconnect jika menggunakan PDO
    // config::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit buku</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Judul</label>
                <input name="judul" type="text" class="form-control" placeholder="judul" required value="<?php echo htmlspecialchars($judul); ?>">
            </div>

            <div class="form-group">
                <label>Pengarang</label>
                <input name="pengarang" type="text" class="form-control" placeholder="pengarang" required value="<?php echo htmlspecialchars($pengarang); ?>">
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input name="penerbit" type="text" class="form-control" placeholder="penerbit" required value="<?php echo htmlspecialchars($penerbit); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=buku" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.j
