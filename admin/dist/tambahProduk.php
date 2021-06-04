<?php


if(isset($_POST['submit'])){
    if(tambah($_POST) > 0){
        echo "<script>
        alert('Produk berhasil ditambahkan');
        document.location.href = 'index.php?halaman=produk';
        </script>";
    }
    else {
        echo "<script>
        alert('Produk gagal ditambahkan');
        document.location.href = 'index.php?halaman=produk';
        </script>";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Produk</h1>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-grup">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukan nama produk . . . ">
            </div>
            <div class="form-grup">
                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga_produk" class="form-control" id="harga_produk" placeholder="Masukan harga produk . . . ">
            
            <div class="form-grup">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control" name="deskripsi" class="form-control" id="deskripsi" rows=5 placeholder="Masukan deskripsi produk . . . "></textarea>
            </div>
            <div class="form-grup">
                <label for="foto">Foto Produk</label>
                <input type="file" name="foto_produk" class="form-control">
            </div>
                <button type="submit" class="btn btn-primary mt-3" name="submit" >Tambah</button>
        </form>
    </div>
</body>
</html>