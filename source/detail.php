<?php
// Memulai sesi PHP
session_start();
// Mengimpor file koneksi.php untuk terhubung ke database
include '../config/koneksi.php';

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    // Jika belum login, tampilkan pesan peringatan dan arahkan kembali ke halaman login
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
    exit(); // Hentikan eksekusi skrip
}

// Memeriksa apakah FotoID telah diset dan valid
if(isset($_GET['FotoID'])) {
    $fotoID = $_GET['FotoID'];
    
    // Query untuk mendapatkan detail foto berdasarkan FotoID
    $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE FotoID = '$fotoID'");
    $data = mysqli_fetch_array($query);
    // Jika foto dengan FotoID tertentu tidak ditemukan
    if(!$data) {
        echo "<script>
        alert('Foto tidak ditemukan!');
        location.href='foto.php';
        </script>";
        exit(); // Hentikan eksekusi skrip
    }
} else {
    // Jika FotoID tidak tersedia, tampilkan pesan peringatan dan arahkan kembali ke halaman foto
    echo "<script>
    alert('FotoID tidak tersedia!');
    location.href='foto.php';
    </script>";
    exit(); // Hentikan eksekusi skrip
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
            <!-- Navbar Links -->
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
            <!-- Logout Link -->
            <div class="navbar-nav ml-auto mr-3" action>
                <a class="nav-link" href="../config/proseslogout.php">
                    <i class="fas fa-sign-out-alt fa-lg me-4"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Detail Foto -->
    <?php
        // Mendapatkan detail album tempat foto berada
        $query = "SELECT * FROM foto INNER JOIN album ON foto.AlbumID = album.AlbumID WHERE foto.FotoID = '$fotoID'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            $namaAlbum = $data['NamaAlbum'];
        } else {
            $namaAlbum = "Album Tidak Diketahui";
        }
    ?>

    <!-- Tampilan Detail Foto -->
    <div class="m-5">
        <div class="row justify-content-start mt-5">
            <!-- Kolom Foto -->
            <div class="col-md-3">
                <h3 class="text-center"><?php echo $namaAlbum; ?></h3>
                <br>
                <img src="../assets/img/<?php echo $data['LokasiFile']; ?>" class="card-img-top" alt="Foto"
                    style="width: 100%; height: auto;">
            </div>
            <!-- Kolom Informasi -->
            <br>
            <br>
            <div class="col-md-8">
                <br>
                <br>
                <br>
                <h4><?php echo $data['JudulFoto']; ?></h4>
                <p class="fs-6"><?php echo $data['TanggalUnggah']; ?></p>
                <p class="fs-6"><?php echo $data['DeskripsiFoto']; ?></p>
            </div>
        </div>
    </div>

    <!-- Komentar -->
    <div class="m-5">
        <h5>Comment</h5>
        <div class="d-flex flex-column mb-3">
            <?php
            // Mengambil komentar untuk foto ini dari database
            $userid = $_SESSION['UserID'];
            $sql = mysqli_query($koneksi, "SELECT komentarfoto.*, user.NamaLengkap FROM komentarfoto LEFT JOIN user ON komentarfoto.UserID = user.UserID WHERE komentarfoto.FotoID= '$fotoID'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
            <!-- Menampilkan Komentar -->
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">@<?= $data['NamaLengkap'] ?></h6>
                        <p class="card-text"><?= $data['IsiKomentar'] ?></p>
                        <p class="card-text"><small class="text-muted"><?= $data['TanggalKomentar'] ?></small></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Form untuk menulis komentar -->
        <div class="mt-5">
            <div class="row">
                <div class="col-md-2">
                    <form action="../config/proseskomentar.php" method="POST" class="">
                        <h5>Write comment</h5>
                        <div class="form-group d-flex flex-row gap-2">
                            <input type="text" value="<?php echo $_GET['FotoID'] ?>" name="FotoID" hidden />
                            <textarea class="form-control" id="komentar" name="IsiKomentar" rows="1"
                                required></textarea>
                            <button type="submit" class="btn btn-dark">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="home.php" class="btn btn-dark btn-corner">Kembali</a>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <!-- Script Bootstrap -->
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>