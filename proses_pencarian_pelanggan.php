<?php
include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

// Jika data pelanggan ditemukan
if ($result_pelanggan && mysqli_num_rows($result_pelanggan) > 0) {
    // Membuat opsi dropdown untuk setiap pelanggan
    $hasil_pencarian .= "<label for='pelangganID' class='form-label'>Pilih Pelanggan:</label>";
    $hasil_pencarian .= "<select class='form-select' id='pelangganID' name='pelangganID'>";
    while ($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
        $hasil_pencarian .= "<option value='{$row_pelanggan['PelangganID']}'>{$row_pelanggan['Nama']}</option>";
    }
    $hasil_pencarian .= "</select>";
} else {
    // Jika pelanggan tidak ditemukan
    $hasil_pencarian = "<div class='alert alert-danger' role='alert'>Pelanggan dengan nama '$namaPelanggan' tidak ditemukan.</div>";
}
