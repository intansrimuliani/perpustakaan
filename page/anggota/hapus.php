<?php
if ($currentUser['level'] != 1) {
    echo "<script>window.location = 'index.php?alert=err2';</script>";
    exit;
}

$pdo = Koneksi::connect();
$anggota= Anggota::getInstance($pdo);

$id_anggota = isset($_GET['id_anggota']) ? $_GET['id_anggota'] : null;

if ($id_anggota && $anggota->hapus($id_anggota)) {
    echo "<script>window.location.href = 'index.php?page=anggota&alert=hapus'</script>";
} else {
    echo "Gagal menghapus anggota.";
}