<?php
session_start(); // Mulai sesi

include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
    exit;
}

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = '';

// Jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $namaPelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $noTelp = $_POST['no_telp'];

    // Validasi data
    if (empty($namaPelanggan) || empty($alamat) || empty($noTelp)) {
        $error = "Harap isi semua bidang.";
    } else {
        // Simpan data ke database
        $query = "INSERT INTO pelanggan (NamaPelanggan, Alamat, NoTelp) VALUES ('$namaPelanggan', '$alamat', '$noTelp')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Redirect ke halaman bayar.php setelah berhasil menyimpan data pelanggan
            header('Location: shop.php');
            exit;
        } else {
            $error = "Gagal menyimpan data pelanggan.";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <title>Formulir Pelanggan</title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="shop.php">Kasir Hahay<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="active"><a class="nav-link" href="form_pelanggan.php">Form Pelanggan</a></li>
                    <li><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
                    <li><a class="nav-link active" href="cart.php"><img src="images/cart.svg"></a></li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <!-- Start Formulir Pelanggan -->
    <div class="container mt-5">
        <h1 class="mb-4">Formulir Pelanggan</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <!-- End Formulir Pelanggan -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>