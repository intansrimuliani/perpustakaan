<?php
if (empty($_GET['id_buku'])) {
    header("Location: index.php");
    exit();
}

$id_buku = $_GET['id_buku'];

// Validasi ID buku
if (!ctype_digit($id_buku)) {
    echo "ID buku tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_buku = htmlspecialchars($id_buku, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/buku.php");
$pdo = config::connect();
$buku = buku::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $buku->hapus($id_buku);

if ($result) {
    header("Location: index.php?page=buku");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
