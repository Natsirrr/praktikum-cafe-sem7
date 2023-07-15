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

$kode = $_GET["id"];

$transaksi = mysqli_query($conn, "SELECT * FROM tbl_transaksi WHERE kode = '$kode'");
$row_transaksi = mysqli_fetch_assoc($transaksi);

if (isset($_POST["submit"])) {

    $status = $_POST["status"];

    $update = mysqli_query($conn, "UPDATE tbl_transaksi SET status = '$status' WHERE kode = '$kode'");

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
    <title>SirCafe | Edit Transaksi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
    <!-- Custom Stylesheet -->
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
						<li class="breadcrumb-item"><a href="transaksi.php">Transaksi</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Transaksi</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Style</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="kode">Kode Transaksi :</label>
                                            <input type="text" class="form-control input-default" name="kode" id="kode" value="<?php echo $row_transaksi["kode"] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Total Bayar :</label>
                                            <input type="text" class="form-control input-default" name="total" id="total" value="<?php echo $row_transaksi["total"] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu">Tanggal Transaksi :</label>
                                            <input type="text" class="form-control input-default" name="waktu" id="waktu" value="<?php echo $row_transaksi["waktu"] ?>" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Status :</label><br>
                                            <label class="radio-inline mr-3"><input type="radio" name="status" value="1" <?php if ($row_transaksi["status"] == 1){ echo "checked";} ?>> Baru</label>
                                            <label class="radio-inline mr-3"><input type="radio" name="status" value="2" <?php if ($row_transaksi["status"] == 2){ echo "checked";} ?>> Lunas</label>
                                            <label class="radio-inline mr-3"><input type="radio" name="status" value="3" <?php if ($row_transaksi["status"] == 3){ echo "checked";} ?>> Selesai</label>
                                            <label class="radio-inline mr-3"><input type="radio" name="status" value="4" <?php if ($row_transaksi["status"] == 4){ echo "checked";} ?>> Batal</label>
                                        </div>
                                        <button class="btn btn-primary mr-2" name="submit">Simpan</button>
                                        <a href="transaksi.php" class="btn btn-light">Kembali</a>
                                    </form>
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
	
    


</body>

</html>