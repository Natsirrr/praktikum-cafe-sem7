<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: logout.php");
    exit;
}

include "koneksi.php";

if (isset($_POST["login"])) {

    $hp = $_POST["hp"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tbl_user WHERE hp ='$hp'");

    if(mysqli_num_rows($result) === 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row["id_user"];
            $_SESSION["nm_user"] = $row["nm_user"];
            $_SESSION["hp"] = $row["hp"];
            $_SESSION["level"] = $row["level"];

            $kode = uniqid();
            $update = mysqli_query($conn, "UPDATE tbl_user SET kode = '$kode' WHERE hp ='$hp'");

            $_SESSION["kode"] = $kode;

            if ($row["level"] == 1) {
                header("Location: user/index.php");
            } else if ($row["level"] == 2) {
                header("Location: admin/index.php");
            }
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SirCafe | Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logo2.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center">
                                        <img src="images/logo2.png" alt="LOGO" height="52">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="mb-1" for="hp"><strong>HP :</strong></label>
                                            <input type="text" class="form-control" name="hp" id="hp" placeholder="Nomor Handphone" autofocus require> 
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1" for="password"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" require>
                                        </div>
                                        <?php if(isset($error)) { ?>
                                        <div class="alert alert-warning alert-dismissible fade show">
                                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                            <strong>Warning!</strong> Something went wrong. Please check.
                                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                            </button>
                                        </div>
                                        <?php } ?>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3 text-center">
                                        <p>Copyright &copy; Natsir 2023</p>
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
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

</body>

</html>