<?php
session_start();
require 'admin/dist/functions.php';
if (!isset($_SESSION['loginPelanggan']) || empty($_SESSION["keranjang"])) {
    echo "<script>alert ('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Riwayat Belanja</title>
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
    <section class="riwayat">
        <div class="container">
            <h1 class="mt-4">
                <a href="index.php" class="">
                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true">
                    </i>
                </a> Home
            </h1>
            <h3>Riwayat Belanja - <?= $_SESSION["loginPelanggan"]["Nama"] ?></h3>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    //mendapatkan id_pelanggan yang login dari session
                    $idPelanggan = $_SESSION["loginPelanggan"]["id_pelanggan"];
                    $ambil = mysqli_query($conn, "SELECT * FROM pembelian_barang WHERE id_pelanggan = '$idPelanggan'");
                    while ($barang = mysqli_fetch_assoc($ambil)) {
                    ?>
                        <tr>
                            <td><?= $nomor; ?></td>
                            <td><?= $barang["tanggal_pembelian"] ?></td>
                            <td>
                                <?= $barang["status_pembelian"] ?><br>
                            </td>
                            <td>Rp. <?= number_format($barang["total_harga"], 1, ',', '.') ?></td>
                            <td class="col-4">
                                <a href="nota.php?id=<?= $barang["id_pembelian"]; ?>" class="btn btn-info col-3 mr-2">Nota</a>
                                <?php if ($barang['status_pembelian'] == "Pending") : ?>
                                    <a href="pembayaran.php?id=<?= $barang["id_pembelian"]; ?>" class="btn btn-success col-7">Konfirmasi Pembayaran</a>
                                <?php else : ?>
                                    <a href="lihat_pembayaran.php?id=<?= $barang["id_pembelian"]; ?>" class="btn btn-warning">Lihat Pembayaran</a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>