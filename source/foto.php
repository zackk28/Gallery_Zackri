<?php
// Memulai sesi PHP
session_start();
// Mengimpor file koneksi.php untuk terhubung ke database
include '../config/koneksi.php';
// Memeriksa apakah pengguna sudah login atau belum
if ($_SESSION['status'] != 'login') {
    // Jika belum login, tampilkan pesan peringatan dan arahkan kembali ke halaman login
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <!-- Mengimpor stylesheet Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Mengimpor ikon dari Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Menambahkan gaya kustom -->
    <style>
    .navbar-nav .nav-link {
        font-size: 1.1rem;
    }

    .custom-container {
        width: 100%;
        max-width: 2500px;
    }

    .card {
        width: 100%;
    }

    .btn-corner {
        position: fixed;
        bottom: 75px;
        right: 35px;
        z-index: 999;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Menu navigasi -->
                    <li class="nav-item">
                        <a class="nav-link ms-5" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-5" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-5" href="foto.php">Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ms-5" href="saya.php">Saya</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-nav ml-auto mr-3" action>
                <!-- Tombol logout -->
                <a class="nav-link" href="../config/proseslogout.php">
                    <i class="fas fa-sign-out-alt fa-lg me-4"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container custom-container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body bg-light">
                        <!-- Judul -->
                        <div class="text-center">
                            <br>
                            <h5>Data Gallery Foto</h5>
                        </div>
                        <br>
                        <br>
                        <br>
                        <!-- Tabel untuk menampilkan data foto -->
                        <table class="table table-hover">
                            <thead>
                                <!-- Kolom-kolom tabel -->
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul Foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Menginisialisasi nomor urut
                                $no = 1;
                                // Mendapatkan ID pengguna dari sesi
                                $userid = $_SESSION['UserID'];
                                // Menjalankan query untuk mendapatkan data foto pengguna
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID='$userid'");
                                // Loop untuk menampilkan setiap foto
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <!-- Nomor urut -->
                                    <td><?php echo $no++ ?></td>
                                    <!-- Menampilkan foto -->
                                    <td><img src="../assets/img/<?php echo $data['LokasiFile']; ?>" width="120  "></td>
                                    <!-- Judul foto -->
                                    <td><?php echo $data['JudulFoto'] ?></td>
                                    <!-- Deskripsi foto -->
                                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo $data['DeskripsiFoto'] ?></td>
                                    <!-- Tanggal unggah -->
                                    <td><?php echo $data['TanggalUnggah'] ?></td>
                                    <!-- Tombol edit -->
                                    <td>
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#edit<?php echo $data['FotoID'] ?>">
                                            Edit
                                        </button>
                                        <!-- Modal untuk mengedit foto -->
                                        <div class="modal fade" id="edit<?php echo $data['FotoID'] ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <!-- Konten modal -->
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form untuk mengedit foto -->
                                                        <form action="../config/prosesfoto.php" method="POST"
                                                            enctype="multipart/form-data">
                                                            <input type="hidden" name="FotoID"
                                                                value="<?php echo $data['FotoID'] ?>">
                                                            <!-- Input judul foto -->
                                                            <label class="form-label">Judul Foto</label>
                                                            <input type="text" name="JudulFoto"
                                                                value="<?php echo $data['JudulFoto'] ?>"
                                                                class="form-control" required>
                                                            <!-- Input deskripsi foto -->
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="DeskripsiFoto"
                                                                required><?php echo $data['DeskripsiFoto']; ?></textarea>
                                                            <!-- Pilihan album -->
                                                            <label class="form-label"
                                                                aria-label="Default select example">Album</label>
                                                            <select class="form-select" name="AlbumID">
                                                                <?php
                                                                    // Mendapatkan data album pengguna
                                                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$userid'");
                                                                    // Loop untuk menampilkan setiap album
                                                                    while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                <!-- Opsi album -->
                                                                <option
                                                                    <?php if ($data_album['AlbumID'] == $data['AlbumID']) { ?>
                                                                    selected="selected" <?php } ?>
                                                                    value="<?php echo $data_album['AlbumID'] ?>">
                                                                    <?php echo $data_album['NamaAlbum'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <br>
                                                                    <br>
                                                                    <!-- Menampilkan gambar -->
                                                                    <img src="../assets/img/<?php echo $data['LokasiFile']; ?>"
                                                                        width="100">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <br>
                                                                    <!-- Input untuk mengganti file foto -->
                                                                    <label class="form-label">Ganti FIle</label>
                                                                    <input type="file" class="form-control"
                                                                        name="LokasiFile">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol untuk menyimpan perubahan -->
                                                        <button type="submit" name="edit" class="btn btn-dark">Edit
                                                            Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tombol hapus -->
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#hapus<?php echo $data['FotoID'] ?>">
                                            Hapus
                                        </button>
                                        <!-- Modal untuk menghapus foto -->
                                        <div class="modal fade" id="hapus<?php echo $data['FotoID'] ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form untuk menghapus foto -->
                                                        <form action="../config/prosesfoto.php" method="POST">
                                                            <input type="hidden" name="FotoID"
                                                                value="<?php echo $data['FotoID'] ?>">
                                                            <!-- Konfirmasi penghapusan -->
                                                            Apakah Anda Yakin Akan Menghapus Data ini?? <strong>
                                                                <?php echo $data['JudulFoto'] ?> </strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol untuk menghapus data -->
                                                        <button type="submit" name="hapus" class="btn btn-dark">Hapus
                                                            Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol untuk menambah data foto -->
    <a href="tambahfoto.php" class="btn btn-dark btn-corner">Tambah Data</a>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <!-- Mengimpor script Bootstrap -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>