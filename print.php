<?php
@ob_start();
session_start();
if (!empty($_SESSION['admin'])) {
} else {
	echo '<script>window.location="login.php";</script>';
	exit;
}
require 'config.php';
include $view;
$lihat = new view($config);
$toko = $lihat->toko();
$hsl = $lihat->penjualan();

$sql_idjual = "SELECT * FROM jual ORDER BY id DESC LIMIT 1";
$row_idjual = $config->query($sql_idjual);
$hasil_idjual = $row_idjual->fetch();
$id_jual = $hasil_idjual['id'];

$select = $lihat->jumlah();

$total_harga = $select['bayar'];
$id_member = $hsl[0]['id_member'];
$jumlah = count($hsl);
$pelanggan = $hasil_idjual['PelangganID'];
$tgl_input = date("j F Y, G:i:s");
$periode = date("m-Y");

$nota_array = [$id_member, $id_jual, $jumlah, $total_harga, $pelanggan, $tgl_input, $periode];
$sql_nota = "INSERT INTO nota (id_member, id_penjualan, jumlah, total, PelangganID, tanggal_input, periode) VALUES(?,?,?,?,?,?,?)";
$row_nota = $config->prepare($sql_nota);
$row_nota->execute($nota_array);

for ($x = 0; $x < $jumlah; $x++)
{
	$nota = "SELECT * FROM nota WHERE tanggal_input='$tgl_input'";
	$row = $config->query($nota);
	$hasil = $row->fetchAll();
	$id_nota = $hasil[0]['id_nota'];

	$detail_nota_arr = [$hsl[$x]['id_barang'], $id_member, $hsl[$x]['jumlah'], $hsl[$x]['total'], $pelanggan, $tgl_input, $id_nota];
	$sql_detail_nota = "INSERT INTO detailnota (id_barang, id_member, jumlah, total, PelangganID, tanggal_input, id_nota) VALUES (?,?,?,?,?,?,?)";
	$row_detail_nota = $config->prepare($sql_detail_nota);
	$row_detail_nota->execute($detail_nota_arr);
}

?>
<html>

<head>
	<title>Print</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css"><br>
</head>

<body>
	<script>
		window.print();
		window.onafterprint = function() {
			window.location.href = 'index.php?page=jual'
		}
	</script>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<center>
					<p><?php echo $toko['nama_toko']; ?>,
						<?php echo $toko['alamat_toko']; ?>
					</p>
					<p> <?php echo date("j F Y, G:i"); ?></p>
					<p>Kasir : <?php echo htmlentities($_GET['nm_member']); ?></p><br><br>

					<table class="table" border="0" style="width:40%;" cellpadding=5 cellspacing=5>
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<?php $no = 1;
						foreach ($hsl as $isi) { ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $isi['nama_barang']; ?></td>
								<td><?php echo $isi['jumlah']; ?></td>
								<td><?php echo $isi['total']; ?></td>
							</tr>
							<?php $no++;
						} ?>
					</table><br><br>
					<div class="pull-right">
						<?php $hasil = $lihat->jumlah(); ?>
						<table cellspacing=10>
							<tr>
								<td>Total</td>
								<td>: Rp.<?php echo number_format($hasil['bayar']); ?>,-</td>
							</tr>
							<tr>
								<td>Bayar </td>
								<td>: Rp.<?php echo number_format(intval($_GET['bayar'])); ?>,-</td>
							</tr>
							<tr>
								<td>Kembalian</td>
								<td>: Rp.<?php echo number_format(intval($_GET['kembali'])); ?>,-</td>
							</tr>
						</table>
					</div>
					<div class="clearfix"></div>
				</center>
				<center>
					<p>Terima Kasih Telah berbelanja di toko kami!</p>
				</center>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>

</html>

<?php

$destroy = 'DELETE FROM penjualan';
$row_destroy = $config->prepare($destroy);
$row_destroy->execute();

?>