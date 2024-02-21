<?php
include "koneksi.php"; // Sertakan file koneksi.php untuk menghubungkan ke database.
session_start(); // Mulai sesi.

$fotoid = $_POST['FotoID']; // Ambil ID Foto dari data yang dikirimkan melalui metode POST.
$isikomentar = $_POST['IsiKomentar']; // Ambil isi komentar dari data yang dikirimkan melalui metode POST.
$tanggalkomentar = date("Y-m-d"); // Ambil tanggal saat ini.
$userid = $_SESSION['UserID']; // Ambil ID pengguna dari sesi yang aktif.

$sql = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('', '$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')"); // Simpan komentar ke dalam database.

header("Location: " . $_SERVER['HTTP_REFERER']); // Arahkan pengguna kembali ke halaman sebelumnya.
?>