<?php
// Informasi koneksi ke database
$host ='localhost'; // Nama host MySQL, biasanya localhost jika server MySQL berjalan pada komputer yang sama dengan server web.
$user ='root'; // Username untuk mengakses database MySQL.
$pass =''; // Password untuk mengakses database MySQL.
$database ='gallery'; // Nama database yang ingin diakses.

// Melakukan koneksi ke database MySQL menggunakan fungsi mysqli_connect.
$koneksi = mysqli_connect($host,$user,$pass,$database);

// Periksa apakah koneksi berhasil atau tidak
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>