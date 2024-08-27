<?php
if (empty($_GET['id_peminjaman'])) {
    header("Location: index.php");
    exit();
}

$id_peminjaman = $_GET['id_peminjaman'];

// Validasi ID peminjaman
if (!ctype_digit($id_peminjaman)) {
    echo "ID peminjaman tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_peminjaman = htmlspecialchars($id_peminjaman, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/peminjaman.php");
$pdo = config::connect();
$peminjaman = peminjaman::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $peminjaman->hapus($id_peminjaman);

if ($result) {
    header("Location: index.php?page=peminjaman");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
