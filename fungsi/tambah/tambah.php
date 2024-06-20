<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'kasircp';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// print_r($_POST);
// exit();

// print_r($_REQUEST);
// exit();

// if ($row->execute()) {
//     echo "Query executed successfully";
// } else {
//     echo "Error executing query: " . $row->error;
// }


// echo $sql;
// print_r($data);
// exit();

// if ($row->execute()) {
//     echo "Query executed successfully";
// } else {
//     echo "Error executing query: " . $row->error;
// }

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty($_GET['pelanggan'])) {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $id = htmlentities($_POST['id']);
        $nama = htmlentities($_POST['nama']);
        $alamat = htmlentities($_POST['alamat']);
        $telp = htmlentities($_POST['telp']);

        $error = "error";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $sql = mysqli_query($conn, "INSERT INTO pelanggan (PelangganID, NamaPelanggan, Alamat, NomorTelepon) 
        VALUES ('$id', '$nama', '$alamat', '$telp') ");

        if (!$sql) {
            echo 'gagal';
        }

        // $stmt = $config->prepare($sql);
        // if ($stmt === false) {
        //     trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $config->$error, E_USER_ERROR);
        // }
        // if (!$stmt->bind_param('ssss', $data[0], $data[1], $data[2], $data[3])) {
        //     trigger_error('Cannot prepare statement: ' . $config->$error, E_USER_ERROR);
        // }
        // if (!$stmt->execute()) {
        //     trigger_error('Execute error: ' . $stmt->$error, E_USER_ERROR);
        // }
        
        print_r($data);
        echo '<script>window.location="../../index.php?page=pelanggan&success=tambah-data"</script>';
        exit();
        // $row = $config->prepare($sql);
        // $row -> execute();
        // $row->execute($data);
    }
}



if (!empty($_GET['kategori'])) {
    $nama = htmlentities(htmlentities($_POST['kategori']));
    $tgl = date("j F Y, G:i");
    $data[] = $nama;
    $data[] = $tgl;
    $sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
    $row = $config->prepare($sql);
    $row->execute($data);
    echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
}

// if (!empty($_GET['pelanggan'])) {
//     $id = htmlentities($_POST['PelangganID']);
//     $nama = htmlentities($_POST['NamaPelanggan']);
//     $alamat = htmlentities($_POST['Alamat']);
//     $telp = htmlentities($_POST['NomorTelepon']);
//     $tgl = htmlentities($_POST['tgl']);

//     $data[] = $id;
//     $data[] = $nama;
//     $data[] = $alamat;
//     $data[] = $telp;
//     $data[] = $tgl;
//     $sql = 'INSERT INTO pelanggan (PelangganID,NamaPelanggan,Alamat,NomorTelepon,tgl_input) 
// 		    VALUES (?,?,?,?,?) ';
//     $row = $conn -> prepare($sql);
//     $row -> execute($data);
//     echo '<script>window.location="../../index.php?page=pelanggan&success=tambah-data"</script>';
// }

// 1

if (!empty($_GET['barang'])) {
    $id = htmlentities($_POST['id']);
    $kategori = htmlentities($_POST['kategori']);
    $nama = htmlentities($_POST['nama']);
    $merk = htmlentities($_POST['merk']);
    $beli = htmlentities($_POST['beli']);
    $jual = htmlentities($_POST['jual']);
    $satuan = htmlentities($_POST['satuan']);
    $stok = htmlentities($_POST['stok']);
    $tgl = htmlentities($_POST['tgl']);

    $data[] = $id;
    $data[] = $kategori;
    $data[] = $nama;
    $data[] = $merk;
    $data[] = $beli;
    $data[] = $jual;
    $data[] = $satuan;
    $data[] = $stok;
    $data[] = $tgl;
    $sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
    $row = $config->prepare($sql);
    $row->execute($data);
    echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
}

if (!empty($_GET['jual'])) {
    $id = $_GET['id'];

    // get tabel barang id_barang
    $sql = 'SELECT * FROM barang WHERE id_barang = ?';
    $row = $config->prepare($sql);
    $row->execute(array($id));
    $hsl = $row->fetch();

    if ($hsl['stok'] > 0) {
        $kasir =  $_GET['id_kasir'];
        $jumlah = 1;
        $total = $hsl['harga_jual'];
        $tgl = date("j F Y, G:i");

        $data1[] = $id;
        $data1[] = $kasir;
        $data1[] = $jumlah;
        $data1[] = $total;
        $data1[] = $tgl;

        $sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
        $row1 = $config->prepare($sql1);
        $row1->execute($data1);

        echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
    } else {
        echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
    }
}

if (!empty($_GET['juall'])) {
    $PelangganID = $_GET['PelangganID'];

    // get data pelanggan berdasarkan ID
    $sql = 'SELECT * FROM pelanggan WHERE PelangganID = ?';
    $row = $config->prepare($sql);
    $row->execute(array($PelangganID)); // Menggunakan $PelangganID yang sudah didefinisikan sebelumnya
    $hsl = $row->fetch();

    if ($hsl) { // Periksa apakah data pelanggan ditemukan
        $pelangganId = $hsl['PelangganID'];

        $sql1 = "UPDATE penjualan SET PelangganID='$pelangganId'";
        $row1 = $config->prepare($sql1);
        $row1->execute($data1);

        echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
    } else {
        echo '<script>alert("Pelanggan Anda Tidak Ada !");
					window.location="../../index.php?page=juall#keranjang"</script>';
    }
}

if (!empty($_GET['juall'])) {
    $id_nota = $_GET['id_nota'];

    // get data pelanggan berdasarkan ID
    $sql = 'SELECT * FROM nota WHERE id_nota = ?';
    $row = $config->prepare($sql);
    $row->execute(array($id_nota)); // Menggunakan id_nota yang sudah didefinisikan sebelumnya
    $hsl = $row->fetch();

    if ($hsl) { // Periksa apakah data nota ditemukan
        $id_nota = $hsl['id_nota'];

        $sql1 = "UPDATE penjualan SET id_nota='$id_nota'";
        $row1 = $config->prepare($sql1);
        $row1->execute($data1);

        echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
    } else {
        echo '<script>alert("Pelanggan Anda Tidak Ada !");
					window.location="../../index.php?page=juall#keranjang"</script>';
    }
}
