<?php 
include __DIR__ . '/../database/koneksi.php';
include __DIR__ . '/layout/header_edit.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
$produk = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $produk['gambar']; // gambar lama

    // Upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $fileName = "img_" . time() . "_" . basename($_FILES['gambar']['name']);
        $uploadPath = __DIR__ . "/../uploads/" . $fileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadPath)) {
            $gambar = $fileName;
        }
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

<div class="p-6 flex justify-center items-start mt-8 mb-10">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-4xl">

        <form method="post" enctype="multipart/form-data" class="space-y-4">

            <div>
                <label class="font-semibold">Nama</label>
                <input type="text" name="nama" value="<?= $produk['nama'] ?>" 
                       class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="font-semibold">Harga</label>
                <input type="number" name="harga" value="<?= $produk['harga'] ?>" 
                       class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="font-semibold">Stok</label>
                <input type="number" name="stok" value="<?= $produk['stok'] ?>" 
                       class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="font-semibold">Kategori</label>
                <input type="text" name="kategori" value="<?= $produk['kategori'] ?>" 
                       class="w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="4" 
                          class="w-full p-3 border border-gray-300 rounded-lg"><?= $produk['deskripsi'] ?></textarea>
            </div>

            <div>
                <label class="font-semibold">Gambar Saat Ini</label>
                <div class="text-center my-2">
                    <img src="../uploads/<?= $produk['gambar'] ?>" 
                         class="rounded-lg shadow-sm" 
                         style="width:200px; height:200px; object-fit:cover;">
                </div>
            </div>

            <div>
                <label class="font-semibold">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex justify-end mt-6 space-x-4">
                <button type="submit" name="submit" class="bg-amber-800 text-white px-6 py-2 rounded-lg hover:bg-amber-700 shadow">💾 Simpan</button>
            </div>

        </form>
    </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
