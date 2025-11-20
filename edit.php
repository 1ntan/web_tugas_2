<?php 
include 'koneksi.php'; 

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
$produk = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $produk['gambar']; // default gambar lama

    if ($_FILES['gambar']['name'] != "") {
        $gambar = "img_" . time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
    }

    $query = mysqli_query($koneksi, 
        "UPDATE produk SET 
            nama='$nama',
            harga='$harga',
            stok='$stok',
            kategori='$kategori',
            deskripsi='$deskripsi',
            gambar='$gambar'
        WHERE id=$id"
    );

    if ($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Update gagal');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h2>Edit Produk</h2>

<form method="post" enctype="multipart/form-data">
    Nama Roti: <br>
    <input type="text" name="nama" value="<?= $produk['nama'] ?>" required><br><br>

    Harga: <br>
    <input type="number" name="harga" value="<?= $produk['harga'] ?>" required><br><br>

    Stok: <br>
    <input type="number" name="stok" value="<?= $produk['stok'] ?>" required><br><br>

    Kategori: <br>
    <input type="text" name="kategori" value="<?= $produk['kategori'] ?>" required><br><br>

    Deskripsi: <br>
    <textarea name="deskripsi"><?= $produk['deskripsi'] ?></textarea><br><br>

    Gambar Baru (opsional): <br>
    <input type="file" name="gambar"><br><br>

    <button type="submit" name="submit">Update</button>
    <a href="index.php">Kembali</a>
</form>

</body>
</html>
