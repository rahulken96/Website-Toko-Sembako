<?php
session_start();
require 'admin/dist/functions.php';

$idPembeli = $_GET["id"];

if (!isset($_SESSION["loginPelanggan"]) or empty($_SESSION["keranjang"])) {
    echo "<script>alert ('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}

$ambil = mysqli_query($conn, "SELECT * FROM pembelian_barang WHERE id_pembelian = '$idPembeli'");
$dataPembeli = mysqli_fetch_assoc($ambil);
$idPelangganBeli = $dataPembeli['id_pelanggan'];
$idPelangganLogin = $_SESSION['loginPelanggan']['id_pelanggan'];
if ($idPelangganLogin !== $idPelangganBeli) {
    echo "<script>alert ('Anda bukan pembeli asli nya!');</script>";
    echo "<script>location='riwayat.php;</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Pembayaran</title>
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
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim Bukti Pembayaran Anda disini</p>
        <div class="alert alert-info">total tagihan anda
            <strong>Rp.<?php echo number_format($dataPembeli["total_harga"]) ?>
            </strong>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Pembeli</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank" required>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1" required>
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti" required>
                <p class="text-danger">foto bukti harus maksimal 5mb</p>
            </div>
            <button class="btn btn-primary" name="kirim">kirim</button>
        </form>
    </div>
    <?php
    if (isset($_POST["kirim"])) {
        if (kirimBukti($_POST, $idPembeli) > 0) {
            echo "<script>alert ('terima kasih sudah mengirimkan bukti pembayaran');</script>";
            echo "<script>location='riwayat.php';</script>";
        } else {
            echo "<script>alert ('Data/file yang kamu kirim salah!');</script>";
        }
    }
    ?>
</body>

</html>