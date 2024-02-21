<?php
session_start();
include '../config/koneksi.php';

$userid = $_SESSION['UserID'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
    exit(); // menghentikan eksekusi jika tidak login
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    .navbar-nav .nav-link {
        font-size: 1.1rem;
    }

    .custom-container {
        width: 100%;
        max-width: 2500px;
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

    <div class="container">
        <div class="row">
            <?php
        $query = mysqli_query($koneksi, "SELECT foto.*, user.NamaLengkap, album.NamaAlbum FROM foto JOIN user ON foto.UserID = user.UserID JOIN album ON foto.AlbumID = album.AlbumID");
        while ($data = mysqli_fetch_array($query)) {
            ?>
            <div class="col-md-3 mt-5">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p>@<?php echo $data['NamaLengkap']; ?></p>
                            </div>
                            <div class="col-6 text-right">
                                <p>Album : <?php echo $data['NamaAlbum']; ?></p>
                            </div>
                        </div>
                    </div>
                    <img style="height: 13rem; object-fit: contain; object-position: center;"
                        src="../assets/img/<?php echo $data['LokasiFile'] ?>" class="card-img-top"
                        title="<?php echo $data['JudulFoto'] ?>">
                    <div class="card-footer text-right">
                        <?php
            $fotoid = $data['FotoID'];
            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$fotoid' AND UserID='$userid'");
            if (mysqli_num_rows($ceksuka) == 1) { ?>
                        <a href="../config/proseslikehome.php?FotoID=<?php echo $data['FotoID']?>" type="submit"
                            name="batalsuka"><i class="fa-solid fa-thumbs-up" style="color: #000000;"></i></a>
                        <?php } else { ?>
                        <a href="../config/proseslikehome.php?FotoID=<?php echo $data['FotoID']?>" type="submit"
                            name="suka"><i class="fa-regular fa-thumbs-up" style="color: #000000;"></i></a>
                        <?php }
            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$fotoid'");
            echo mysqli_num_rows($like). ' Suka';
            ?>
                        <a href="detail.php?FotoID=<?php echo $data['FotoID']; ?>">
                            <i class="fa-regular fa-message fa-flip-horizontal" style="color: #000000;">
                            </i>
                        </a>
                        <?php $komen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$fotoid'");
            echo mysqli_num_rows($komen). ' Komentar'; ?>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>