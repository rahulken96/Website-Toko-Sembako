<?php
$jumlahPelanggan = query("SELECT COUNT(id_pelanggan) AS jumlah_pelanggan FROM pelanggan")[0];
$pendapatan = query("SELECT SUM(jumlah) AS jumlah_pendapatan FROM pembayaran")[0];
$pending = query("SELECT COUNT(status_pembelian) AS pending FROM pembelian_barang WHERE status_pembelian = 'pending'")[0];
$dikirim = query("SELECT COUNT(status_pembelian) AS dikirim FROM pembelian_barang WHERE status_pembelian = 'Barang dikirim'")[0];
$jumlahProduk = query("SELECT COUNT(id_produk) AS jumlah_produk FROM produk")[0];
$lunas = query("SELECT COUNT(status_pembelian) AS lunas FROM pembelian_barang WHERE status_pembelian = 'Lunas'")[0];



?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selama Datang Admin</title>
</head>

<body>

    <div class="container-fluid">
        <h1 class="mt-4">Hello  <?= $_SESSION['loginAdmin']['Nama'];?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
            <?php
                date_default_timezone_set('Asia/Jakarta');
                print_r(date("e - D m y, H:i:s"));
                
            ?>
            </li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body"> <i class="fa fa-users"></i> Pelanggan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link"
                            href="index.php?halaman=pelanggan"><?= $jumlahPelanggan['jumlah_pelanggan'];?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body"> <i class="fa fa-money-bill mr-2"></i> Penghasilan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">Rp.
                            <?= number_format($pendapatan['jumlah_pendapatan']);?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body"> <i class="fas fa-shipping-fast"></i> Barang kang dikirim</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link"
                            href="index.php?halaman=pembelian"><?= $dikirim['dikirim'];?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body"> <i class="fas fa-clock"></i> Masih Diproses (pending)</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link"
                            href="index.php?halaman=pembelian"><?= $pending['pending'];?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body"> <svg class="bi bi-box mr-2" width="1em" height="1em" viewBox="0 0 16 16"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                        </svg>Produk</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link"
                            href="index.php?halaman=produk"><?= $jumlahProduk['jumlah_produk'];?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body"> <i class="fa fa-credit-card mr-2"></i>Lunas</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link"
                            href="index.php?halaman=pembelian">  <?= $lunas['lunas'];?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    


    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Profil Kang Duene</li>
    </ol>
    <div class="card-body">
        <form method="post">
            <div class="form-group row">
                <label for="staticNama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" readonly="readonly" class="form-control-plaintext" id="staticNama"
                        value="<?= $_SESSION['loginAdmin']['Nama'];?>">

                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly="" class="form-control-plaintext" id="staticEmail"
                        value="<?= $_SESSION['loginAdmin']['email_admin'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticNo_HP" class="col-sm-2 col-form-label">No. HP</label>
                <div class="col-sm-10">
                    <input type="text" readonly="" class="form-control-plaintext" id="staticNo_HP"
                        value="<?= $_SESSION['loginAdmin']['telp_admin'];?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="staticAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control-plaintext" name="alamat" id="inputAlamat" rows="2"
                        placeholder="Masukkan alamat" required="required"
                        ><?= $_SESSION['loginAdmin']['alamat_admin'];?></textarea>
                </div>
            </div>
        </form>
    </div>
</body>

</html>