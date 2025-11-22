<?php 
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");

echo "<script>alert('Produk berhasil dihapus'); window.location='index.php';</script>";
?>
