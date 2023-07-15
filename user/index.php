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

$produk = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE status = 1 ORDER BY nm_produk ASC");
$jml_produk = mysqli_num_rows($produk);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SirCafe | Produk</title>
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
						<li class="breadcrumb-item active"><a href="index.php">Produk</a></li>
					</ol>
                </div>
                <?php if ($jml_produk == 0) { ?>
                <div class="alert alert-warning alert-dismissible fade show">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
					<strong>Warning!</strong> Produk masih kosong.
					<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                </div>
                <?php } else { ?>
                <div class="row">
                    <?php while ($row_produk = mysqli_fetch_assoc($produk)) { ?>
                    <div class="col-lg-12 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-b-30">
                                    <div class="col-md-5 col-xxl-12">
                                        <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                            <div class="new-arrivals-img-contnent">
                                                <a href="produk-detail.php?id=<?php echo $row_produk["id_produk"] ?>"><img class="img-fluid" src="../images/product/<?php echo $row_produk["foto"] ?>" alt="Produk"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-xxl-12">
                                        <div class="new-arrival-content position-relative">
                                            <h4><a href="ecom-product-detail.html" class="text-black"><?php echo $row_produk["nm_produk"] ?></a></h4>
                                            <p class="price"><?php echo 'Rp. ' . number_format($row_produk["harga"], 0, ',', '.',) . ',-' ?></p>
                                            <p>Product code: <span class="item"><?php echo $row_produk["id_produk"] ?></span> </p>
                                            <p class="text-content"><?php echo $row_produk["deskripsi"] ?></p>
                                        </div>
                                        <div class="shopping-cart mt-3">
                                                    <a class="btn btn-primary btn-lg" href="produk-detail.php?id=<?php echo $row_produk["id_produk"] ?>"><i class="fa fa-shopping-basket mr-2"></i>Detail Produk</a>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <?php } ?>
                </div>
                <?php } ?>
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