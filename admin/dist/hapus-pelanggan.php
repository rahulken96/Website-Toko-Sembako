<?php
$conn = mysqli_connect("localhost", "root", "", "tsalsabila");
$idPelanggan = $_GET['id_pelanggan'];
$value = "DELETE FROM pelanggan WHERE id_pelanggan='$idPelanggan'";
mysqli_query($conn, $value);
$hapus = mysqli_affected_rows($conn);

if ($hapus > 0) {
    echo "<script>alert('pelanggan terhapus');</script>";
    echo "<script>location='index.php?halaman=pelanggan&id=$idPelanggan';</script>";
}

?>