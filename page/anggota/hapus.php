<?php
if (empty($_GET['id_anggota'])) {
    header("Location: index.php");
    exit();
}

$id_anggota = $_GET['id_anggota'];

// Validasi ID anggota
if (!ctype_digit($id_anggota)) {
    echo "ID anggota tidak valid.";
    exit();
}

// Sanitasi parameter jika perlu
$id_anggota = htmlspecialchars($id_anggota, ENT_QUOTES, 'UTF-8');

include("../../database/config.php");
include("../../class/anggota.php");
$pdo = config::connect();
$anggota = anggota::getInstance($pdo);

// Pastikan metode delete menggunakan prepared statements
$result = $anggota->delete($id_anggota);

if ($result) {
    header("Location: index.php?page=anggota");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

config::disconnect();
?>
