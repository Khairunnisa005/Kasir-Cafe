<h4>Data Pelanggan</h4>
<br>
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
include("config.php");
if (isset($_GET['success-edit'])) { ?>
    <div class="alert alert-success">
        <p>Ubah Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        <p>Tambah Data Berhasil !</p>
    </div>
<?php } ?>
<?php if (isset($_GET['remove'])) { ?>
    <div class="alert alert-danger">
        <p>Hapus Data Berhasil !</p>
    </div>
<?php } ?>


<!-- DataTables Example -->

<button type="button" class="btn btn-primary btn-md mr-2" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-plus"></i> Insert Data</button>
<div class="clearfix"></div>
<br />

<!-- view barang -->
<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="example1">
            <thead>
                <tr style="background:#FAEF5D;color:#333;">
                    <th> ID Pelanggan</th>
                    <th> Nama Pelanggan</th>
                    <th> Alamat Pelanggan</th>
                    <th> Nomor Telepon</th>
                    <th> Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr style="background:#FAEF5D;color:#333;">
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat Pelanggan</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php

                // $read = mysqli_query($config, "SELECT * FROM pelanggan");
                // if (!$read) {
                //     die('Error: ' . mysqli_error($config));
                // } 
                while ($data = mysqli_fetch_assoc($read)) {
                    $id = $data['PelangganID'];
                    $nama = $data['NamaPelanggan'];
                    $alamat = $data['Alamat'];
                    $telp = $data['NomorTelepon'];

                ?>
                    <tr>
                        <td>
                            <?php echo $id; ?>
                        </td>
                        <td>
                            <?php echo $nama; ?>
                        </td>
                        <td>
                            <?php echo $alamat; ?>
                        </td>
                        <td>
                            <?php echo $telp; ?>
                        </td>
                        <td style='width: 170px;'>

                            <a href="index.php?page=pelanggan/edit&pelanggan=<?php echo $id; ?>"><button class="btn btn-warning btn-xs">Edit</button></a>
                            <a href="fungsi/hapus/hapus.php?pelanggan=hapus&id=<?php echo $id; ?>" onclick="javascript:return confirm('Hapus Data Pelanggan ?');">
                                <button class="btn btn-danger btn-xs">Hapus</button></a>

                            <!--Tampilan pop up delete-->
                            <!-- <div id="deleteuser<?php echo $nis; ?>" class="modal fade" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Menghapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus data dengan NIS 
                            <?= $nis ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">Batal</button>
                            <a href="./delete.php?op=delete&nis=<?= $nis ?>"
                                class="btn btn-primary">Yakin</a>
                        </div>
                    </div>
                </div>
            </div> -->
                        </td>
                    </tr>
                <?php

                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</form>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style=" border-radius:0px;">
            <div class="modal-header" style="background:#FAEF5D;color:#fff;">
                <h5 class="modal-title text-dark"><i class="fa fa-plus"></i> Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="fungsi/tambah/tambah.php?pelanggan=tambah">
                <div class="modal-body">
                    <table class="table table-striped bordered">
                        <?php
                        $format = $lihat->pelanggan_id();
                        ?>
                        <!-- <tr>
                                    <td>ID Pelanggan</td>
                                    <td><input type="text" readonly="readonly" required value="<?php echo $format; ?>"
                                            class="form-control" name="id"></td>
                                </tr> -->
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><input type="text" placeholder="Nama Pelanggan" required class="form-control" name="nama"></td>
                        </tr>
                        <tr>
                            <td>Alamat Pelanggan</td>
                            <td><input type="text" placeholder="Alamat Pelanggan" required class="form-control" name="alamat"></td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td><input type="number" placeholder="Nomor Telepon" required class="form-control" name="telp"></td>
                        </tr>
                        <!-- <tr>
                                    <td>Tanggal Input</td>
                                    <td><input type="text" required readonly="readonly" class="form-control"
                                            value="<?php echo  date("j F Y, G:i"); ?>" name="tgl"></td>
                                </tr> -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Tambahkan Data</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>