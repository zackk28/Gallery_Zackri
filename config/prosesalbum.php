<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $namaalbum = $_POST['NamaAlbum'];
    $description = $_POST['Deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['UserID'];

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('','$namaalbum','$description','$tanggal','$userid')");

    echo "<script>
    alert('Data Berhasil Disimpan!');
    location.href='../source/tambahalbum.php';
    </script>";
}

if (isset($_POST['edit'])) {
    $albumid = $_POST['AlbumID'];
    $namaalbum = $_POST['NamaAlbum'];
    $description = $_POST['Deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['UserID'];

    $sql = mysqli_query($koneksi, "UPDATE album SET NamaAlbum='$namaalbum', Deskripsi='$description', TanggalDibuat='$tanggal' WHERE AlbumID='$albumid'");

    echo "<script>
    alert('Data Berhasil Diperbarui!');
    location.href='../source/album.php';
    </script>";
}

if (isset($_POST['hapus'])) {
    $albumid = $_POST['AlbumID'];

    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE AlbumID='$albumid'");

    echo "<script>
    alert('Data Berhasil Dihapus!');
    location.href='../source/album.php';
    </script>";
}
?>