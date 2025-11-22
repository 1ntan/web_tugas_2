<?php
$koneksi = mysqli_connect("localhost", "root", "", "web_tugas_2");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
