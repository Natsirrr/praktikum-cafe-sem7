<?php
session_start();

if ($_SESSION["level"] != 2) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: logout.php");
    exit;
}

include "../koneksi.php";

$id_produk = $_GET["id"];
$kode = $_SESSION["kode"];

$produk = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = $id_produk");
$row_produk = mysqli_fetch_assoc($produk);

if (isset($_POST["submit"])) {

    $qty = $_POST["qty"];

    $simpan = mysqli_query($conn, "INSERT INTO tbl_cart VALUE(NULL, '$kode', '$id_produk', '$qty')");

    if ($simpan) {
        header("Location: keranjang.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SirCafe | Produk Detail</title>
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Produk</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                                <img class="img-fluid" src="../images/product/<?php echo $row_produk["foto"] ?>" alt="Produk">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab slider End-->
                                    <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                        <div class="product-detail-content">
                                            <!--Product details-->
                                            <div class="new-arrival-content pr">
                                                <h4 class="text-black"><?php echo $row_produk["nm_produk"] ?></h4>
                                                <p class="price"><?php echo 'Rp. ' . number_format($row_produk["harga"], 0, ',', '.',) . ',-' ?></p>
                                                <p>Product code: <span class="item"><?php echo $row_produk["id_produk"] ?></span></p>
                                                <p class="text-content"><?php echo $row_produk["deskripsi"] ?></p>
                                                <form action="" method="POST">
                                                    <!-- Quantity Start -->
                                                    <div class="col-2 px-0">
                                                        <input type="number" name="qty" class="form-control input-btn input-number" value="1" autofocus required>
                                                    </div>
                                                    <!-- Quanatity End -->
                                                    <div class="shopping-cart mt-3">
                                                        <button class="btn btn-primary btn-lg" type="submit" name="submit"><i class="fa fa-shopping-basket mr-2"></i>Add To Cart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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