<?php
session_start(); // Memulai sesi untuk pengguna yang login.
include 'koneksi.php'; // Mengimpor file koneksi.php untuk menghubungkan ke database.

$username = $_POST['Username']; // Mengambil nilai Username dari formulir login.
$password = md5($_POST['Password']); // Mengambil nilai Password dari formulir login dan mengenkripsinya menggunakan fungsi md5.

// Melakukan query untuk memeriksa apakah kombinasi Username dan Password cocok dengan data yang ada di database.
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username' AND password='$password'");

// Menghitung jumlah baris yang terpengaruh oleh query.
$cek = mysqli_num_rows($sql);

if ($cek > 0) { // Jika data ditemukan (jumlah baris > 0)
    $data = mysqli_fetch_array($sql); // Mengambil data pengguna dari hasil query.
    
    // Menyimpan informasi pengguna ke dalam sesi.
    $_SESSION['Username'] = $data['Username'];
    $_SESSION['UserID'] = $data['UserID'];
    $_SESSION['status'] = 'login'; // Menandakan bahwa pengguna sudah login.
    
    // Menampilkan pesan sukses menggunakan alert dan mengarahkan pengguna ke halaman home.
    echo "<script>
    alert('Login Berhasil');
    location.href='../source/home.php';
    </script>";
} else { // Jika data tidak ditemukan
    // Menampilkan pesan kesalahan menggunakan alert dan mengarahkan pengguna kembali ke halaman login.
    echo "<script>
    alert('Username atau Password salah!');
    location.href='../login.php';
    </script>";
}
?>