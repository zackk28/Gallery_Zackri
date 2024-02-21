<?php
session_start(); // Memulai sesi.
include 'koneksi.php'; // Mengimpor file koneksi.php untuk menghubungkan ke database.

$fotoid = $_GET['FotoID']; // Mengambil nilai FotoID dari parameter GET.
$userid = $_SESSION['UserID']; // Mengambil UserID dari sesi yang sedang aktif.

// Memeriksa apakah pengguna sudah menyukai foto tersebut sebelumnya.
$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$fotoid' AND UserID='$userid'");

if (mysqli_num_rows($ceksuka) == 1) { // Jika pengguna sudah menyukai foto tersebut sebelumnya
    while($row = mysqli_fetch_array($ceksuka)){
        $likeid = $row['LikeID']; // Mengambil LikeID dari hasil query sebelumnya.
        // Menghapus data like berdasarkan LikeID.
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE LikeID='$likeid'");
        // Mengarahkan pengguna kembali ke halaman 'saya' setelah menghapus like.
        echo "<script>
        location.href='../source/saya.php';
        </script>";
    }
} else { // Jika pengguna belum menyukai foto tersebut sebelumnya
    $tanggallike = date('Y-m-d'); // Mendapatkan tanggal saat ini.
    // Menyimpan data like baru ke dalam database.
    $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')");
}

// Mengarahkan pengguna kembali ke halaman 'saya' setelah proses selesai.
echo "<script>
location.href='../source/saya.php';
</script>";
?>