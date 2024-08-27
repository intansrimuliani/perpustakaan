<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Data Pengembalian</h3>
            <a href="tambah.php?page=pengembalian&act=tambah" class="btn btn-primary">Tambah Pengembalian</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../../database/config.php");
                        include("../../class/pengembalian.php");
                        $pdo = config::connect();
                        $pengembalian = pengembalian::getInstance($pdo);
                        $datapengembalian = $pengembalian->getAll();

                        foreach ($datapengembalian as $row) {
                    ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_anggota']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_kembali']); ?></td>
                            <td>
                                <a href="edit.php?page=pengembalian&act=edit&id_pengembalian=<?php echo $row['id_pengembalian'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus.php?page=pengembalian&act=hapus&id_pengembalian=<?php echo $row['id_pengembalian'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                        // config::disconnect(); // Jika ada, tambahkan sesuai kebutuhan
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
