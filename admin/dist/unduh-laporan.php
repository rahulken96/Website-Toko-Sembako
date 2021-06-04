<?php
require 'functions.php';

// Require composer autoload
require_once '../../vendor/autoload.php';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$tglMulai = $_GET["tglm"];
$tglSelesai = $_GET["tgls"];
$status = $_GET["status"];
$ambil = mysqli_query($conn,"SELECT * FROM pembelian_barang pb LEFT JOIN pelanggan pl ON pb.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tglMulai' AND '$tglSelesai'");
while ($detail = $ambil->fetch_assoc()) {
    $semuaData[] = $detail;
}
$isi = "<h3>Laporan Pembelian " . $status . "</h3>";
$isi .= "<h5>Mulai " . date("d F Y", strtotime($tglMulai)) . " hingga " . date("d F Y", strtotime($tglSelesai)) . "</h5>";
$isi .= "<table class='table table-bordered' border='1' >";
$isi .= "<thead>";
$isi .= "<tr>
<th>No</th>
<th>Pelanggan</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Status</th>
</tr>";
$isi .= "</thead><br>";
$isi .= "<tbody>";
$total = 0;
foreach ($semuaData as $key => $value) :
    $total += $value['total_harga'];
    $nomor = $key + 1;
    $isi .= "<tr>";
    $isi .= "<td>" . $nomor . "</td>";
    $isi .= "<td>" . $value["Nama"] . "</td>";
    $isi .= "<td>" . date("d F Y", strtotime($value["tanggal_pembelian"])) . "</td>";
    $isi .= "<td>Rp. " . number_format($value["total_harga"]) . ",00</td>";
    $isi .= "<td>" . $value["status_pembelian"] . "</td>";
    $isi .= "</tr>";
endforeach;
$isi .= "</tbody>";
$isi .= "<tfoot>";
$isi .= "<tr>";
$isi .= "<th colspan='3'>Total</th>";
$isi .= "<th>Rp. " . number_format($total) . "</th>";
$isi .= "<th></th>";
$isi .= "</tr>";
$isi .= "</tfoot>";
$isi .= "</table>";

// Write some HTML code:
$mpdf->WriteHTML($isi);

// Output a PDF file directly to the browser
$mpdf->Output("Laporan.pdf", "I");
