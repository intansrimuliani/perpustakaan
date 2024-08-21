<!doctype html>
<html lang="en">
    <head>
        <title>PERPUSTAKAAN</title>
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
                <a class="navbar-brand" href="#">Data pegawai</a>
            </div>
        </nav>
        <div class="container mt-5 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5> Data pegawai</h5>
                    <a href="tambah.php?page=pegawai&act=tambah" class="btn btn-primary">Tambah pegawai</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="table-artikel-query">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Alamat Pegawai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../../database/config.php");
                        include("../../class/pegawai.php");
                        $pdo = config::connect();
                        $pegawai = pegawai::getInstance($pdo);
                        $dataPegawai = $pegawai->getAll();
                        $no = 1;

                        foreach ($dataPegawai as $row) 
                        ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_pegawai']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat_pegawai']); ?></td>

                            <td>
                                <a href="edit.php?page=pegawai&act=edit&id_pegawai=<?php echo $row['id_pegawai'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                                <a href="hapus.php?page=pegawai&act=hapus&id_pegawai=<?php echo $row['id_pegawai'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>   
                        </tr>
                    <?php
                    
                   // koneksi::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>