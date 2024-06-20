 <!--sidebar end-->

 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
 <!--main content start-->
 <?php

	include('../../../../config.php');
	// echo file_get_contents("../module/pelanggan/edit/index.php");
	// exit();

	$lihat = new view($config);

	$id = $_GET['pelanggan'];
	$hasil = $lihat->pelanggan_edit($id);
	?>
 <a href="index.php?page=pelanggan" class="btn btn-primary mb-3"><i class="fa fa-angle-left"></i> Balik </a>
 <h4>Edit Data</h4>
 <?php if (isset($_GET['success-edit'])) { ?>
 	<div class="alert alert-success">
 		<p>Edit Data Berhasil !</p>
 	</div>
 <?php } ?>
 <?php if (isset($_GET['remove'])) { ?>
 	<div class="alert alert-danger">
 		<p>Hapus Data Berhasil !</p>
 	</div>
 <?php } ?>
 <div class="card card-body">
 	<div class="table-responsive">
 		<table class="table table-striped">
 			<form action="fungsi/edit/edit.php?pelanggan=edit" method="POST">
 				<tr>
 					<td>ID Pelanggan</td>
 					<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['PelangganID']; ?>" name="id"></td>
 				</tr>
 				<tr>
 					<td>Nama Pelanggan</td>
 					<td>
 						<input type="text" class="form-control" value="<?php echo $hasil['NamaPelanggan']; ?>" name="nama">
 					</td>
 					</td>
 				</tr>
 				<tr>
 					<td>Alamat Pelanggan</td>
 					<td><input type="text" class="form-control" value="<?php echo $hasil['Alamat']; ?>" name="alamat"></td>
 				</tr>
 				<tr>
 					<td>Nomor Telepon</td>
 					<td><input type="number" class="form-control" value="<?php echo $hasil['NomorTelepon']; ?>" name="telp"></td>
 				</tr>
 				<tr>
 					<td></td>
 					<td><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit Data</button></td>
 				</tr>
 			</form>
 		</table>
 	</div>
 </div>
 