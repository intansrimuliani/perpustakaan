<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Data Peminjaman</h3>
            <a href="tambah.php?page=peminjaman&act=tambah" class="btn btn-primary">Tambah peminjaman</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Nama Buku</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include("../../database/config.php");
                    include("../../class/peminjaman.php");
                    $pdo = config::connect();
                    $peminjaman = peminjaman::getInstance($pdo);
                    $datapeminjaman = $peminjaman->getAll();
                    $no = 1;

                    foreach ($datapeminjaman as $row) {
                ?> 
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama_anggota']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_buku']); ?></td>
                        <td><?php echo htmlspecialchars($row['jumlah_peminjaman']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_peminjaman']); ?></td>
                        <td>
                            <a href="edit.php?page=peminjaman&act=edit&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="hapus.php?page=peminjaman&act=hapus&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>   
                    </tr>
                <?php
                    }
                    // Disconnect the database connection if needed
                    // config::disconnect();
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
