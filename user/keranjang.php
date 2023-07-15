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

$kode = $_SESSION["kode"];
$id_user = $_SESSION["id_user"];

$cart = mysqli_query($conn, "SELECT C.*, P.nm_produk, P.foto, P.harga FROM tbl_cart C, tbl_produk P WHERE C.id_produk = P.id_produk AND  C.kode = '$kode'");
$jml_cart = mysqli_num_rows($cart);

if (isset($_POST["submit"])) {

    $totala = $_POST["total"];
    $waktu = $_POST["waktu"];
    $status = $_POST["status"];

    $simpan = mysqli_query($conn, "INSERT INTO tbl_transaksi VALUE(NULL, '$kode', '$id_user', '$totala', '$waktu', '$status')");
    $_SESSION["kode"] = NULL;

    $kode_baru = uniqid();
    $_SESSION["kode"] = $kode_baru;
    $update = mysqli_query($conn, "UPDATE tbl_user SET kode = '$kode_baru' WHERE id_user ='$id_user'");

    if ($update) {
        header("Location: transaksi.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SirCafe | Keranjang</title>
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
						<li class="breadcrumb-item"><a href="index.php">Produk</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Keranjang</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <?php if ($jml_cart == 0) { ?>
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                    <strong>Warning!</strong> Keranjang masih kosong.
                                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0 text-black">
                                        <thead>
                                            <tr>
                                                <th class="align-middle">Produk</th>
                                                <th class="align-middle pr-7">Foto</th>
                                                <th class="align-middle minw200">Harga Satuan</th>
                                                <th class="align-middle text-right">QTY</th>
                                                <th class="align-middle text-right">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                            <?php 
                                            $total_qty = 0;
                                            $total_jumlah = 0;
                                            while ($row_cart = mysqli_fetch_assoc($cart)) { ?>
                                            <tr class="btn-reveal-trigger">
                                                <td class="py-2"><?php echo $row_cart["nm_produk"] ?></td>
                                                <td class="py-2"><img src="../images/product/<?php echo $row_cart["foto"] ?>" alt="Produk" width="100"></td>
                                                <td class="py-2 text-right"><?php echo 'Rp. ' . number_format($row_cart["harga"], 0, ',', '.',) . ',-' ?></td>
                                                <td class="py-2 text-right"><?php echo $row_cart["qty"] ?></td>
                                                <?php $jumlah = $row_cart["harga"] * $row_cart["qty"] ?>
                                                <td class="py-2 text-right"><?php echo 'Rp. ' . number_format($jumlah, 0, ',', '.',) . ',-' ?></td>
                                            </tr>
                                            <?php 
                                                $total_qty += $row_cart["qty"];
                                                $total_jumlah += $jumlah;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="py-2 text-right" colspan="3">Total</th>
                                                <th class="py-2 text-right"><?php echo $total_qty ?></th>
                                                <th class="py-2 text-right"><?php echo 'Rp. ' . number_format($total_jumlah, 0, ',', '.',) . ',-' ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <form action="" method="POST" class="mt-4">
                                    <input type="hidden" name="total" value="<?php echo $total_jumlah ?>">
                                    <input type="hidden" name="waktu" value="<?php echo date('Y-m-d H:i:s') ?>">
                                    <input type="hidden" name="status" value="1">
                                    <a href="index.php" class="btn btn-info mr-2">Belanja Lagi</a>
                                    <button class="btn btn-primary" name="submit">Checkout</button>
                                </form>
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