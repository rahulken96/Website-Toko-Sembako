<?php

include 'admin/dist/functions.php';
//session login
session_start();

//login pelanggan
if (isset($_POST['login'])) {
    if (login($_POST) > 0) {
        echo "<script>
        alert('Selamat Datang! ^^');
        document.location.href='index.php';
        </script>";
    }else {
        echo "<script>
        alert('Gagal!');
        document.location.href='login.php';
        </script>";
    }
}


// if (isset($_SESSION['login'])) {
//     header("Location: index2.php");
//     exit;
// }
// if (isset($_SESSION['loginAdmin'])) {
//     //   header("Location: admin/dist/index.php");
//     exit;
// }

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Masuk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Check-Out-Page-V100.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form-1.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Pretty-Product-List.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-1.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-2.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #979890;">
        <div class="container"><img src="assets/img/toko.png" style="width: 100px;"><a class="navbar-brand" href="#" style="font-size: 23px;">TOKO SALSABILA</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">CONTACT</a></li>
                </ul>
                <span class="navbar-text actions">
                    <a class="btn btn-light action-button w-10 p-2" role="button" href="register.php" >Daftar</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <i class="icon ion-android-contact" style="color: rgb(0,155,193);"></i>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" required name="username" placeholder="Username" autofocus required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" required name="password" placeholder="Password" autocomplete="off" autofocus required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(0,155,193);" name="login">Masuk</button>
            </div>
            <a class="forgot" href="#">Lupa ussername atau password?</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/WOWSlider-about-us.js"></script>
</body>

</html>