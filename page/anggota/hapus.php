<?php 
include '../../database/config.php';

if(empty($_GET['id_anggota']))  {
    header("location: index.php");
}

$id = $_GET['id_anggota'];

$pdo = dataBase::__connect();
$sql = "DELETE FROM anggota WHERE id_anggota = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
 dataBase::disconnect();
  header("location: index.php");
?>