<?php
$id = $_GET['id'];
$detail = query("SELECT * FROM pembelian_barang JOIN pelanggan ON pembelian_barang.id_pelanggan=pelanggan.id_pelanggan
        WHERE pembelian_barang.id_pembelian = '$id'");

$detailPembelianProduk = query("SELECT * FROM checkout JOIN produk ON checkout.id_produk=produk.id_produk 
                        WHERE checkout.id_pembelian ='$id'");


?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
</head>
<link rel="stylesheet" href="style.css" type="text/css">

<body>
    <div class="container-fluid">
        <h1 class="mt-4">Detail Pembelian</h1>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="p-md-3">
                        <h5>Pelanggan</h5>
                        <div class="mb-1">
                            <strong><?= $detail[0]['Nama']; ?></strong>
                        </div>
                        Nomor Telepon : <?= $detail[0]["no_telp"]; ?> <br>
                        Email : <?= $detail[0]["email"]; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="p-md-3">
                        <h5>Pembelian</h5>
                        <div class="mt-1 mb-4">
                            Tanggal : <?= $detail[0]["tanggal_pembelian"]; ?> <br>
                            Total : Rp. <?= number_format($detail[0]["total_harga"]); ?> <br>
                            Status : <?= $detail[0]['status_pembelian']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="p-md-3">
                        <h5>Pengiriman</h5>
                        <!-- <div class="mb-1">
                            <strong><?= $detail[0]['daerah']; ?></strong>
                        </div>
                        Tarif : <?= $detail[0]["total_harga"]; ?> <br> -->
                        Tujuan : <?= $detail[0]["alamat"]; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table fa-w-16 mr-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
                    </path>
                </svg><!-- <i class="fas fa-table mr-1"></i> -->Tabel Detail Pembelian
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="offline_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="offline_length"><label>Show <select name="offline_length" aria-controls="offline" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="offline_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="offline"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable no-footer" id="offline" role="grid" aria-describedby="offline_info" style="width: 100%;" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center" role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 99px;" aria-sort="ascending" aria-label="No: activate to sort column descending">No.
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                Nama Produk</th>
                                            <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                Harga</th>
                                            <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">Jumlah
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">Subtotal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php foreach ($detailPembelianProduk as $detailPembelian) : ?>
                                            <tr>
                                                <td class="text-xl-center"><?= $nomor; ?></td>
                                                <td><?= $detailPembelian['nama_produk']; ?></td>
                                                <td>Rp. <?= number_format($detailPembelian['harga_produk']); ?></td>
                                                <td><?= $detailPembelian['jumlah']; ?></td>
                                                <td>Rp. <?= number_format($detailPembelian['harga_produk'] * $detailPembelian['jumlah']); ?></td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="offline_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="offline_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="offline_previous"><a href="#" aria-controls="offline" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                        <li class="paginate_button page-item next disabled" id="offline_next"><a href="#" aria-controls="offline" data-dt-idx="1" tabindex="0" class="page-link">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>