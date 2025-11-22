<?php
// Koneksi ke database
include __DIR__ . '/../database/koneksi.php';

// Judul halaman (opsional)
$title = "Daftar Produk Roti";

// Header layout
include __DIR__ . '/layout/header.php';
?>

<h2 class="text-2xl font-bold mb-6 text-amber-800">Daftar Produk Roti</h2>

<!-- Tombol Tambah -->
<a href="tambah.php" 
   class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
   + Tambah Produk
</a>

<!-- Tabel Produk -->
<table class="w-full mt-6 border bg-white shadow text-sm">
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
    // Ambil data dari database
    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

    // Jika data kosong
    if (mysqli_num_rows($query) === 0) {
        echo '
        <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">
                Belum ada produk.
            </td>
        </tr>';
    }

    // Loop data
    while ($row = mysqli_fetch_assoc($query)) {

        // Path gambar
        $imgPath = "../uploads/" . $row['gambar'];

        // Cek apakah file ada
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
                    Edit
                </a>

                <a href='hapus.php?id={$row['id']}'
                   onclick='return confirm(\"Apakah yakin ingin menghapus?\")'
                   class='bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition'>
                    Hapus
                </a>
            </td>
        </tr>
        ";
    }
    ?>
</table>

<?php 
// Footer layout
include __DIR__ . '/layout/footer.php';
?>
