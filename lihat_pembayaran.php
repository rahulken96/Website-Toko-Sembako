<?php
session_start();
require 'admin/dist/functions.php';
$idPembelian = $_GET["id"];
$ambil = mysqli_query($conn, "SELECT * FROM pembayaran LEFT JOIN pembelian_barang ON pembayaran.id_pembelian=pembelian_barang.id_pembelian WHERE pembelian_barang.id_pembelian = '$idPembelian'");
$dataBarang = mysqli_fetch_assoc($ambil);
date_default_timezone_set('Asia/Jakarta');
$tanggalPembelian = $dataBarang['tanggal'] . date(' H:i:s');
if (empty($dataBarang)) {
    echo "<script>alert('anda tidak berhak lurd')</script>";
    echo "<script>location='riwayat.php'</script>";
    exit();
}
if ($_SESSION["loginPelanggan"]["id_pelanggan"] !== $dataBarang["id_pelanggan"]) {
    echo "<script>alert('Maaf anda belum bayar!')</script>";
    echo "<script>location='riwayat.php'</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Lihat Pembayaran</title>
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
    <div class="container">
        <h3 class="mt-4">
            <a href="riwayat.php" class="">
                <i class="fa fa-arrow-circle-o-left" aria-hidden="true">
                </i>
            </a> Lihat Pembayaran
        </h3>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th><?= $dataBarang["Nama"] ?></th>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <th><?= $dataBarang["Bank"] ?></th>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th><?= $tanggalPembelian ?></th>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>Rp. <?= number_format($dataBarang["Jumlah"], 0, ',', '.') ?></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="bukti-pembayaran/<?= $dataBarang["Bukti"] ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</body>

</html>