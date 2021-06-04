<?php
session_start();
require 'admin/dist/functions.php';

$data = "SELECT * FROM pembelian_barang JOIN pelanggan
    ON pembelian_barang.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian_barang.id_pembelian='$_GET[id]'";

$pembelian = mysqli_query($conn, $data);
$detail = mysqli_fetch_assoc($pembelian);

$idPelangganBeli = $detail["id_pelanggan"];
$idPelangganLogin = $_SESSION["loginPelanggan"]["id_pelanggan"];
if ($idPelangganBeli !== $idPelangganLogin) {
    echo "<script>alert ('Mohon maaf beda pembeli!')</script>";
    echo "<script>location='riwayat.php'</script>";
    exit();
}
$totalBarang = 0;
$totalHarga = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Toko Salsabila - Detail Pembelian</title>
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
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: #979890;">
            <div class="container"><img src="assets/img/toko.png" style="width: 100px;"><a class="navbar-brand" href="#" style="font-size: 23px;">Toko Salsabila</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                    </ul>
                    <span class="navbar-text actions">
                        <ul class="nav navbar-nav mr-auto"></ul>
                        <span class="navbar-text actions">
                        
                            <?php if (isset($_SESSION['loginPelanggan'])) : ?>
                                <a class="btn btn-light action-button w-5 p-2" role="button" href="index.php">Home</a>
                                <a class="btn btn-light action-button w-5 p-2" role="button" href="riwayat.php ">Riwayat</a>
                            <?php endif ?>
                        </span>
                    </span>
                </div>
            </div>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <i class="">Tabel Produk yang telah dicheckout</i>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group">
                    <h3><strong>Tanggal pembelian : <?= $detail['tanggal_pembelian']; ?> </strong></h3>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <div id="offline_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable no-footer" id="offline" role="grid" aria-describedby="offline_info" style="width: 100%;" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 99px;" aria-sort="ascending" aria-label="No: activate to sort column descending">No.
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                    Gambar</th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                    Nama Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 139px;" aria-label="Email: activate to sort column ascending">
                                                    Deskripsi
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Jumlah
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Sub Harga
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nomor = 1;
                                            $ambil = mysqli_query($conn, "SELECT * FROM checkout WHERE id_pembelian='$_GET[id]'");
                                            while ($barang = mysqli_fetch_assoc($ambil)) :
                                                $hargaPrdouk = $barang['harga_produk'];
                                                $harga = $hargaPrdouk * $barang['jumlah'];
                                            ?>
                                                <tr class="odd">
                                                    <td class="text-center text-justify"><?= $nomor; ?></td>
                                                    <td><img src="admin/dist/assets/img/<?= $barang["foto_produk"]; ?> " width="50%"></td>
                                                    <td><?= $barang["nama"]; ?></td>
                                                    <td><?= substr($barang['deskripsi'], 0, 100), ""; ?><a href="#">(Selengkapnya..)</a></td>
                                                    <td class="text-center text-justify">Rp <?= number_format($barang['harga_produk'], 0, ",", "."); ?></td>
                                                    <td class="text-center text-justify"><?= $barang['jumlah']; ?></td>
                                                    <td class="text-center text-justify">Rp <?= number_format($barang['sub_harga'], 0, ",", "."); ?></td>
                                                </tr>
                                                <?php $nomor++;
                                                $totalHarga += $harga;
                                                ?>
                                            <?php
                                            endwhile; ?>
                                        </tbody>
                                        <tfoot class="table-responsive-md table-responsive-sm table-info">
                                            <tr class="odd">
                                                <th colspan="6">Total Harga : </th>
                                                <th class="text-center" colspan="6">Rp <?= number_format($totalHarga, 0, ",", "."); ?> </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">Nama :</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $_SESSION['loginPelanggan']['Nama'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">No Telepon :</label>
                                        <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $_SESSION['loginPelanggan']['no_hp'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">E-mail :</label>
                                        <input type="text" name="email" id="email" class="form-control" value="<?= $_SESSION['loginPelanggan']['email'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat :</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="alamat" value="<?= $_SESSION['loginPelanggan']['alamat'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group alert alert-info w-auto">
                                        <p class="w-100" style="font-size: medium;">
                                            Silahkan melakukan pembayaran Rp <?= number_format($totalHarga, 0, ",", "."); ?> ke
                                            <!-- <br> -->
                                            <strong>BANK BRI 4199-0101-0791-531 AN. Rana Salsabila</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group text-center">
                                        <a href="pembayaran.php?id=<?= $_GET['id']; ?>" class="btn btn-outline-primary" type="button" name="bayar"><Strong><i>Konfirmasi Pembayaran</i></Strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>