<?php
// Koneksi ke database
include __DIR__ . '/../database/koneksi.php';

// Judul halaman
$title = "Daftar Produk Roti";

/*
|--------------------------------------------------------------------------
| MODE PREVIEW USER (Frontend)
|--------------------------------------------------------------------------
*/
if (isset($_GET['preview']) && $_GET['preview'] === 'user') {

    include __DIR__ . '/layout/header_user.php';

    // Ambil data produk
    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
    ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>

            <div class="bg-white p-4 shadow rounded-lg">

                <?php 
                $imgPath = "../uploads/" . $row['gambar'];

                if ($row['gambar'] != "" && file_exists(__DIR__ . "/../uploads/" . $row['gambar'])) {
                    echo "<img src='$imgPath' class='w-full h-48 object-cover rounded'>";
                } else {
                    echo "<div class='w-full h-48 bg-gray-200 flex items-center justify-center rounded text-gray-500'>
                            Tidak ada gambar
                          </div>";
                }
                ?>

                <h3 class="text-lg font-bold mt-3 text-amber-800"><?= $row['nama'] ?></h3>

                <p class="text-gray-700">Harga: 
                    <b>Rp <?= number_format($row['harga'], 0, ',', '.') ?></b>
                </p>

                <p class="text-gray-600 text-sm">Stok: <?= $row['stok'] ?></p>
                <p class="text-gray-600 text-sm">Kategori: <?= $row['kategori'] ?></p>

            </div>

        <?php endwhile; ?>
    </div>

    <?php
    include __DIR__ . '/layout/footer.php';
    exit;
}

/*
|--------------------------------------------------------------------------
| MODE ADMIN
|--------------------------------------------------------------------------
*/
include __DIR__ . '/layout/header.php';
?>

<h2 class="text-2xl font-bold mb-6 text-amber-800">Daftar Produk Roti</h2>

<!-- Tombol Tambah -->
<a href="tambah.php" 
   class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
   + Add Product
</a>

<!-- Form Search -->
<form method="GET" class="mt-4 mb-4 flex items-center gap-3">
    <input 
        type="text" 
        name="search" 
        placeholder="Search.." 
        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
        class="border px-3 py-2 rounded w-64"
    >

</form>

<!-- Tabel Produk -->
<table class="w-full mt-2 border bg-white shadow text-sm">
    <tr class="bg-amber-800 text-white">
        <th class="p-3 text-left">ID</th>
        <th class="p-3 text-left">Gambar</th>
        <th class="p-3 text-left">Nama</th>
        <th class="p-3 text-left">Harga</th>
        <th class="p-3 text-left">Stok</th>
        <th class="p-3 text-left">Kategori</th>
        <th class="p-3 text-left">Aksi</th>
    </tr>

    <?php
    // ---------------------------
    // SEARCH LOGIC
    // ---------------------------

    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $keyword = mysqli_real_escape_string($koneksi, $_GET['search']);

        $query = mysqli_query($koneksi, "
            SELECT * FROM produk 
            WHERE nama LIKE '%$keyword%'
            ORDER BY id DESC
        ");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
    }


    // Jika tidak ada data
    if (mysqli_num_rows($query) === 0) {
        echo '
        <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">
                Data tidak ditemukan.
            </td>
        </tr>';
    }

    // Tampilkan data produk
    while ($row = mysqli_fetch_assoc($query)) {

        $imgPath = "../uploads/" . $row['gambar'];

        if ($row['gambar'] != "" && file_exists(__DIR__ . "/../uploads/" . $row['gambar'])) {
            $imgTag = "<img src='$imgPath' class='w-16 h-16 object-cover rounded shadow'>";
        } else {
            $imgTag = "<span class='text-gray-400 text-sm'>Tidak ada</span>";
        }

        echo "
        <tr class='border-b hover:bg-gray-50 transition'>
            <td class='p-3'>{$row['id']}</td>
            <td class='p-3'>$imgTag</td>
            <td class='p-3'>{$row['nama']}</td>
            <td class='p-3'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td class='p-3'>{$row['stok']}</td>
            <td class='p-3'>{$row['kategori']}</td>
            <td class='p-3 space-x-2'>

                <a href='edit.php?id={$row['id']}'
                   class='bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition'>
                    Update
                </a>

                <a href='hapus.php?id={$row['id']}'
                   onclick='return confirm(\"Apakah yakin ingin menghapus?\")'
                   class='bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition'>
                    Delete
                </a>

            </td>
        </tr>";
    }
    ?>
</table>

<?php 
include __DIR__ . '/layout/footer.php';
?>
