<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <style>
        /* CSS untuk mengatur tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Jarak atas tabel dari elemen sebelumnya */
        }
        th, td {
            padding: 12px; /* Atur padding di antara isi sel */
            text-align: left;
            border-bottom: 1px solid #ddd; /* Garis bawah di setiap baris */
        }
        th {
            background-color: #f2f2f2; /* Warna latar header */
        }
        img {
            max-width: 100px; /* Ukuran maksimum gambar */
            max-height: 100px;
            display: block; /* Memastikan gambar berada dalam blok */
            margin: 0 auto; /* Posisi tengah gambar di dalam sel */
        }
        .btn-group {
            white-space: nowrap; /* Biarkan tombol tetap dalam satu baris */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">JR Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="add_game_form.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Game
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Transaksi
                        </a>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>Form Input Barang</h2>
                            <form action="input.php" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="id_game" class="form-label">Nama Game:</label>
                                    <select class="form-control" id="id_game" name="id_game">
                                        <?php
                                        // Sambungkan ke database
                                        include 'koneksi.php'; // Sesuaikan dengan nama file koneksi Anda
                                        
                                        // Query untuk mengambil data game dari tabel game
                                        $sql = "SELECT id_game, nama_game FROM game";
                                        $result = $conn->query($sql);
                                        
                                        // Periksa apakah ada hasil query
                                        if ($result->num_rows > 0) {
                                            // Output data dari setiap baris hasil query
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_game'] . "'>" . $row['nama_game'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada game tersedia</option>";
                                        }
                                        // Tutup koneksi database
                                        $conn->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk:</label>
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar_produk" class="form-label">Gambar Produk:</label>
                                    <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                                    <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="stock_produk" class="form-label">Stock Produk:</label>
                                    <input type="text" class="form-control" id="stock_produk" name="stock_produk">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_produk" class="form-label">Harga Produk:</label>
                                    <input type="text" class="form-control" id="harga_produk" name="harga_produk">
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Produk
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Game</th>
                                            <th>Nama Produk</th>
                                            <th>Gambar Produk</th>
                                            <th>Deskripsi Produk</th>
                                            <th>Stock Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php'; // Include your database connection file

                                        $sql = "SELECT * FROM produk";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>";
                                                echo "<td>" . $row['id_game'] . "</td>";
                                                echo "<td>" . $row['nama_produk'] . "</td>";
                                                echo "<td><img src='" . $row['gambar_produk'] . "' style='max-width: 100px; max-height: 100px;'></td>";
                                                echo "<td>" . $row['deskripsi_produk'] . "</td>";
                                                echo "<td>" . $row['stock_produk'] . "</td>";
                                                echo "<td>" . $row['harga_produk'] . "</td>";
                                                echo "<td class='btn-group'>";
                                                echo "<a href='edit.php?id=" . $row['id_produk'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                                                echo "<a href='delete.php?id=" . $row['id_produk'] . "' class='btn btn-danger btn-sm'>Delete</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $no++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No records found</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Start Bootstrap &copy; 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/script.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

