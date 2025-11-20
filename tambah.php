<?php include 'koneksi.php'; ?>

<?php
if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar (opsional)
    $gambar = "";
    if ($_FILES['gambar']['name'] != "") {
        $gambar = "img_" . time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $gambar);
    }

    $query = mysqli_query($koneksi, 
        "INSERT INTO produk(nama, harga, stok, kategori, deskripsi, gambar)
         VALUES ('$nama', '$harga', '$stok', '$kategori', '$deskripsi', '$gambar')"
    );

    if ($query) {
        echo "<script>alert('Produk berhasil ditambahkan'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<h2>Tambah Produk Baru</h2>

<form method="post" enctype="multipart/form-data">
    Nama Roti: <br>
    <input type="text" name="nama" required><br><br>

    Harga: <br>
    <input type="number" name="harga" required><br><br>

    Stok: <br>
    <input type="number" name="stok" required><br><br>

    Kategori: <br>
    <input type="text" name="kategori" required><br><br>

    Deskripsi: <br>
    <textarea name="deskripsi"></textarea><br><br>

    Gambar (opsional): <br>
    <input type="file" name="gambar"><br><br>

    <button type="submit" name="submit">Simpan</button>
    <a href="index.php">Kembali</a>
</form>

</body>
</html>
