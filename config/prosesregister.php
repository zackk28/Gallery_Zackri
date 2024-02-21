<?php
include 'koneksi.php';

$username =$_POST['Username'];
$password =md5($_POST['Password']);
$email =$_POST['Email'];
$namalengkap =$_POST['NamaLengkap'];
$alamat =$_POST['Alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO  user VALUES ('','$username','$password','$email','$namalengkap','$alamat')");

if ($sql) {
    echo "<script>
    alert('Pendaftaran Akun Berhasil');
    location.href='../index.php';
    </script>";
}
?>