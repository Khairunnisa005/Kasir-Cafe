<?php
session_start();
include "koneksi.php"; // Pastikan file ini mencakup koneksi ke database

if (!isset($_SESSION['user'])) {
    header('location:../signin.php');
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Hapus item dari keranjang belanja berdasarkan product_id
    unset($_SESSION['cart'][$product_id]);

    // Redirect kembali ke halaman keranjang
    header('Location: cart.php');
    exit;
}
