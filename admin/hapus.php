<?php 
include 'koneksi.php';
include 'header.php'; 

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");

echo "<script>alert('Produk berhasil dihapus'); window.location='index.php';</script>";
include 'footer.php';?>
