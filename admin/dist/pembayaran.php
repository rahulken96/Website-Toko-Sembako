<?php

$id_pembelian = $_GET['id'];
$resultPembelian = query("SELECT * FROM pembayaran WHERE id_pembelian = $id_pembelian")[0];

if (isset($_POST['proses'])) {
    
    $status = $_POST['status_pembelian'];
    mysqli_query($conn, "UPDATE pembelian_barang SET status_pembelian = '$status' WHERE id_pembelian = '$id_pembelian'");

    echo "<script>
    alert('Data sudah diperbaharui');
    document.location.href = 'index.php?halaman=pembelian';
    </script>";
}


?>

<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Halaman Pembayaran Pelanggan</title>
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
        <h1 class="mt-4">Update Status Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembelian</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>
                            Nama
                        </th>
                        <td>
                            <?= $resultPembelian['Nama']; ?>
                        </td>
                    <tr>
                        <th>
                            Bank
                        </th>
                        <td>
                            <?= $resultPembelian['Bank']; ?>
                        </td>
                    <tr>
                        <th>
                            Jumlah
                        </th>
                        <td>Rp.
                            <?= number_format($resultPembelian['Jumlah']); ?>
                        </td>
                    <tr>
                        <th>
                            Tanggal
                        </th>
                        <td>
                            <?= $resultPembelian['tanggal']; ?>
                        </td>
                    </tr>
                    </tr>
                    </tr>
                    </tr>
                </table>
                <form action="" method="post">
                    <!-- <div class="form-group">
                        <label for="resi">No. Resi Pengiriman</label>
                        <input type="text" class="form-control" name="resi_pengiriman">
                    </div> -->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status_pembelian" class="form-control">
                            <option value="">Pilih Status</option>
                            <option value="Lunas">Lunas</option>
                            <option value="Barang dikirim">Barang dikirim</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>
                    <button class="btn-info btn" name="proses">Proses</button>
                </form>
            </div>
            <div class="col-md-6">
                <img src="../../bukti-pembayaran/<?= $resultPembelian['Bukti']; ?>" class="img-fluid">
            </div>
        </div>

    </div>
</body>

</html>