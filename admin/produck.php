<?php
include "../koneksi.php";
if (!isset($_SESSION['user'])) {
    header('location:../signin.php');
}

if (isset($_POST['submit'])) {
    if (isset($_GET['id'])) {
        // Update data
        $ProdukID = $_GET['id'];
        $NamaProduk = $_POST['NamaProduk'];
        $Harga = $_POST['Harga'];
        $Stock = $_POST['Stock'];
        $Gambarproduk = $_FILES["Gambarproduk"]["name"];

        $extension = substr($Gambarproduk, strlen($Gambarproduk) - 4, strlen($Gambarproduk));
        $allowed_extensions = array(".jpg", "jpeg", ".png");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png format allowed');</script>";
        } else {
            $imgnewfile = md5($Gambarproduk) . time() . $extension;
            move_uploaded_file($_FILES["Gambarproduk"]["tmp_name"], "../images/" . $imgnewfile);

            // Query for data update
            $query = mysqli_query($koneksi, "UPDATE produk SET NamaProduk='$NamaProduk', Harga='$Harga', Stock='$Stock', GambarProduk='$imgnewfile' WHERE ProdukID='$ProdukID'");
            if ($query) {
                echo "<script>alert('You have successfully updated the data');</script>";
                echo "<script type='text/javascript'> document.location ='produck.php'; </script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again');</script>";
            }
        }
    } else {
        // Insert data
        $NamaProduk = $_POST['NamaProduk'];
        $Harga = $_POST['Harga'];
        $Stock = $_POST['Stock'];
        $Gambarproduk = $_FILES["Gambarproduk"]["name"];

        $extension = substr($Gambarproduk, strlen($Gambarproduk) - 4, strlen($Gambarproduk));
        $allowed_extensions = array(".jpg", "jpeg", ".png");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png format allowed');</script>";
        } else {
            $imgnewfile = md5($Gambarproduk) . time() . $extension;
            move_uploaded_file($_FILES["Gambarproduk"]["tmp_name"], "../images/" . $imgnewfile);

            // Query for data insertion
            $query = mysqli_query($koneksi, "insert into produk(NamaProduk, Harga, Stock, GambarProduk) value('$NamaProduk','$Harga', '$Stock','$imgnewfile' )");
            if ($query) {
                echo "<script>alert('You have successfully inserted the data');</script>";
                echo "<script type='text/javascript'> document.location ='produck.php'; </script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again');</script>";
            }
        }
    }
}

// Fetch data for editing if ID is provided in URL
$data = array();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE ProdukID='$id'");
    $data = mysqli_fetch_assoc($query);
}

$query = "SELECT * FROM produk ";
$result = mysqli_query($koneksi, $query);

function format_rupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

// Menggunakan fungsi mysqli_fetch_assoc() untuk mengambil setiap baris data sebagai array asosiatif
// Kemudian menampilkannya dalam tabel HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - Tabel - Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Admin Kasir Hahay</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <a class="nav-link" href="../logout.php"><i class="fa fa-sign-out fa-1x"></i> Logout</a>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <style>
                            .active {
                                color: #fff;
                                /* Warna teks untuk tombol aktif */
                            }

                            .active .sb-nav-link-icon i {
                                color: #fff;
                                /* Warna ikon untuk tombol aktif */
                            }
                        </style>

                        <div class="sb-sidenav-menu-heading">Navigasi</div>
                        <a id="dashboardButton" class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a id="usersButton" class="nav-link" href="users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                        </a>
                        <a id="pelangganButton" class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user me-1"></i></div>
                            Pelanggan
                        </a>
                        <a id="produckButton" class="nav-link active" href="produck.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                            Produck
                        </a>
                        <a id="produckButton" class="nav-link" href="detailpenjualan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Detail Penjualan
                        </a>
                        <a id="produckButton" class="nav-link" href="penjualan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Penjualan
                        </a>


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['user']['nama']; ?>
                </div>
            </nav>
        </div>
        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Produk</h1>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo isset($_GET['id']) ? 'Edit Produk' : 'Tambah Produk'; ?></h4>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="NamaProduk">Nama Produk</label>
                                    <input type="text" name="NamaProduk" class="form-control" id="NamaProduk" placeholder="Nama Produk" required value="<?php echo isset($data['NamaProduk']) ? $data['NamaProduk'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Harga">Harga</label>
                                    <input type="number" name="Harga" class="form-control" id="Harga" placeholder="Harga" required value="<?php echo isset($data['Harga']) ? $data['Harga'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Stock">Stock</label>
                                    <input type="number" name="Stock" class="form-control" id="Stock" placeholder="Stock" required value="<?php echo isset($data['Stock']) ? $data['Stock'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="GambarProduk">Gambar Produk</label>
                                    <input type="file" name="Gambarproduk" class="form-control" id="GambarProduk" <?php echo isset($data['GambarProduk']) ? '' : 'required'; ?>>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit"><?php echo isset($_GET['id']) ? 'Edit' : 'Tambah'; ?></button>
                                <?php if (isset($_GET['id'])) : ?>
                                    <a href="produck.php" class="btn btn-secondary">Batal</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"></li>
                    </ol>

                    <!-- Table to display user data -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-dolly-flatbed"></i>
                            DataTable Produck
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td><img src='../images/" . $row['GambarProduk'] . "' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>";
                                        echo "<td>" . $row['NamaProduk'] . "</td>";
                                        echo "<td>" . format_rupiah($row['Harga']) . "</td>";
                                        echo "<td>" . $row['Stock'] . "</td>";
                                        echo "<td>";
                                        // Check if in edit mode
                                        if (isset($_GET['edit']) && $_GET['edit'] == $row['ProdukID']) {
                                            echo "<form method='POST' action='../editproduk.php?id=" . $row['ProdukID'] . "' enctype='multipart/form-data'>";
                                            echo "<input type='hidden' name='ProdukID' value='" . $row['ProdukID'] . "'>";
                                            echo "<input type='text' name='NamaProduk' value='" . $row['NamaProduk'] . "' required>";
                                            echo "<input type='number' name='Harga' value='" . $row['Harga'] . "' required>";
                                            echo "<input type='number' name='Stock' value='" . $row['Stock'] . "' required>";
                                            echo "<input type='file' name='Gambarproduk' required>";
                                            echo "<button type='submit' name='submit' class='btn btn-primary btn-sm'>Save</button>";
                                            echo "</form>";
                                        } else {
                                            // Normal view mode
                                            echo "<a href='?id=" . $row['ProdukID'] . "' class='btn btn-primary btn-sm'>Edit</a>";
                                            echo "<a href='deleteproduk.php?id=" . $row['ProdukID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\")'>Delete</a>";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <!-- Footer content -->
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>