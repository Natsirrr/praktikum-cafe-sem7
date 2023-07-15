<?php
session_start();

if ($_SESSION["level"] != 1) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: logout.php");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION["id_user"];

$transaksi = mysqli_query($conn, "SELECT * FROM tbl_transaksi WHERE id_user = $id_user ORDER BY waktu DESC");
$jml_transaksi = mysqli_num_rows($transaksi);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SirCafe | Transaksi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

		<?php include "theme-header.php" ?>

		<?php include "theme-sidebar.php" ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Transaksi</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <?php if ($jml_transaksi == 0) { ?>
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                    <strong>Warning!</strong> Transaksi masih kosong.
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0 text-black">
                                        <thead>
                                            <tr>
                                                <th class="align-middle">Action</th>
                                                <th class="align-middle">Kode Transaksi</th>
                                                <th class="align-middle pr-7">Total Bayar</th>
                                                <th class="align-middle minw200">Waktu</th>
                                                <th class="align-middle">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                            <?php while ($row_transaksi = mysqli_fetch_assoc($transaksi)) { ?>
                                            <tr class="btn-reveal-trigger">
                                                <td class="py-2">
                                                    <a href="transaksi-edit.php?id=<?php echo $row_transaksi["kode"] ?>" class="btn btn-sm btn-warning">Edit</a>
                                                </td>
                                                <td class="py-2"><?php echo $row_transaksi["kode"] ?></td>
                                                <td class="py-2"><?php echo 'Rp. ' . number_format($row_transaksi["total"], 0, ',', '.',) . ',-' ?></td>
                                                <td class="py-2"><?php echo $row_transaksi["waktu"] ?></td>
                                                <td class="py-2">
                                                    <?php if ($row_transaksi["status"] == 1) {?>
                                                        <span class="badge light badge-primary">Baru</span>
                                                    <?php } else if ($row_transaksi["status"] == 2) {?>
                                                        <span class="badge light badge-info">Lunas</span>
                                                    <?php } else if ($row_transaksi["status"] == 3) {?>
                                                        <span class="badge light badge-warning">Selesai</span>
                                                    <?php } else if ($row_transaksi["status"] == 4) {?>
                                                        <span class="badge light badge-danger">Batal</span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

		<?php include "theme-footer.php" ?>

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
	<script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
	<script src="../js/deznav-init.js"></script>
	

    <script src="../vendor/highlightjs/highlight.pack.min.js"></script>
    <!-- Circle progress -->

</body>

</html>