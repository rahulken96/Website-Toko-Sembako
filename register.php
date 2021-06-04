<?php
include 'admin/dist/functions.php';
if (isset($_POST['daftar'])) {
    if (register($_POST)>0) {
        echo "
        <script>
        alert('Yeay Berhasil!');
        document.location.href='login.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Maaf kamu gagal!');
        document.location.href='register.php';
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Sembako</title>
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
            </div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <form method="post">
                <h2 class="text-center"><strong>Buat akun </strong>anda.</h2>
                <div class="form-row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group"><label>Nama Lengkap</label><input class="form-control" type="text" name="name" required></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group"><label>Username</label><input class="form-control" type="text" name="username" required></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group"><label>E-mail</label><input class="form-control" type="email" name="email" required></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group"><label>No.Tlpn</label><input class="form-control" type="tel" name="telephone" required></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group"><label>Alamat</label><input class="form-control" type="text" name="alamat" required></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="col-sm-12 col-md-3">Password</label>
                            <input type="password" value="" id="check" name="password" required>
                            <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                            <script>
                                function myFunction() {
                                    var check = document.getElementById("check");
                                    if (check.type === "text") {
                                        check.type = "password";
                                    } else {
                                        check.type = "text";
                                    }
                                }
                            </script>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 col-md-3">Konfirmasi Password</label>
                            <input type="password" value="" id="cek" name="konfirmasiPassword" required>
                            <input type="checkbox" onclick="cekUlang()">  Tampilkan Password
                            <script>
                                function cekUlang() {
                                    var chek = document.getElementById("cek");
                                    if (chek.type === "text") {
                                        chek.type = "password";
                                    } else {
                                        chek.type = "text";
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" required> I agree to the license terms.
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="daftar">Daftar</button>
                </div>
                <a class="already" href="login.php"><strong>Sudah punya akun? </strong>Masuk sini.</a>

            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/WOWSlider-about-us.js"></script>
</body>

</html>