<?php
session_start();
include("database/config.php");
include("database/class/auth.php");

$pdo = config::connect();
$anggota = auth::getInstance($pdo);

if (!$anggota->isLoggedIn()) {
    $login = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($login) {
        case 'login':
            include('auth/login.php');
            break;
        case 'register':
            include('auth/register.php');
            break;
        default:
            include('auth/login.php');
            break;
    }
} else {

    if (isset($_GET['page']) && $_GET['page'] === 'logout') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
            session_destroy();
            header("Location: index.php");
            exit();
        }
        include('page/anggota/logout.php');
    } else {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
            <title>my crud</title>
            <?php include 'layout/stylecss.php'; ?>
        </head>

        <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
            <div class="wrapper">
                <!-- Header -->
                <?php include 'layout/header.php'; ?>
                <!-- Sidebar -->
                <?php include 'layout/sidebar.php'; ?>

                <!-- Loading -->
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__shake" src="asset/img/load/Kasirlogo.png" alt="logo perpustakaan" height="80" width="150">
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <?php
                        $page = isset($_GET["page"]) ? $_GET["page"] : 'dashboard';
                        switch ($page) {
                            case 'anggota':
                                include('page/anggota/default.php');
                                break;
                            case 'member':
                                include('page/member/default.php');
                                break;
                            case 'barang':
                                include('page/barang/default.php');
                                break;
                            case 'jenisbarang':
                                include('page/jenisbarang/default.php');
                                break;
                            case 'supplier':
                                include('page/supplier/default.php');
                                break;
                            case 'transaksi':
                                include('page/transaksi/default.php');
                                break;
                            case 'dashboard':
                            default:
                                include('page/dashboard/index.php');
                                break;
                        }
                        ?>
                    </section>
                </div>

                <!-- Footer -->
                <?php include 'layout/footer.php'; ?>
            </div>

            <?php include 'layout/stylejs.php'; ?>
        </body>

        </html>
<?php
    }
}
?>