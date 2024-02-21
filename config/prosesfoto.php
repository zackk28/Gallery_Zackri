<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['JudulFoto'];
    $deskripsifoto = $_POST['DeskripsiFoto'];
    $tanggalunggah = date('Y-m-d');
    $foto = $_FILES['LokasiFile']['name'];
    $tmp = $_FILES['LokasiFile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;
    $albumid = $_POST['AlbumID'];
    $userid = $_SESSION['UserID'];

    move_uploaded_file($tmp, $lokasi.$namafoto);

    $sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judulfoto','$deskripsifoto','$tanggalunggah','$namafoto','$albumid','$userid')");

    echo "<script>
    alert('Data Berhasil Disimpan!');
    location.href='../source/tambahfoto.php';
    </script>";
}

if (isset($_POST['edit'])) {
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
        $sql= mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsifoto', TanggalUnggah='$tanggalunggah', AlbumID='$albumid' WHERE FotoID=''$fotoid");
    }else{
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/'.$data['LokasiFile'])) {
            unlink('../assets/img/'.$data['LokasiFile']);
        } 
        move_uploaded_file($tmp, $lokasi.$namafoto);
        $sql = mysqli_query($koneksi, "UPDATE foto SET JudulFoto='$judulfoto', DeskripsiFoto='$deskripsifoto', TanggalUnggah='$tanggalunggah', LokasiFile='$namafoto', AlbumID='$albumid' WHERE FotoID='$fotoid'");    }
    echo "<script>
    alert('Data Berhasil Diperbarui!');
    location.href='../source/foto.php';
    </script>";

}

if (isset($_POST['hapus'])){
    $fotoid = $_POST['FotoID'];
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/'.$data['LokasiFile'])) {
            unlink('../assets/img/'.$data['LokasiFile']);
        } 

        $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE FotoID='$fotoid'");
        echo "<script>
        alert('Data Berhasil Dihapus!');
        location.href='../source/foto.php';
        </script>";
}