<?php
session_start();

include "koneksi.php";

if (isset($_GET['penjualan_id'])) {
    $penjualanID = $_GET['penjualan_id'];

    // Query untuk mendapatkan informasi penjualan
    $query_penjualan = "SELECT * FROM penjualan WHERE PenjualanID = '$penjualanID'";
    $result_penjualan = mysqli_query($koneksi, $query_penjualan);

    if ($result_penjualan && mysqli_num_rows($result_penjualan) > 0) {
        $row_penjualan = mysqli_fetch_assoc($result_penjualan);
        $tanggalPenjualan = $row_penjualan['TanggalPenjualan'];
        $totalHarga = $row_penjualan['TotalHarga'];
        $pelangganID = $row_penjualan['PelangganID'];

        // Query untuk mendapatkan informasi pelanggan
        $query_pelanggan = "SELECT * FROM pelanggan WHERE id = '$pelangganID'";
        $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
        $row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
        $namaPelanggan = $row_pelanggan['NamaPelanggan'];
    } else {
        echo "Data penjualan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID penjualan tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembelian</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .invoice h2 {
            margin-bottom: 20px;
        }
        .invoice table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice table th, .invoice table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <h2>Invoice Pembelian</h2>
        <p><strong>Tanggal Penjualan:</strong> <?php echo $tanggalPenjualan; ?></p>
        <p><strong>Pelanggan:</strong> <?php echo $namaPelanggan; ?></p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_detail = "SELECT * FROM detail_penjualan WHERE PenjualanID = '$penjualanID'";
                $result_detail = mysqli_query($koneksi, $query_detail);

                $index = 1;
                while ($row_detail = mysqli_fetch_assoc($result_detail)) {
                    $produkID = $row_detail['ProdukID'];
                    $jumlah = $row_detail['Jumlah'];
                    $subtotal = $row_detail['Subtotal'];

                    // Query untuk mendapatkan informasi produk
                    $query_produk = "SELECT * FROM produk WHERE ProdukID = '$produkID'";
                    $result_produk = mysqli_query($koneksi, $query_produk);
                    $row_produk = mysqli_fetch_assoc($result_produk);
                    $namaProduk = $row_produk['NamaProduk'];
                    $hargaProduk = $row_produk['Harga'];

                    echo "<tr>";
                    echo "<td>$index</td>";
                    echo "<td>$namaProduk</td>";
                    echo "<td>" . format_rupiah($hargaProduk) . "</td>";
                    echo "<td>$jumlah</td>";
                    echo "<td>" . format_rupiah($subtotal) . "</td>";
                    echo "</tr>";

                    $index++;
                }
                ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong><?php echo format_rupiah($totalHarga); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
