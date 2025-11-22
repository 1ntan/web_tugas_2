<?php 
include __DIR__ . '/../database/koneksi.php'; 
include __DIR__ . '/layout/header.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
$produk = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $produk['gambar']; 

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

    echo $query ? 
        "<script>alert('Data berhasil diupdate'); window.location='index.php';</script>" :
        "<script>alert('Update gagal');</script>";
}
?>

<div class="container mt-4">
    <div class="card p-4 shadow">
        <h3>Edit Produk</h3>
        <form method="post" enctype="multipart/form-data">

            <label>Nama Roti</label>
            <input type="text" class="form-control" name="nama" value="<?= $produk['nama'] ?>" required>

            <label class="mt-2">Harga</label>
            <input type="number" class="form-control" name="harga" value="<?= $produk['harga'] ?>" required>

            <label class="mt-2">Stok</label>
            <input type="number" class="form-control" name="stok" value="<?= $produk['stok'] ?>" required>

            <label class="mt-2">Kategori</label>
            <input type="text" class="form-control" name="kategori" value="<?= $produk['kategori'] ?>" required>

            <label class="mt-2">Deskripsi</label>
            <textarea class="form-control" name="deskripsi"><?= $produk['deskripsi'] ?></textarea>

            <label class="mt-2">Gambar Saat Ini</label><br>
            <img src="uploads/<?= $produk['gambar'] ?>" width="160" class="rounded mb-3">

            <label>Gambar Baru (opsional)</label>
            <input type="file" class="form-control" name="gambar">

            <button type="submit" name="submit" class="btn btn-success mt-3">Update</button>
            <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
