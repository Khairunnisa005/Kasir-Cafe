<?php
if (!isset($_SESSION)) {
    session_start();
}

// Sisanya dari kode koneksi Anda

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kasir';

$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}
