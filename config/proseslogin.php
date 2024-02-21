<?php
session_start();
include 'koneksi.php';

$username = $_POST['Username'];
$password =md5($_POST['Password']);

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username' AND password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek > 0 ) {
    $data = mysqli_fetch_array($sql);
    
    $_SESSION['Username'] = $data['Username'];
    $_SESSION['UserID'] = $data['UserID'];
    $_SESSION['status'] = 'login';
    
    echo "<script>
    alert('Login Berhasil');
    location.href='../source/home.php';
    </script>";
}else{
    echo "<script>
    alert('Username atau Password salah!');
    location.href='../login.php';
    </script>";
}
?>