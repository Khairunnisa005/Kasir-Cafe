<?php
session_start(); // Mulai sesi

include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

// Function to format price into Indonesian Rupiah
function format_rupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

// Inisialisasi variabel totalHarga dan index
$totalHarga = 0;
$index = 1;

if (isset($_POST['checkout'])) {
    // Ambil data pelanggan dari sesi atau tempat lain yang sesuai
    $pelangganID = $_POST['pelanggan']; // Mengambil ID pelanggan dari form

    // Ambil tanggal saat ini
    $tanggalPenjualan = date('Y-m-d');

    // Simpan data penjualan ke dalam database
    $query = "INSERT INTO penjualan (TanggalPenjualan, TotalHarga, PelangganID) VALUES ('$tanggalPenjualan', '$totalHarga', '$pelangganID')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Mendapatkan ID penjualan yang baru saja dimasukkan
        $penjualanID = mysqli_insert_id($koneksi);

        // Loop untuk menyimpan detail penjualan ke dalam tabel detail_penjualan
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query_produk = "SELECT * FROM produk WHERE ProdukID = $product_id";
            $result_produk = mysqli_query($koneksi, $query_produk);

            if ($result_produk && mysqli_num_rows($result_produk) > 0) {
                $row_produk = mysqli_fetch_assoc($result_produk);
                $harga_produk = $row_produk['Harga'];
                $subtotal = $harga_produk * $quantity;

                // Simpan detail penjualan ke dalam tabel penjualan
                $query_detail = "INSERT INTO penjualan (PenjualanID, ProdukID, Jumlah, Subtotal) VALUES ('$penjualanID', '$product_id', '$quantity', '$subtotal')";
                $result_detail = mysqli_query($koneksi, $query_detail);

                if (!$result_detail) {
                    echo "Gagal menyimpan detail penjualan.";
                    exit;
                }
            } else {
                echo "Produk dengan ID $product_id tidak ditemukan.";
                exit;
            }
        }

        // Bersihkan keranjang belanja setelah transaksi selesai
        unset($_SESSION['cart']);
        header('Location: invoice.php?penjualan_id=' . $penjualanID); // Redirect pengguna ke halaman invoice atau konfirmasi pembayaran dengan menyertakan ID penjualan
        exit;
    } else {
        echo "Gagal menyimpan data penjualan.";
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
    <title>Keranjang Belanja</title>
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
                    <li><a class="nav-link" href="form_pelanggan.php">Form Pelanggan</a></li>
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

    <!-- Start Cart Section -->
    <div class="container mt-5">
        <h1 class="mb-4">Keranjang Belanja</h1>

        <form method="post" action="">
            <div class="mb-3">
                <label for="pelanggan" class="form-label">Pilih Pelanggan:</label>
                <select name="pelanggan" id="pelanggan" class="form-select">
                    <?php
                    // Query untuk mengambil data pelanggan dari database
                    $query_pelanggan = "SELECT * FROM pelanggan"; // Ubah query ini agar mengambil seluruh kolom dari tabel pelanggan
                    $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);

                    // Tampilkan opsi-opsi pelanggan
                    while ($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
                        echo "<option value='{$row_pelanggan['id']}'>{$row_pelanggan['NamaPelanggan']}</option>"; // Pastikan kunci kolom dan nama kolom sesuai dengan struktur tabel pelanggan
                    }
                    ?>
                </select>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th> <!-- Tambah kolom untuk tanda silang -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            // Query untuk mengambil data produk dari database
                            $query = "SELECT * FROM produk WHERE ProdukID = $product_id";
                            $result = mysqli_query($koneksi, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $total = $row['Harga'] * $quantity;
                                $totalHarga += $total;
                                echo "<tr>";
                                echo "<td>$index</td>";
                                echo "<td>{$row['NamaProduk']}</td>";
                                echo "<td>" . format_rupiah($row['Harga']) . "</td>";
                                echo "<td>$quantity</td>";
                                echo "<td>" . format_rupiah($total) . "</td>";
                                echo "<td><a href='hapus_item.php?product_id=$product_id'><i class='fas fa-times'></i></a></td>"; // Tambahkan tanda silang sebagai tautan untuk membatalkan pesanan
                                echo "</tr>";
                                $index++;
                            } else {
                                // Tampilkan pesan bahwa produk tidak ditemukan
                                echo "<tr>";
                                echo "<td colspan='6'>Produk dengan ID $product_id tidak ditemukan</td>";
                                echo "</tr>";
                            }
                        }
                        // Tampilkan total harga keseluruhan
                        echo "<tr>";
                        echo "<td colspan='4' class='text-end'><strong>Total</strong></td>";
                        echo "<td><strong>" . format_rupiah($totalHarga) . "</strong></td>";
                        echo "<td></td>"; // Kolom aksi tambahan, biarkan kosong untuk total harga
                        echo "</tr>";
                    } else {
                        // Jika keranjang kosong, tampilkan pesan
                        echo "<tr>";
                        echo "<td colspan='6'>Keranjang belanja kosong</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <a href="shop.php" class="btn btn-secondary">Kembali ke Shop</a>
                <button type="submit" name="checkout" class="btn btn-primary">Lanjutkan Pembayaran</button>
            </div>
        </form>
    </div>
    <!-- End Cart Section -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>