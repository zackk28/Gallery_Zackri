<?php
include 'koneksi.php'; // Mengimpor file koneksi.php untuk menghubungkan ke database.

// Mengambil nilai yang dikirim melalui metode POST dari formulir pendaftaran.
$username =$_POST['Username']; // Mengambil nilai Username.
$password =md5($_POST['Password']); // Mengambil nilai Password dan mengenkripsinya menggunakan fungsi md5.
$email =$_POST['Email']; // Mengambil nilai Email.
$namalengkap =$_POST['NamaLengkap']; // Mengambil nilai Nama Lengkap.
$alamat =$_POST['Alamat']; // Mengambil nilai Alamat.

// Menyusun query untuk memasukkan data pengguna baru ke dalam tabel 'user'.
$sql = mysqli_query($koneksi, "INSERT INTO user VALUES ('','$username','$password','$email','$namalengkap','$alamat')");

// Memeriksa apakah query berhasil dieksekusi.
if ($sql) {
    // Jika berhasil, tampilkan pesan sukses menggunakan alert dan arahkan pengguna kembali ke halaman indeks.
    echo "<script>
    alert('Pendaftaran Akun Berhasil');
    location.href='../index.php';
    </script>";
}
?>