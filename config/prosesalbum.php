<?php
session_start(); // Memulai sesi.
include 'koneksi.php'; // Mengimpor file koneksi.php untuk menghubungkan ke database.

// Bagian untuk menangani penambahan data album.
if (isset($_POST['tambah'])) {
    // Ambil nilai dari form tambah album.
    $namaalbum = $_POST['NamaAlbum'];
    $description = $_POST['Deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['UserID'];

    // Simpan data album ke dalam database.
    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('', '$namaalbum', '$description', '$tanggal', '$userid')");

    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman tambahalbum.
    echo "<script>
    alert('Data Berhasil Disimpan!');
    location.href='../source/tambahalbum.php';
    </script>";
}

// Bagian untuk menangani pembaruan data album.
if (isset($_POST['edit'])) {
    // Ambil nilai dari form edit album.
    $albumid = $_POST['AlbumID'];
    $namaalbum = $_POST['NamaAlbum'];
    $description = $_POST['Deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['UserID'];

    // Lakukan pembaruan data album dalam database.
    $sql = mysqli_query($koneksi, "UPDATE album SET NamaAlbum='$namaalbum', Deskripsi='$description', TanggalDibuat='$tanggal' WHERE AlbumID='$albumid'");

    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman album setelah proses selesai.
    echo "<script>
    alert('Data Berhasil Diperbarui!');
    location.href='../source/album.php';
    </script>";
}

// Bagian untuk menangani penghapusan data album.
if (isset($_POST['hapus'])) {
    // Ambil nilai AlbumID dari form.
    $albumid = $_POST['AlbumID'];

    // Hapus data album dari database.
    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE AlbumID='$albumid'");

    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman album setelah proses selesai.
    echo "<script>
    alert('Data Berhasil Dihapus!');
    location.href='../source/album.php';
    </script>";
}
?>