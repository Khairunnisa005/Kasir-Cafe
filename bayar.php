<?php
session_start(); // Mulai sesi

include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: signin.php');
    exit;
}

// Ambil ID pelanggan dari sesi
// Setelah proses login berhasil
$_SESSION['user']['id'] = $user_id; // Simpan ID pengguna ke dalam sesi


// Query untuk mengambil data penjualan terbaru berdasarkan PelangganID
$query = "SELECT penjualan.*, pelanggan.NamaPelanggan FROM penjualan JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID WHERE penjualan.PelangganID = ORDER BY penjualan.TanggalPenjualan DESC LIMIT 1";

$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $tanggalPenjualan = $row['TanggalPenjualan'];
    $totalHarga = $row['TotalHarga'];
    $namaPelanggan = $row['NamaPelanggan'];
} else {
    // Jika tidak ada data penjualan yang ditemukan
    $tanggalPenjualan = "Data tidak tersedia";
    $totalHarga = 0;
    $namaPelanggan = "Data tidak tersedia";
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
    <title>Halaman Bayar</title>
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
                    <li class=""><a class="nav-link" href="shop.php">Shop</a></li>
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

    <!-- Start Bayar Section -->
    <div class="container mt-5">
        <h1 class="mb-4">Halaman Bayar</h1>
        <h5>Detail Penjualan:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tanggal Penjualan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Nama Pelanggan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $tanggalPenjualan; ?></td>
                    <td><?php echo $totalHarga; ?></td>
                    <td><?php echo $namaPelanggan; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- End Bayar Section -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>