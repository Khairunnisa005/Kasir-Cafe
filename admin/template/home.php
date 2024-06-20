<h3>Beranda</h3>
<br/>
<?php 
	$sql=" select * from barang where stok <= 3";
	$row = $config -> prepare($sql);
	$row -> execute();
	$r = $row -> rowCount();
	if($r > 0){
?>
<?php
		echo "
		<div class='alert alert-warning'>
			<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span> barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !!
			<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Tabel Barang <i class='fa fa-angle-double-right'></i></a></span>
		</div>
		";	
	}
?>
<?php $hasil_barang = $lihat -> barang_row();?>
<?php $hasil_kategori = $lihat -> kategori_row();?>
<?php $stok = $lihat -> barang_stok_row();?>
<?php $jual = $lihat -> jual_row();?>
<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-kuning text-dark">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Jumlah Produk</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_barang);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang'>Tabel
                    Produk <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-kuning text-dark">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Produk</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($stok['jml']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=barang' >Tabel
                    Produk <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <!-- STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-kuning text-dark">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Telah Terjual</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($jual['stok']);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=laporan'>Tabel
                    laporan <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-header bg-kuning text-dark">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Kategori Produk</h6>
            </div>
            <div class="card-body">
                <center>
                    <h1><?php echo number_format($hasil_kategori);?></h1>
                </center>
            </div>
            <div class="card-footer">
                <a href='index.php?page=kategori'>Tabel
                    Kategori <i class='fa fa-angle-double-right'></i></a>
            </div>
        </div>
        <!--/grey-card -->
    </div><!-- /col-md-3-->
</div>

<br>
<!-- Top Selling -->
              <div class="card top-selling overflow-auto">
                <div class="col-12">
                <div class="card-body pb-0">
                  <h4 class="card-title"><b>Produk Terlaris</b></h4><br>

                  <table class="table"  100% cellpadding=10>
                    <thead>
                      <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>  
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th><a href="index.php?page=barang"><img src="assets/img/kue/eslemon.jpg"alt=""></a></th>
                        <td><a href="index.php?page=barang" class="text-primary fw-bold">Choco Drink</a></td>
                        <td>Rp 4.000</td>
                        <td><a href="index.php?page=barang"><img src="assets/img/kue/singkong.jpg" alt=""></a></td>
                        <td><a href="index.php?page=barang" class="text-primary fw-bold">Singkong</a></td>
                        <td>Rp 7.000</td>
                        <td><a href="index.php?page=barang"><img src="assets/img/kue/coklat.jpg" alt=""></a></td>
                        <td><a href="index.php?page=barang" class="text-primary fw-bold">Lemon Tea</a></td>
                        <td>Rp 4.000</td>
                      </tr>
                     
                     
                    </tbody>
                  </table>

                  </div> </div>
            </div><br><br><!-- End Top Selling -->
