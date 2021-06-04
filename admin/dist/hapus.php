<?php
$id = $_GET["id"]; 
    if(hapus($id) > 0){
        echo "<script>
        alert('Produk berhasil dihapus');
        document.location.href = 'index.php?halaman=produk';
        </script>";
    }
    else {
        echo "<script>
        alert('Produk gagal dihapus');
        document.location.href = 'index.php?halaman=produk';
        </script>";
    }
?>