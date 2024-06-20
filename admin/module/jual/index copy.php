<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'kasircp';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$read = mysqli_query($conn, "SELECT * FROM pelanggan");
?>
<?php 
    $id = $_SESSION['admin']['id_member'];
    $hasil = $lihat -> member_edit($id);
?>

<h4>Keranjang Penjualan</h4>
<br>
<?php if(isset($_GET['success'])){?>
<div
 class="alert alert-success">
    <p>Produk berhasil masuk keranjang</p>
</div>
<?php }?>
<?php if(isset($_GET['success-pelanggan'])){?>
<div
 class="alert alert-success-pelanggan">
    <p>Pelanggan berhasil masuk keranjang</p>
</div>
<?php }?>
<?php if(isset($_GET['remove'])){?>
<div class="alert alert-danger">
    <p>Hapus Data Berhasil !</p>
</div>
<?php }?>

<div class="row">
    <div class="col-sm-4">
        <div class="card card-primary mb-3">
            <div class="card-header bg-ningg text-dark">
                <h5><i class="fa fa-search"></i> Cari Produk</h5>
            </div>
            <div class="card-body">
                <input type="text" id="cari" class="form-control" name="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card card-primary mb-3">
            <div class="card-header bg-ningg text-dark">
                <h5><i class="fa fa-list"></i> Hasil Pencarian Produk</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hasil_cari"></div>
                    <div id="tunggu"></div>
                </div>
            </div>
        </div>
    </div></div>



<div class="row">
    <div class="col-sm-4">
        <div class="card card-primary mb-3">
            <div class="card-header bg-ning text-dark">
                <h5><i class="fa fa-search"></i> Cari Pelanggan</h5>
            </div>
            <div class="card-body">
                <input type="text" id="carii" class="form-control" name="carii" placeholder="Masukan : ID / Nama Pelanggan  [ENTER]">
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card card-primary mb-3">
            <div class="card-header bg-ning text-dark">
                <h5><i class="fa fa-list"></i> Hasil Pencarian Pelanggan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="hasilpl_carii"></div>
                    <div id="tunggu"></div>
                </div>
            </div>
        </div>
    </div>





    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header bg-kuning text-dark">
                <h5><i class="fa fa-shopping-cart"></i> KASIR
                    <a class="btn btn-danger float-right" 
                    onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" href="fungsi/hapus/hapus.php?penjualan=jual">
                        <b>RESET KERANJANG</b>
                    </a>
                </h5>
            </div>
            <div class="card-body">
                <div id="keranjang" class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
                        </tr>
                    </table>

                    <table class="table table-bordered w-100" id="example1">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>ID Penjualan</td>
                                <td>ID Pelanggan</td>
                                <td>Nama Barang</td>
                                <td style="width:10%;">Jumlah</td>
                                <td style="width:20%;">Total</td>
                                <td>Kasir</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_bayar=0; $no=1; $hasil_penjualan = $lihat->penjualan(); ?>
                            <?php foreach($hasil_penjualan as $isi){ ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['id_penjualan'];?></td>
                                    <td><?php echo $isi['PelangganID']; ?></td>
                                    <td><?php echo $isi['nama_barang']; ?></td>
                                    <td>
                                        <!-- aksi ke table penjualan -->
                                        <form method="POST" action="fungsi/edit/edit.php?jual=jual">
                                            <input type="number" name="jumlah" value="<?php echo $isi['jumlah']; ?>" class="form-control">
                                            <input type="hidden" name="id_penjualan" value="<?php echo $isi['id_penjualan']; ?>" class="form-control">
                                            <input type="hidden" name="id_barang" value="<?php echo $isi['id_barang']; ?>" class="form-control">
                                            
                                        </td>
                                        <td>Rp.<?php echo number_format($isi['total']); ?>,-</td>
                                        <td><?php echo $isi['nm_member']; ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>
                                        <!-- aksi ke table penjualan -->
                                        <a href="fungsi/hapus/hapus.php?jual=jual&id=<?php echo $isi['id_penjualan']; ?>&brg=<?php echo $isi['id_barang']; ?>&jml=<?php echo $isi['jumlah']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <!-- echo $isi['id_penjualan']; -->
                                </tr>
                                <?php $no++; $total_bayar += $isi['total']; } ?>
                        </tbody>
                    </table>
                    
                    <br/>
                    <?php $hasil = $lihat -> jumlah(); ?>
                    <div id="kasirnya">
                        <table class="table table-stripped">
                            <?php
                            // proses bayar dan ke nota
                            if(!empty($_GET['nota'] == 'yes')) {
                                $total = $_POST['total'];
                                $bayar = $_POST['bayar'];
                                if(!empty($bayar))
                                {
                                    $hitung = $bayar - $total;
                                    if($bayar >= $total)
                                    {
                                        $id_barang = $_POST['id_barang'];
                                        $id_member = $_POST['id_member'];
                                        $id_penjualan = $_POST['id_penjualan'];
                                        $jumlah = $_POST['jumlah'];
                                        $total = $_POST['total1'];
                                        $tgl_input = $_POST['tgl_input'];
                                        $periode = $_POST['periode'];
                                        
                                        $jumlah_dipilih = count($id_barang);
                                        
                                        for($x=0;$x<$jumlah_dipilih;$x++){

                                            $d = array($id_barang[$x],$id_member[$x],$jumlah[$x],$total[$x],$tgl_input[$x],$periode[$x]);
                                            $sql = "INSERT INTO nota (id_barang,id_member,jumlah,total,tanggal_input,periode) VALUES(?,?,?,?,?,?)";
                                            $row = $config->prepare($sql);
                                            $row->execute($d);

                                            // ubah stok barang
                                            $sql_barang = "SELECT * FROM barang WHERE id_barang = ?";
                                            $row_barang = $config->prepare($sql_barang);
                                            $row_barang->execute(array($id_barang[$x]));
                                            $hsl = $row_barang->fetch();
                                            
                                            $stok = $hsl['stok'];
                                            $idb  = $hsl['id_barang'];

                                            $total_stok = $stok - $jumlah[$x];
                                            // echo $total_stok;
                                            $sql_stok = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                                            $row_stok = $config->prepare($sql_stok);
                                            $row_stok->execute(array($total_stok, $idb));
                                        }
                                        echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
                                    }else{
                                        echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
                                    }
                                }
                            }
                            ?>
                            
                            <!-- aksi ke table nota -->
                            <form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
                                <?php foreach($hasil_penjualan as $isi){;?>
                                    <input type="hidden" name="id_barang[]" value="<?php echo $isi['id_barang'];?>">
                                    <input type="hidden" name="id_member[]" value="<?php echo $isi['id_member'];?>">
                                    <input type="hidden" name="jumlah[]" value="<?php echo $isi['jumlah'];?>">
                                    <input type="hidden" name="total1[]" value="<?php echo $isi['total'];?>">
                                    <input type="hidden" name="tgl_input[]" value="<?php echo $isi['tanggal_input'];?>">
                                    
                                    <input type="hidden" name="periode[]" value="<?php echo date('m-Y');?>">
                                <?php $no++; }?>
                                <tr>
                                    <td>Total Harga </td>
                                    <td><input type="text" class="form-control" name="total" readonly="readonly" value="<?php echo $total_bayar;?>"></td>
                                
                                    <td>Bayar  </td>
                                    <td><input type="text" class="form-control" name="bayar" value="<?php echo $bayar;?>"></td>
                                    <td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
                                    <?php  if(!empty($_GET['nota'] == 'yes')) {?>
                                        <a class="btn btn-danger" href="fungsi/hapus/hapus.php?penjualan=jual">
                                        <b>RESET</b></a></td><?php }?>
                                    </td>
                                </tr>
                            </form>
                            <!-- aksi ke table nota -->
                            <tr>
                                <td>Kembali</td>
                                <td><input type="text" class="form-control" readonly="readonly" value="<?php echo $hitung;?>"></td>
                                <td></td>
                                <td>
                                <a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
                                &bayar=<?php echo $bayar;?> target=blank">

                                    
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
                                    </button></a>
                                </td>
                            </tr>
                        </table>
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Pelanggan Baru</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <form method="post">

                                <div class="modal-body">
                                        Pilih Pelanggan
                                        <select name="idpelanggan" class="form-control">

                                        <?php
                                            $ambilpelannggan = mysqli_query($conn, "SELECT * FROM pelanggan");

                                            while($pl=mysqli_fetch_array($ambilpelannggan)) {
                                                $namapelanggan = $pl['NamaPelanggan'];
                                                $idpelanggan = $pl['PelangganID'];
                                                $alamatpelanggan = $pl['Alamat'];
                                        ?>

                                        <option value="<?=$idpelanggan;?>"><?=$namapelanggan;?> - <?$alamatpelanggan;?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-succes" name="tambahpesan">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                                </form>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                    </div>


                            


<script>
// AJAX call for autocomplete 
$(document).ready(function(){
    $("#cari").keypress(function(event) {
        // Mengecek apakah tombol Enter ditekan
        if (event.which == 13) {
            // Memanggil fungsi pencarian saat tombol Enter ditekan
            cariBarang();
        }
    });
    
    // Fungsi untuk melakukan pencarian barang
    function cariBarang() {
        $.ajax({
            type: "POST",
            url: "fungsi/edit/edit.php?cari_barang=yes",
            data: 'keyword=' + $("#cari").val(),
            beforeSend: function() {
                $("#hasil_cari").hide();
                $("#tunggu").html('<p style="color:green"><blink>tunggu sebentar</blink></p>');
            },
            success: function(html) {
                $("#tunggu").html('');
                $("#hasil_cari").show();
                $("#hasil_cari").html(html);
            }
        });
    }
});

$(document).ready(function(){
    // Tambahkan fungsi untuk mengirim permintaan AJAX saat tombol Enter ditekan pada input pelanggan
    $("#carii").keypress(function(event) {
        // Mengecek apakah tombol Enter ditekan
        if (event.which == 13) {
            // Memanggil fungsi untuk mencari pelanggan saat tombol Enter ditekan
            cariiPelanggan();
            // Mencegah perilaku default formulir (misalnya, pengiriman formulir)
            // event.preventDefault();
        }
    });

    // Fungsi untuk mencari pelanggan
    function cariiPelanggan() {
        $.ajax({
            type: "POST",
            url: "fungsi/edit/edit.php?carii_pelanggan=yes",
            data: 'keyword=' + $("#carii").val(),
            beforeSend: function() {
                $("#hasilpl_carii").hide();
                $("#tunggu").html('<p style="color:green"><blink>Tunggu sebentar</blink></p>');
            },
            success: function(html) {
                $("#tunggu").html('');
                $("#hasilpl_carii").show();
                $("#hasilpl_carii").html(html);
            }
        });
    }
});


</script>
</body>
</html>
