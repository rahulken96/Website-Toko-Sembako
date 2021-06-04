<?php

$tglMulai = "-";
$tglSelesai = "-";
$semuaData = array();
$status = "";

if (isset($_POST["kirim"])) {
    $tglMulai = $_POST["tglm"];
    $tglSelesai = $_POST["tgls"];
    $status = $_POST["status"];

    $ambil = mysqli_query($conn, "SELECT * FROM pembelian_barang LEFT JOIN pelanggan ON pembelian_barang.id_pelanggan=pelanggan.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tglMulai' AND '$tglSelesai'");
    while ($detail = mysqli_fetch_assoc($ambil)) {
        $semuaData[] = $detail;
    }
    
}


?>
<h2>Laporan Pembelian dari <?= $tglMulai ?> hingga <?= $tglSelesai ?></h2>
<hr>
<form method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-grup">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm" value="<?= $tglMulai ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-grup">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls" value="<?= $tglSelesai ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-grup">
                <label>Status</label>
                <select name="status" id="" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="pending">Pending</option>
                    <option value="barang dikirim">Barang Dikirim</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" name="kirim"><i class="glyphicon glyphicon-tasks"></i>Lihat</button>
        </div>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead><br>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($semuaData as $key => $value) : ?>
            <?php $total += $value['total_harga'] ?>
            <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $value["Nama"] ?></td>
                <td><?= date("d F Y", strtotime($value["tanggal_pembelian"])) ?></td>
                <td>Rp. <?= number_format($value["total_harga"]) ?></td>
                <td><?= $value["status_pembelian"] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>Rp. <?= number_format($total) ?></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<a href="unduh-laporan.php?tglm=<?= $tglMulai ?>&tgls=<?= $tglSelesai ?>&status=<?= $status ?>" class="btn btn-primary m-3">DOWNLOAD PDF</a>