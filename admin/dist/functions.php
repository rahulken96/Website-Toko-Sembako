<?php
$conn = mysqli_connect("localhost", "root", "", "tsalsabila");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cariProduk($data)
{
    $cari = "SELECT * FROM produk WHERE nama_produk LIKE '%$data%'";
    return query($cari);
}



function tambah($data)
{
    global $conn;
    $namaProduk = htmlspecialchars($data['nama_produk']);
    $hargaProduk = htmlspecialchars($data['harga_produk']);
    $deskripsiProduk = htmlspecialchars($data['deskripsi']);

    //upload foto produk
    $fotoProduk = upload();
    if ($fotoProduk === false) {
        return false;
    }

    $query = "INSERT INTO produk 
        VALUES 
        ('', '$namaProduk', '$hargaProduk', '$deskripsiProduk','$fotoProduk')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    global $conn;
    $namaFile = $_FILES['foto_produk']['name'];
    $ukuranFile = $_FILES['foto_produk']['size'];
    $error = $_FILES['foto_produk']['error'];
    $penyimpananSementara = $_FILES['foto_produk']['tmp_name'];

    //cek apakah file ada atau tidak
    if ($error == 4) {
        echo "<script>
            alert('Upload foto produk terlebih dahulu');
            </script>
            ";

        return false;
    }

    //cek ekstensi file gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar');
            </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar);
            </script";
        return false;
    }
    //generate nama file unik dengan fungsi uniqid
    $namaFileBaru = $namaFile;
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($penyimpananSementara, 'assets/img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    $query = "DELETE FROM produk WHERE id_produk = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data['id_produk'];
    $nama = htmlspecialchars($data['nama_produk']);
    $harga = htmlspecialchars($data['harga_produk']);
    $deskripsi = $data['dekripsi'];
    $fotoProdukLama = $data['foto_produk_lama'];
    
    //cek apakah pilih gambar baru atau tidak
    
    if ($_FILES['foto_produk']['error'] === 4) {
        $fotoProduk = $fotoProdukLama;
        return false;
    } else {
        $fotoProduk = upload();
    }

    $query = "UPDATE produk 
        SET nama_produk ='$nama',
        harga_produk = '$harga',
        foto_produk = '$fotoProduk',
        deskripsi = '$deskripsi' WHERE id_produk='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function register($data)
{
    global $conn;
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $konfirmasiPassword = htmlspecialchars($data['konfirmasiPassword']);
    $email = htmlspecialchars($data['email']);
    $nama = htmlspecialchars($data['name']);
    $telepon = htmlspecialchars($data['telephone']);
    $alamat = htmlspecialchars($data['alamat']);


    $resultUsername = mysqli_query($conn, "SELECT username FROM pelanggan WHERE username='$username'");

    //cek username apakah sudah ada atau tidak
    if (mysqli_fetch_assoc($resultUsername)) {
        echo "
            <script>
                alert('Username sudah terdaftar!');
            </script>
            ";
        return false;
    }

    //cek apakah email sudah terdaftar
    $resultEmail = mysqli_query($conn, "SELECT email FROM pelanggan WHERE email='$email'");
    if (mysqli_fetch_assoc($resultEmail)) {
        echo "
            <script>
                alert('Email sudah terdaftar');
            </script>";
        return false;
    }

    //cek nomer telepon apakah sudah ada atau tidak
    $resultTelepon = mysqli_query($conn, "SELECT no_hp FROM pelanggan WHERE no_hp='$telepon'");
    if (mysqli_fetch_assoc($resultTelepon)) {
        echo "
            <script>
                alert('Nomor telepon sudah terdaftar!');
            </script>
            ";
        return false;
    }

    //cek konfirmasi password cocok atau tidak
    if ($password !== $konfirmasiPassword) {
        echo "
            <script>
            alert('Konfirmasi password tidak cocok');
            </script>";
        return false;
    }

    //amankan akun dengan password hash
    // $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke db
    mysqli_query($conn, "INSERT INTO pelanggan VALUES('','$nama','$username','$password','$telepon','$email','$alamat')");
    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;
    $username = $data['username'];
    $username = str_replace("'","",$username);
    $password = $data['password'];
    $password = str_replace("'","",$password);

    $result = mysqli_query($conn, "SELECT * FROM `pelanggan` WHERE `username`='$username' AND `password`='$password'");

    $resultAdmin = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password'");

    //cek login pelanggan
    if (mysqli_num_rows($result) == 1) {
        $dataPelanggan = mysqli_fetch_assoc($result);
        $_SESSION['loginPelanggan'] = $dataPelanggan;
        return mysqli_affected_rows($conn) + 1;
    }

    //cek login admin
    if (mysqli_num_rows($resultAdmin) == 1) {
        $dataAdmin = mysqli_fetch_assoc($resultAdmin);
        $_SESSION['loginAdmin'] = $dataAdmin;
        header("Location: admin/dist/index.php");
    }

    return mysqli_affected_rows($conn);
}

function bayar($totalHarga)
{
    global $conn;
    $idPelanggan = $_SESSION['loginPelanggan']['id_pelanggan'];
    $namaPelanggan = $_SESSION['loginPelanggan']['Nama'];
    $noHpPelanggan = $_SESSION['loginPelanggan']['no_hp'];
    $alamatPelanggan = $_SESSION['loginPelanggan']['alamat'];
    date_default_timezone_set('Asia/Jakarta');
    $tanggalPembelian = date("Y-m-d H:i:s");

    //Menyimpan ke tabel pembelian 
    $value = "INSERT 
        INTO `pembelian_barang` (id_pelanggan,Nama,tanggal_pembelian,alamat,no_telp,total_harga)
        VALUE ('$idPelanggan','$namaPelanggan','$tanggalPembelian','$alamatPelanggan','$noHpPelanggan','$totalHarga')";
    mysqli_query($conn, $value);

    //Memasukkan semua kedalam tabel checkout
    $idPembelian = mysqli_insert_id($conn);
    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
        $barang = $ambil->fetch_assoc();
        $namaProduk = $barang["nama_produk"];
        $hargaPrdouk = $barang['harga_produk'];
        $descProduk = $barang['deskripsi'];
        $fotoProduk = $barang['foto_produk'];
        $subHarga = $hargaPrdouk * $jumlah;

        $dataProduk = "INSERT
            INTO `checkout` (id_pembelian,id_produk,nama,harga_produk,jumlah,sub_harga,deskripsi,foto_produk)
            VALUE ('$idPembelian','$id_produk','$namaProduk','$hargaPrdouk','$jumlah','$subHarga','$descProduk','$fotoProduk') ";
        mysqli_query($conn, $dataProduk);
    }

    // unset($_SESSION['keranjang']);

    echo "<script>
    alert('Produk berhasil dicheckout');
    </script>";
    echo "<script>
    location = 'nota.php?id=$idPembelian'
    </script>";
}

function kirimBukti($data, $idPembeli)
{
    global $conn;
    $namaBukti = $_FILES["bukti"]["name"];
    $sizeBukti = $_FILES["bukti"]["size"];
    $lokasiBukti = $_FILES["bukti"]["tmp_name"];
    date_default_timezone_set('Asia/Jakarta');
    $namaFix = date("Y-m-d H;i;s") . $namaBukti;
    move_uploaded_file($lokasiBukti, "bukti-pembayaran/$namaFix");

    // Cek apakah yang diupload adalah gambar
    $ekstensiValid = ["jpg", "jpeg", "png"];
    $ekstensiFotoProduk = explode(".", "$namaBukti");
    $ekstensiFotoProduk = strtolower(end($ekstensiFotoProduk));
    if (!in_array($ekstensiFotoProduk, $ekstensiValid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    //cek ukuran foto terlalu besar
    if ($sizeBukti > 500000) {
        echo "<script>
        alert('Foto yang anda upload terlalu besar!');
        </script>";
        return false;
    }

    $nama = htmlspecialchars($data["nama"]);
    $bank = htmlspecialchars($data["bank"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tanggal = date("Y-m-d");

    mysqli_query($conn, "INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `Nama`, `Bank`, `tanggal`, `Bukti`, `Jumlah`)
        VALUES ('', '$idPembeli', '$nama', '$bank', '$tanggal', '$namaFix', '$jumlah')");
    mysqli_query($conn, "UPDATE pembelian_barang SET status_pembelian = 'Sudah dikirim pembayaran'
        WHERE id_pembelian = '$idPembeli'");
    return mysqli_affected_rows($conn);
}
