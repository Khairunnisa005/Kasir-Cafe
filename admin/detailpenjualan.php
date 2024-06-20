<?php
include "../koneksi.php";
if (!isset($_SESSION['user'])) {
    header('location:../signin.php');
}
$query = "SELECT 
            dp.PenjualanID,
            dp.ProdukID,
            dp.JumlahProduk,
            dp.JumlahProduk * p.Harga AS Subtotal
          FROM 
            detailpenjualan dp
          JOIN 
            penjualan pj ON dp.PenjualanID = pj.PenjualanID
          JOIN 
            produk p ON dp.ProdukID = p.ProdukID";
$result = mysqli_query($koneksi, $query);

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
    <title>Admin - Tabel - Detail Penjualan</title>
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
                        <a id="usersButton" class="nav-link " href="users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                        </a>
                        <a id="pelangganButton" class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user me-1"></i></div>
                            Pelanggan
                        </a>
                        <a id="produckButton" class="nav-link" href="produck.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                            Produck
                        </a>
                        <a id="produckButton" class="nav-link active" href="detailpenjualan.php">
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
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php"></a></li>
                    </ol>

                    <!-- Table to display user data -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user me-1"></i>
                            DataTable Pelanggan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Penjualan</th>
                                        <th>ID Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['PenjualanID'] . "</td>";
                                        echo "<td>" . $row['ProdukID'] . "</td>";
                                        echo "<td>" . $row['JumlahProduk'] . "</td>";
                                        echo "<td>" . $row['Subtotal'] . "</td>";
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