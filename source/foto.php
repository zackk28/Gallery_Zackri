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
                            <h5>Data Gallery Foto</h5>
                        </div>
                        <br>
                        <br>
                        <br>
                        <table class="table table-hover">
                            <thead>
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
                                $no = 1;
                                $userid = $_SESSION['UserID'];
                                $sql= mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID='$userid'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><img src="../assets/img/<?php echo $data['LokasiFile']; ?>" width="120  "></td>
                                    <td><?php echo $data['JudulFoto'] ?></td>
                                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo $data['DeskripsiFoto'] ?></td>
                                    <td><?php echo $data['TanggalUnggah'] ?></td>
                                    <td>

                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#edit<?php echo $data['FotoID'] ?>">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="edit<?php echo $data['FotoID'] ?>" tabindex="-1"
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
                                                        <form action="../config/prosesfoto.php" method="POST"
                                                            enctype="multipart/form-data">
                                                            <input type="hidden" name="FotoID"
                                                                value="<?php echo $data['FotoID']?>">
                                                            <label class="form-label">Judul Foto</label>
                                                            <input type="text" name="JudulFoto"
                                                                value="<?php echo $data['JudulFoto'] ?>"
                                                                class="form-control" required>
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="DeskripsiFoto"
                                                                required> <?php echo $data['DeskripsiFoto']; ?></textarea>
                                                            <label class="form-label"
                                                                aria-label="Default select example">Album</label>
                                                            <select class="form-select" name="AlbumID">
                                                                <?php
                                                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$userid'");
                                                                 while($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                <option
                                                                    <?php if($data_album['AlbumID'] == $data['AlbumID']) { ?>
                                                                    selected="selected" <?php } ?>
                                                                    value="<?php echo $data_album['AlbumID'] ?>">
                                                                    <?php echo $data_album['NamaAlbum'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <br>
                                                                    <br>
                                                                    <img src="../assets/img/<?php echo $data['LokasiFile']; ?>"
                                                                        width="100">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <br>
                                                                    <label class="form-label">Ganti FIle</label>
                                                                    <input type="file" class="form-control"
                                                                        name="LokasiFile">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-dark">Edit
                                                            Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#hapus<?php echo $data['FotoID'] ?>">
                                            Hapus
                                        </button>

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
                                                        <form action="../config/prosesfoto.php" method="POST">
                                                            <input type="hidden" name="FotoID"
                                                                value="<?php echo $data['FotoID']?>">
                                                            Apakah Anda Yakin Akan Menghapus Data ini?? <strong>
                                                                <?php echo $data['JudulFoto'] ?> </strong>
                                                    </div>
                                                    <div class="modal-footer">
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

    <a href="tambahfoto.php" class="btn btn-dark btn-corner">Tambah Data</a>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>