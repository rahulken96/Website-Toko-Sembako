<?php
session_start();
$_SESSION['login_time'] = date('Y-m-d');
require 'admin/dist/functions.php';
$totalHarga = 0;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Keranjang Ku</title>
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
        <div class="container"><img src="assets/img/toko.png" style="width: 100px;"><a class="navbar-brand" href="#" style="font-size: 23px;">Toko Salsabila</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#">CONTACT</a></li>
                </ul>
                <form action="" method="get">
                    <input type="text" name="keyword" placeholder="Cari Barang.." autocomplete="off">
                    <a class="btn btn-light action-button" namespace="sada" role="button" href="#" style="background-color: rgba(206,207,234,0);font-size: 21px;margin-right: 20px;">
                        <button type="submit" name="cari">
                            <i class="fa fa-search" style="font-size: 40px;"></i>
                        </button>
                    </a>
                </form>
                <span class="navbar-text actions">
                    <!-- <ul class="nav navbar-nav mr-auto"></ul> -->
                    <span class="navbar-text actions">
                        <?php if (isset($_SESSION['loginPelanggan'])) : ?>
                            <div class="btn-group">
                                <a class="btn btn-light" href="#"><i class="fa fa-user"></i> <?= $_SESSION['loginPelanggan']['Nama'] ?></a>
                                <a class="btn btn-light" data-toggle="dropdown" href="#">
                                    <span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="riwayat.php"><i class="fa fa-pencil fa-fw"></i> Riwayat</a></li>
                                    <li><a href="admin/dist/logout.php"><i class="fa fa-ban fa-fw"></i> Keluar</a></li>
                                </ul>
                            </div>
                        <?php else : ?>
                            <a class="btn btn-light action-button w-5 p-2" role="button" href="login.php">Masuk</a>
                            <a class="btn btn-light action-button w-5 p-2" role="button" href="register.php">Daftar</a>
                        <?php endif ?>
                    </span>
                </span>
            </div>
        </div>
    </nav>
    <div class="container">
        <ol class="breadcrumb DeskView">
            <li class="breadcrumb-item"><a href="index.php"><span>Home</span></a></li>
            <li class="breadcrumb-item active"><span>Keranjang</span></li>
        </ol>
        <div class="row">
            <div class="col-12 col-lg-6">
                <?php
                if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) :
                    echo "<script>
                        alert('Anda harus beli barang dulu!');
                        document.location.href='index.php';
                        </script>";
                    exit;
                ?>
                    <?php
                else :
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) :
                    ?>
                        <?php
                        $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $barang = mysqli_fetch_assoc($ambil);
                        $subHarga = $jumlah * $barang["harga_produk"];
                        ?>
                        <div class="card shadow mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <img class="img-fluid border rounded shadow" src="admin/dist/assets/img/<?= $barang["foto_produk"]; ?>">
                                    </div>
                                    <div class="col">
                                        <p class="mt-2"><strong><?= $barang["nama_produk"]; ?></strong></p>
                                        <p class="mt-2">Sub harga = Rp <?= number_format($subHarga, 0, ",", "."); ?></p>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <form>
                                                    <div class="qty-input form-group">
                                                        <input class="qty-input form-group" type="number" placeholder="Jumlah.." min="1" value="<?= $jumlah ?>" name="jumlah" readonly>
                                                    </div>
                                                </form>
                                                <div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                x Rp <?= number_format($barang["harga_produk"], 0, ",", "."); ?>
                                            </div>
                                        </div>
                                        <a href="hapus-barang.php?id=<?= $id_produk ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus barang?')">Hapus</a>
                                        <a href="" class="btn btn-warning btn-sm "><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        <a href="<?php ?>" class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $totalHarga += $subHarga;
                    endforeach ?>
                <?php endif ?>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 18px;"><strong>Total</strong></p>
                            </div>
                            <div class="col text-right">
                                <p style="font-size: 18px;">Rp <?= number_format($totalHarga, 0, ",", "."); ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <a href="index.php" class="btn btn-light btn-block" role="button" aria-pressed="true">Belanja Lagi</a>
                            </div>
                            <div class="col text-right">
                                <a href="checkout.php" class="btn btn-info btn-block" type="button" name="bayar"><i>Checkout</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <div class="custom-control custom-radio"><input class="custom-control-input" type="radio" id="formCheck-1" name="size" value="s" checked=""><label class="custom-control-label" for="formCheck-1">Alamat Utama</label></div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col text-right"><button class="btn btn-outline-dark btn-block" type="button">Tambah Alamat Baru</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Profile-Edit-Form.js"></script>
    <script src="assets/js/WOWSlider-about-us.js"></script>
</body>

</html>