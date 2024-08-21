<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- cdn css bootstrap start -->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- cdn css bootstrap end-->
    <title>Tambah pegawai</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-center">Tambah Pegawai</h4>
                   </div>

                   </div>
                <div class="card-body p-4">
                    <form action="simpan.php" method="POST">

                    <div class="form-group mb-2">
                        <label  class="form-label">Nama</label>
                             <input type="text"  name="nama_pegawai" placeholder="Masukkan Nama anda" class="form-control border border-primary ">
                         </div>

                         <div class="form-group mb-2">
                            <label  class="form-label">Alamat</label>
                                <input type="text"  name="alamat_pegawai" placeholder="Masukkan Alamat Anda" class="form-control border border-primary">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>

                </div>
                    </div>
                        </div>
                         </div>
                            <div class="text-end">
                                <a href="index.php" class="btn btn-sm btn-primary p-2 mt-4">Back</a>
                            </div>
                        </div>

    <script src="https://code.jquery.com/jquery-    3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>

<?php


if(isset($_POST['simpan'])){

    $nama_pegawai = $_POST['nama_pegawai'];
    $alamat_pegawai = $_POST['alamat_pegawai'];
   

    include("../../database/config.php");
    include("../../class/pegawai.php");
        $pdo = config::connect();
        $pegawai = pegawai::getInstance($pdo);
        if ($pegawai->add($namapegawai, $alamatpegawai)) {
            echo "<script>window.location.href = 'index.php'</script>";
        } else {
            echo "Terjadi kesalahan saat menyimpan data.";

        }
    }
?>