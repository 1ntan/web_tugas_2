<?php 
// Koneksi ke Database
include __DIR__ . '/../database/koneksi.php'; 

// Judul halaman (kirim ke header)
$title = "Daftar Produk Roti";

// Tampilan atas layout
include __DIR__ . '/layout/header.php';
?>

<h2 class="text-xl font-bold mb-4">Daftar Produk Roti</h2>

<a href="tambah.php" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">+ Tambah Produk</a>

<table class="w-full mt-4 border bg-white shadow">
    <tr class="bg-amber-800 text-white">
        <th class="p-2 text-left">ID</th>
        <th class="p-2 text-left">Gambar</th>
        <th class="p-2 text-left">Nama</th>
        <th class="p-2 text-left">Harga</th>
        <th class="p-2 text-left">Stok</th>
        <th class="p-2 text-left">Kategori</th>
        <th class="p-2 text-left">Aksi</th>
    </tr>

    <?php
    // Ambil data mysql
    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

    // Jika tidak ada produk
    if (mysqli_num_rows($query) === 0) {
        echo '<tr><td colspan="6" class="p-3 text-center">Belum ada produk</td></tr>';
    }

    // Tampilkan produk
    while ($row = mysqli_fetch_assoc($query)) {
        $imgPath = "../uploads/" . $row['gambar'];
        $imgTag = (file_exists(__DIR__ . "/../uploads/" . $row['gambar']) && $row['gambar'] != "")
        ? "<img src='$imgPath' class='w-16 h-16 object-cover rounded'>"
        : "<span class='text-gray-400 text-sm'>Tidak ada</span>";

        echo "
        <tr class='border-b'>
            <td class='p-2 text-left'>{$row['id']}</td>
            <td class='p-2 text-left'>$imgTag</td>
            <td class='p-2 text-left'>{$row['nama']}</td>
            <td class='p-2 text-left'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td class='p-2 text-left'>{$row['stok']}</td>
            <td class='p-2 text-left'>{$row['kategori']}</td>
            <td class='p-2 text-left'>
                <a href='edit.php?id={$row['id']}' class='bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700'>Edit</a>
                <a href='hapus.php?id={$row['id']}' class='bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700' onclick='return confirm(\"Apakah yakin ingin menghapus?\")'>Hapus</a>
            </td>
        </tr>
        ";
    }
    ?>
</table>

<?php 
// Bagian footer layout
include __DIR__ . '/layout/footer.php';
?>
