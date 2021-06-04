<?php
session_start();
require 'admin/dist/functions.php';

$produk_produk = query("SELECT * FROM produk");

if (isset($_GET["cari"])) {
    $produk_produk = cariProduk($_GET["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila</title>
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

<body style="font-size: 24px;">
<nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #979890;">
        <div class="container"><img src="assets/img/toko.png" style="width: 5%;"><a class="navbar-brand" href="#" style="font-size: 20px;">TOKO SALSABILA</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto" style="font-size: medium;">
                    <li class="h5" role="presentation"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="h5" role="presentation"><a class="nav-link" href="#">ABOUT US</a></li>
                    <li class="h5" role="presentation"><a class="nav-link" href="#">CONTACT</a></li>
                </ul>
                <form action="" method="get" class="w-50">
                    <input type="text" name="keyword" placeholder="Cari Barang.." autocomplete="off" style="width: 40%;">
                    <a class="btn btn-light action-button" namespace="sada" role="button" href="#" style="background-color: rgba(206,207,234,0);">
                        <button type="submit" name="cari">
                            <i class="fa fa-search" style="font-size: 50px;"></i>
                        </button>
                    </a>
                    <a class="btn btn-light action-button" role="button" href="Keranjang.php" style="background-color: rgba(206,207,234,0);"><i class="fa fa-shopping-cart" style="font-size: 50px;"></i>
                </form>
                <span class="navbar-text actions">
                    <ul class="nav navbar-nav mr-auto"></ul>
                    <span class="navbar-text actions">
                        <?php if (isset($_SESSION['loginPelanggan'])) : ?>
                            <a class="btn btn-light action-button w-5 p-2 mr-2" role="button" href="riwayat.php">Riwayat</a>
                            <a class="btn btn-light action-button w-5 p-2" role="button" href="admin/dist/logout.php">Keluar</a>
                        <?php else : ?>
                            <a class="btn btn-light action-button w-5 p-2 mr-2" role="button" href="login.php">Masuk</a>
                            <a class="btn btn-light action-button w-5 p-2" role="button" href="register.php">Daftar</a>
                        <?php endif ?>
                    </span>
                </span>
            </div>
        </div>
    </nav>
    <div class="container">

        <div class="row product-list">
            <?php foreach ($produk_produk as $row) : ?>
                <div class="col-sm-6 col-md-4 product-item">
                    <div class="product-container">
                        <div class="row">
                            <div class="col-md-12"><a class="product-image" href="#"><img src="admin/dist/assets/img/<?= $row["foto_produk"]; ?>" style="width: 130px;height: 130px;"></a></div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h2><?= $row["nama_produk"]; ?></h2>
                            </div>
                            <!-- <div class="col-4"><a class="small-text" href="#">compare </a></div> -->
                        </div>
                        <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i><a class="small-text" href="#">82 reviews</a></div>
                        <div class="row">
                            <div class="col-12">
                                <p class="product-description"><?= substr($row["deskripsi"], 0, 100) . "[..]" ?></p>
                                <div class="row">
                                    <div class="col-6"><a href="beli-barang.php?id=<?= $row["id_produk"]; ?>" class="btn btn-primary" data-toggle="button" aria-pressed="false">Buy Now!</a></div>
                                    <div class="col-6">
                                        <p class="product-price">Rp <?= number_format($row["harga_produk"], 0, ",", "."); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/WOWSlider-about-us.js"></script>
</body>


</html>