<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <!-- Mengimpor file CSS Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="#">WEBSITE GALLERY FOTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Form Daftar Akun Baru -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <br>
                            <h5>Daftar Akun Baru</h5>
                        </div>
                        <br>
                        <br>
                        <form action="config/prosesregister.php" method="POST">
                            <!-- Input untuk username -->
                            <label class="form-label">Username</label>
                            <input type="text" name="Username" class="form-control" required>
                            <!-- Input untuk password -->
                            <label class="form-label">Password</label>
                            <input type="password" name="Password" class="form-control" required>
                            <!-- Input untuk email -->
                            <label class="form-label">Email</label>
                            <input type="email" name="Email" class="form-control" required>
                            <!-- Input untuk nama lengkap -->
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="NamaLengkap" class="form-control" required>
                            <!-- Input untuk alamat -->
                            <label class="form-label">Alamat</label>
                            <input type="text" name="Alamat" class="form-control" required>
                            <div class="d-grid mt-2">
                                <!-- Tombol untuk submit formulir -->
                                <button class="btn btn-dark">DAFTAR</button>
                            </div>
                        </form>
                        <hr>
                        <!-- Link untuk login -->
                        <p>Sudah punya akun? <a href="index.php">Login Disini!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UKK RPL 2024 | Zackri Kurnia Amri</p>
    </footer>

    <!-- Mengimpor file JavaScript Bootstrap -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</body>

</html>