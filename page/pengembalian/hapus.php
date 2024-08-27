<?php
if (empty($_GET['id_pengembalian'])) {
    header("Location: index.php");
    exit();
}

$id_pengembalian = $_GET['id_pengembalian'];

// Validasi ID pengembalian
if (!ctype_digit($id_pengembalian)) {
    echo "ID pengembalian tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_pengembalian = htmlspecialchars($id_pengembalian, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/pengembalian.php");
$pdo = config::connect();
$pengembalian = pengembalian::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $pengembalian->hapus($id_pengembalian);

if ($result) {
    header("Location: index.php?page=pengembalian");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
