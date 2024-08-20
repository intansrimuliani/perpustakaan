<?php


if (empty($_GET['id_anggota'])) {
    echo "<script>window.location.href = 'index.php?page=anggota'</script>";
    exit();
}

$id_anggota = $_GET['id_anggota'];
$pdo = config::connect();
$anggota = anggota::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_anggota = htmlspecialchars($_POST['nama_anggota']);
    $alamat_anggota = htmlspecialchars($_POST['alamat_anggota']);
    $no_telepon = htmlspecialchars($_POST['no_telepon']);

    $result = $anggota->edit($id_anggota, $nama_anggota, $alamat_anggota, $no_telepon);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=anggota'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $anggota->getID($id_anggota);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=anggota'</script>";
    exit();
}

$nama_anggota = htmlspecialchars($data['nama_anggota']);
$alamat_anggota = htmlspecialchars($data['alamat_anggota']);
$no_telepon = htmlspecialchars($data['no_telepon']);
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit Anggota</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_anggota">Nama Anggota</label>
                    <input id="nama_anggota" name="nama_anggota" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama_anggota); ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat_anggota">Alamat Anggota</label>
                    <input id="alamat_anggota" name="alamat_anggota" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat_anggota); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No Telp</label>
                    <input id="no_telepon" name="no_telepon" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telepon); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=anggota" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>