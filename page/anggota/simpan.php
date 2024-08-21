<?php 
include_once("../../database/config.php");
include_once("../../class/anggota.php");

$act = isset($_GET['act']) ? $_GET['act'] : '';

$allowed_actions = ['tambah', 'edit', 'hapus'];

if (in_array($act, $allowed_actions)) {
    include $act . '.php';
} else {
    include 'index.php';
}
?>
