<?php
if (empty($_GET['id_pengarang'])) {
    header("Location: index.php");
    exit();
}

$id_pengarang = $_GET['id_pengarang'];

// Validasi ID pengarang
if (!ctype_digit($id_pengarang)) {
    echo "ID pengarang tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_pengarang = htmlspecialchars($id_pengarang, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/pengarang.php");
$pdo = config::connect();
$pengarang = pengarang::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $pengarang->hapus($id_pengarang);

if ($result) {
    header("Location: index.php?page=pengarang");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
