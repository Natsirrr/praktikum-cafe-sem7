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

if (isset($_POST["submit"])) {

    $nm_produk = $_POST["nm_produk"];
    $foto = $_FILES["foto"]["name"];
    $deskripsi = $_POST["deskripsi"];
    $harga = $_POST["harga"];
    $status = $_POST["status"];

    move_uploaded_file($_FILES['foto']['tmp_name'], '../images/product/'.$_FILES['foto']['name']);

    $simpan = mysqli_query($conn, "INSERT INTO tbl_produk VALUES(NULL, '$nm_produk', '$foto', '$deskripsi', '$harga', '$status')");

    if ($simpan) {
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Coffee | Tambah Produk</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo2.png">
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
                        <li class="breadcrumb-item"><a href="index.php">Produk</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Produk</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Produk</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nm_produk">Nama Produk :</label>
                                            <input type="text" class="form-control input-default " name="nm_produk" id="nm_produk" placeholder="Nama Produk" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi :</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Deskripsi Produk" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga :</label>
                                            <input type="number" class="form-control input-default " name="harga" id="harga" placeholder="Harga Produk" required>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="foto" required>
                                                <label class="custom-file-label">Upload Foto</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" value="1">
                                        <div class="mt-4">
                                        <button class="btn btn-primary mr-2" name="submit"> Simpan</button>
                                        <a href="index.php" class="btn btn-light">Kembali</a>
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