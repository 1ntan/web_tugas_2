<?php 
include __DIR__ . '/../database/koneksi.php';

// Judul dikirim untuk header
$title = "Tambah Produk";

// Header layout
include __DIR__ . '/layout/header_tambah.php';
?>

<?php
if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar
    $gambar = "";
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = "img_" . time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . "/../uploads/" . $gambar);
    }

    $query = mysqli_query($koneksi,
        "INSERT INTO produk(nama,harga,stok,kategori,deskripsi,gambar)
         VALUES('$nama','$harga','$stok','$kategori','$deskripsi','$gambar')"
    );

    echo "<script>alert('Produk berhasil ditambahkan'); window.location='index.php';</script>";
}
?>

<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow">
    <form method="post" enctype="multipart/form-data" class="space-y-5">

        <div>
            <label class="font-semibold">Nama Roti</label>
            <input type="text" name="nama" class="w-full p-3 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Harga</label>
            <input type="number" name="harga" class="w-full p-3 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Stok</label>
            <input type="number" name="stok" class="w-full p-3 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Kategori</label>
            <input type="text" name="kategori" class="w-full p-3 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full p-3 border rounded" rows="4"></textarea>
        </div>

        <div>
            <label class="font-semibold">Gambar Produk</label>
            <input type="file" name="gambar" class="w-full p-2 border rounded">
        </div>

        <button type="submit" name="submit"
                class="bg-amber-800 text-white px-6 py-2 rounded-lg hover:bg-amber-700 shadow">
            + Tambah
        </button>

    </form>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
