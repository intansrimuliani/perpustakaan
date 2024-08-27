<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pengarang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Data pengarang</h3>
            <a href="tambah.php?page=pengarang&act=tambah" class="btn btn-primary">Tambah pengarang</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include("../../database/config.php");
                        include("../../class/pengarang.php");
                        $pdo = config::connect();
                        $pengarang = pengarang::getInstance($pdo);
                        $datapengarang = $pengarang->getAll();
                        $no = 1;

                        foreach ($datapengarang as $row) {
                        ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat_pengarang']); ?></td>
                            
                            <td>
                                <a href="edit.php?page=pengarang&act=edit&id_pengarang=<?php echo $row['id_pengarang'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                                <a href="hapus.php?page=pengarang&act=hapus&id_pengarang=<?php echo $row['id_pengarang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                             </a>
                            </td>   
                        </tr>
                    <?php
                    }
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