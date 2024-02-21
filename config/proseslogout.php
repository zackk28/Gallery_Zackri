<?php
session_start(); // Memulai sesi untuk pengguna yang sudah login.
session_destroy(); // Mengakhiri semua data sesi yang terkait dengan sesi saat ini.

echo "<script>
alert('Logout Berhasil');
location.href='../index.php';
</script>";
?>