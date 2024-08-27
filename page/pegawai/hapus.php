<?php
if (empty($_GET['id_pegawai'])) {
    header("Location: index.php");
    exit();
}

$id_pegawai = $_GET['id_pegawai'];

// Validasi ID pegawai
if (!ctype_digit($id_pegawai)) {
    echo "ID pegawai tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_pegawai = htmlspecialchars($id_pegawai, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/pegawai.php");
$pdo = config::connect();
$pegawai = pegawai::getInstance($pdo);

// Pastikan metode hapus menggunakan prepared statements
$result = $pegawai->hapus($id_pegawai);

if ($result) {
    header("Location: index.php?page=pegawai");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
