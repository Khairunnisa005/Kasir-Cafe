<?php 
	// $id = $_GET['jual'];
	// $hasil = $lihat -> detail_jual($id);
?>
<a href="index.php?page=laporan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
<h4>Detail Penjualan</h4>
<?php if(isset($_GET['success-stok'])){?>
<div class="alert alert-success">
	<p>Tambah Stok Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['success'])){?>
<div class="alert alert-success">
	<p>Tambah Data Berhasil !</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
	<p>Hapus Data Berhasil !</p>
</div>
<?php }?>
<!-- <div class="card card-body">
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<td>ID Penjualan</td>
				<td><?php echo $hasil['id_jual'];?></td>
			</tr>
			<tr>
				<td>ID Produk</td>
				<td><?php echo $hasil['id_barang'];?></td>
			</tr>
			<tr>
				<td>Jumlah Produk</td>
				<td><?php echo $hasil['jumlah'];?></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td><?php echo $hasil['nama_kategori'];?></td>
			</tr>
			<tr>
				<td>Nama Produk</td>
				<td><?php echo $hasil['nama_barang'];?></td>
			</tr>
			<tr>
				<td>Merk Produk</td>
				<td><?php echo $hasil['merk'];?></td>
			</tr>
			<tr>
				<td>Harga Beli</td>
				<td><?php echo $hasil['harga_beli'];?></td>
			</tr>
			<tr>
				<td>Harga Jual</td>
				<td><?php echo $hasil['harga_jual'];?></td>
			</tr>
			<tr>
				<td>Satuan Produk</td>
				<td><?php echo $hasil['satuan_barang'];?></td>
			</tr>
			<tr>
				<td>Stok</td>
				<td><?php echo $hasil['stok'];?></td>
			</tr>
			<tr>
				<td>Tanggal Input</td>
				<td><?php echo $hasil['tgl_input'];?></td>
			</tr>
			<tr>
				<td>Tanggal Update</td>
				<td><?php echo $hasil['tgl_update'];?></td>
			</tr>
		</table>
	</div>
</div> -->

<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered w-60 table-sm" id="example1">
						<thead>
                        <tr style="background:#FAEF5D;color:#333;">
								<th>No</th>
								<th>Penjualan ID</th>
								<th>Produk ID</th>
								<th>Jumlah Produk</th>
								<th>Subtotal</th>
								<!-- <th>Aksi</th> -->
								<!-- <th> ID Produk</th>
								<th> Nama Produk</th>
								<th style="width:10%;"> Jumlah</th>
								<th style="width:10%;"> Modal</th>
								<th style="width:10%;"> Total</th>
								<th> Kasir</th>
								<th> Tanggal Input</th> -->
							</tr>
						</thead>
						<tbody>
							<?php 
								$no=1; 
								if(!empty($_GET['cari'])){
									$periode = $_POST['bln'].'-'.$_POST['thn'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> periode_jual($periode);
								}elseif(!empty($_GET['hari'])){
									$hari = $_POST['hari'];
									$no=1; 
									$jumlah = 0;
									$bayar = 0;
									$hasil = $lihat -> hari_jual($hari);
								}else{
									$id = $_GET['id'];
									$hasil = $lihat -> detail_jual($id);
								}
							?>
							<?php 
								$bayar = 0;
								$jumlah = 0;
								$modal = 0;
								foreach($hasil as $isi){ 
									$bayar += $isi['total'];
									$modal += $isi['harga_beli']* $isi['jumlah'];
									$jumlah += $isi['jumlah'];
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $isi['id_jual'];?></td>
								<td><?php echo $isi['id_barang'];?></td>
								<td><?php echo $isi['jumlah'];?> </td>
								<td>Rp.<?php echo number_format($isi['subtotal']);?>,-</td>
								<!-- <td>Rp.<?php echo number_format($isi['harga_beli']* $isi['jumlah']);?>,-</td> -->
								<!-- <td><?php echo $isi['tanggal_input'];?></td> -->
								<!-- <td>Rp.<?php echo number_format($total_bayar);?>,-</td> -->
								<!-- <td><?php echo $isi['PelangganID'];?></td> -->
								<!-- <td>
									<a href="index.php?page=barang/details&barang=<?php echo $isi['id_penjualan'];?>"><button
                                        class="btn btn-primary btn-xs">Details</button></a>
								</td> -->
								<!-- <td><?php echo $isi['id_barang'];?></td>
								<td><?php echo $isi['nama_barang'];?></td>
								
								<td>Rp.<?php echo number_format($isi['harga_beli']* $isi['jumlah']);?>,-</td>
								
								<td><?php echo $isi['nm_member'];?></td> -->
								
							</tr>
							<?php $no++; }?>
						</tbody>
						<tfoot>
                        <tr style="background:#FAEF5D;color:#333;">
							<th> No</th>
								<th>Penjualan ID</th>
								<th>Tanggal Penjualan</th>
								<th>Jumlah Produk</th>
								<th>Subtotal</th>
								<!-- <th>Aksi</th> -->
								<!-- <th colspan="3">Total Terjual</td> -->
								<!-- <th><?php echo $jumlah;?></td> -->
								<!-- <th>Rp.<?php echo number_format($modal);?>,-</th> -->
								<!-- <th>Rp.<?php echo number_format($bayar);?>,-</th> -->
								<!-- <th style="background:#0bb365;color:#fff;">Keuntungan</th> -->
								<!-- <th style="background:#0bb365;color:#fff;"> -->
									<!-- Rp.<?php echo number_format($bayar-$modal);?>,-</th> -->
									<!-- <th style="background:#0bb365;color:#fff;"></th> -->
								<!-- <th><th></th></th> -->
								</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
     </div>
 </div>