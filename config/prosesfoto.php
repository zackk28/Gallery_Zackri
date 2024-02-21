<?php
session_start(); // Mulai sesi.
include 'koneksi.php'; // Sertakan file koneksi.php untuk menghubungkan ke database.

// Bagian untuk menangani penambahan data foto.
if (isset($_POST['tambah'])) {
    // Ambil nilai-nlai dari form tambah foto.
    $judulfoto = $_POST['JudulFoto'];
    $deskripsifoto = $_POST['DeskripsiFoto'];
    $tanggalunggah = date('Y-m-d');
    $foto = $_FILES['LokasiFile']['name'];
    $tmp = $_FILES['LokasiFile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;
    $albumid = $_POST['AlbumID'];
    $userid = $_SESSION['UserID'];

    // Pindahkan file foto ke lokasi yang ditentukan.
    move_uploaded_file($tmp, $lokasi.$namafoto);

    // Simpan data foto ke dalam database.
    $sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('', '$judulfoto', '$deskripsifoto', '$tanggalunggah', '$namafoto', '$albumid', '$userid')");

    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman tambahfoto.
    echo "<script>
    alert('Data Berhasil Disimpan!');
    location.href='../source/tambahfoto.php';
    </script>";
}

// Bagian untuk menangani pembaruan data foto.
if (isset($_POST['edit'])) {
    // Ambil nilai-nlai dari form edit foto.
    $fotoid = $_POST['FotoID'];
    $judulfoto = $_POST['JudulFoto'];
    $deskripsifoto = $_POST['DeskripsiFoto'];
    $tanggalunggah = date('Y-m-d');
    $foto = $_FILES['LokasiFile']['name'];
    $tmp = $_FILES['LokasiFile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;
    $albumid = $_POST['AlbumID'];
    $userid = $_SESSION['UserID'];

    if ($foto == null) {
        // Jika tidak ada foto yang diunggah, lakukan pembaruan data kecuali LokasiFile (foto).
        $sql= mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsifoto', TanggalUnggah='$tanggalunggah', AlbumID='$albumid' WHERE FotoID='$fotoid'");
    } else {
        // Jika ada foto yang diunggah, lakukan pembaruan data termasuk LokasiFile (foto).
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/'.$data['LokasiFile'])) {
            unlink('../assets/img/'.$data['LokasiFile']); // Hapus foto lama dari direktori.
        } 
        move_uploaded_file($tmp, $lokasi.$namafoto); // Pindahkan foto baru ke lokasi yang ditentukan.
        $sql = mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsifoto', TanggalUnggah='$tanggalunggah', LokasiFile='$namafoto', AlbumID='$albumid' WHERE FotoID='$fotoid'");
    }
    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman foto setelah proses selesai.
    echo "<script>
    alert('Data Berhasil Diperbarui!');
    location.href='../source/foto.php';
    </script>";
}

// Bagian untuk menangani penghapusan data foto.
if (isset($_POST['hapus'])){
    $fotoid = $_POST['FotoID'];
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$fotoid'");
    $data = mysqli_fetch_array($query);
    if (is_file('../assets/img/'.$data['LokasiFile'])) {
        unlink('../assets/img/'.$data['LokasiFile']); // Hapus foto dari direktori.
    } 
    // Hapus data foto dari database.
    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE FotoID='$fotoid'");
    // Tampilkan pesan sukses dan arahkan pengguna kembali ke halaman foto setelah proses selesai.
    echo "<script>
    alert('Data Berhasil Dihapus!');
    location.href='../source/foto.php';
    </script>";
}
?>