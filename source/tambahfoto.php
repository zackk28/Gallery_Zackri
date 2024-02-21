<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] !='login') {
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
            <div class="navbar-nav ml-auto mr-3" action>
                <a class="nav-link" href="../config/proseslogout.php">
                    <i class="fas fa-sign-out-alt fa-lg me-4"></i>
                </a>
            </div>
        </div>
    </nav>

    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container custom-container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <br>
                            <h5>Tambah Foto</h5>
                        </div>
                        <br>
                        <br>
                        <form action="../config/prosesfoto.php" method="POST" enctype="multipart/form-data">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="JudulFoto" class="form-control" required>
                            <br>
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="DeskripsiFoto" required></textarea>
                            <br>
                            <label class="form-label">Lokasi FIle</label>
                            <input type="file" class="form-control" name="LokasiFile" required>
                            <br>
                            <label class="form-label" aria-label="Default select example">Album</label>
                            <select class="form-select" name="AlbumID" required>
                                <?php
                                $userid = $_SESSION['UserID'];
                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$userid'");
                                while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                <option value="<?php echo $data_album['AlbumID'] ?>">
                                    <?php echo $data_album['NamaAlbum'] ?></option>
                                <?php } ?>
                            </select>
                            <br>
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

    <a href="foto.php" class="btn btn-dark btn-corner">Data Table</a>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>