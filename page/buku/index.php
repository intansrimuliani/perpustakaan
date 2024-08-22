<!doctype html>
<html lang="en">
    <head>
        <title>data buku</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS --><!-- BOOTSTRAP 4-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- DATATABLES BS 4-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />
        <!-- jQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-info">
            <div class="container">
                <a class="navbar-brand" href="#">Data perpustakaan</a>
            </div>
        </nav>
        <div class="container mt-5 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>Data buku</h5>
                    <a href="tambah.php?page=buku&act=tambah" class="btn btn-primary">Tambah buku</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table-artikel-query">
                        <thead>
                            <tr>
                                <th>Nama Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../../database/config.php");
                        include("../../class/buku.php");
                        $pdo = config::connect();
                        $buku = buku::getInstance($pdo);
                        $databuku = $buku->getAll();
                        $no = 1;

                        foreach ($databuku as $row) 
                        ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_buku']); ?></td>
                            <td><?php echo htmlspecialchars($row['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($row['penerbit']); ?></td>

                            <td>
                                <a href="edit.php?page=buku&act=edit&id_buku=<?php echo $row['id_buku'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                                <a href="hapus.php?page=buku&act=hapus&id_buku=<?php echo $row['id_buku'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>   
                        </tr>
                    <?php
                    
                   // config::disconnect();
                    ?>
                </body>
            </table>
        </div>
    </div>