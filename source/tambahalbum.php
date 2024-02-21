<?php
// Mulai sesi PHP
session_start();
// Sertakan file koneksi ke database
include '../config/koneksi.php';
// Periksa apakah pengguna sudah login atau belum
if ($_SESSION['status'] != 'login') {
    // Jika belum, tampilkan pesan peringatan dan redirect ke halaman login
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman -->
    <title>Gallery Foto</title>
    <!-- Mengimpor file CSS Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Mengimpor ikon dari font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS kustom -->
    <style>
    /* Gaya CSS kustom */
    .navbar-nav .nav-link {
        font-size: 1.1rem;
    }

    .custom-container {
        width: 100%;
        max-width: 1700px;
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
            <!-- Menu navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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
            <!-- Tombol logout -->
            <div class="navbar-nav ml-auto mr-3" action>
                <a class="nav-link" href="../config/proseslogout.php">
                    <i class="fas fa-sign-out-alt fa-lg me-4"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten form tambah album -->
    <div class="container custom-container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <br>
                            <h5>Tambah Album</h5>
                        </div>
                        <br>
                        <br>
                        <form action="../config/prosesalbum.php" method="POST">
                            <!-- Input untuk nama album -->
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="NamaAlbum" class="form-control" required>
                            <br>
                            <!-- Input untuk deskripsi album -->
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="Deskripsi" required></textarea>
                            <br>
                            <!-- Tombol untuk menambahkan album -->
                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-dark mt-2" name="tambah">Tambah</button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol untuk mengarahkan kembali ke halaman album -->
    <a href="album.php" class="btn btn-dark btn-corner">Data Table</a>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <!-- Mengimpor file JavaScript Bootstrap -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>