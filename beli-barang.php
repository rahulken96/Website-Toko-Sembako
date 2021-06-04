<?php
session_start();
$idProduk = $_GET["id"];

if (isset($_SESSION['keranjang'][$idProduk])) {
    $_SESSION['keranjang'][$idProduk] += 1;
} else {
    $_SESSION['keranjang'][$idProduk] = 1;
}
 
echo "<script>
    alert('Produk berhasil ditambahkan!');
    document.location.href = 'Keranjang.php';
    </script>";

?>