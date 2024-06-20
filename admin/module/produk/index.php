<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <section class="konten">
    <div class="container">
      <h1>Produk</h1>
      <div class="row">

    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="../foto produk/kacang.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue Kacang</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info" id="beli">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/kastangel.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue kastangel</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/keciput.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue Keciput</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/keipik.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Keripik pisang</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/kembang.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue Kembang</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/kuping.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kuping Gajah</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/lidah.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue lidah kucing</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/monde.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue monde susu</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/nastar.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Nastar</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/pastel.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue pastel</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/salju.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue salju</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>
    <div class="col-6 col-md-3">
    <div class="img-thumbnail">
      <img src="foto_produk/semprit.jpeg" alt="" style=" width: 252px; height: 200px;">
      <div class="caption">
        <h3>Kue semprit</h3>
        <h5>Rp. 20.000</h5>
        <a href="index.php?page=barang&stok=yes" class="btn btn-info">Beli</a>
      </div>
    </div>
  </div>

  </div>
    </div>
  </section>
</body>
</html>