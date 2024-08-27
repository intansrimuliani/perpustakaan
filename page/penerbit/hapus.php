<?php
if (empty($_GET['id_penerbit'])) {
    header("Location: index.php");
    exit();
}

$id_penerbit = $_GET['id_penerbit'];

// Validasi ID penerbit
if (!ctype_digit($id_penerbit)) {
    echo "ID penerbit tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_penerbit = htmlspecialchars($id_penerbit, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/penerbit.php");
$pdo = config::connect();
$penerbit = penerbit::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $penerbit->hapus($id_penerbit);

if ($result) {
    header("Location: index.php?page=penerbit");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
