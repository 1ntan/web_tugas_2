<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Toko Roti</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #8b4513;
            color: white;
        }
        a.btn {
            padding: 6px 12px;
            background-color: #8b4513;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.btn:hover { background-color: #a3612d; }
    </style>
</head>
<body>

<h2>Daftar Produk Roti</h2>

<a href="tambah.php" class="btn">+ Tambah Produk</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($query)) {
        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['nama']}</td>
            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td>{$row['stok']}</td>
            <td>{$row['kategori']}</td>
            <td>
                <a href='edit.php?id={$row['id']}' class='btn'>Edit</a>
                <a href='hapus.php?id={$row['id']}' class='btn' style='background:red;' onclick='return confirm(\"Apakah yakin ingin menghapus?\")'>Hapus</a>
            </td>
        </tr>
        ";
    }
    ?>
</table>

</body>
</html>
