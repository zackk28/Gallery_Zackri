<?php
session_start(); // Mulai sesi.
include 'koneksi.php'; // Sertakan file koneksi.php untuk menghubungkan ke database.

$fotoid = $_GET['FotoID']; // Ambil ID Foto dari parameter GET.
$userid = $_SESSION['UserID']; // Ambil ID pengguna dari sesi yang aktif.

$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$fotoid' AND UserID='$userid'");

if (mysqli_num_rows($ceksuka) == 1) { // Jika sudah ada suka dari pengguna pada foto tersebut
    while($row = mysqli_fetch_array($ceksuka)){
        $likeid = $row['LikeID']; // Ambil ID suka dari hasil query.
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE LikeID='$likeid'"); // Hapus suka tersebut dari database.
        echo "<script>
        location.href='../source/home.php'; // Alihkan pengguna kembali ke halaman utama.
        </script>";
    }
} else { // Jika pengguna belum menyukai foto tersebut sebelumnya
    $tanggallike = date('Y-m-d'); // Ambil tanggal saat ini.
    $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')"); // Simpan suka baru ke database.
}

echo "<script>
location.href='../source/home.php'; // Alihkan pengguna kembali ke halaman utama.
</script>";
?>