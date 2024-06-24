<?php
include 'koneksi.php';

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Stock</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Stock</th>
                    <th>Harga</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["kategori_produk"] . "</td>";
                        echo "<td>" . $row["nama_produk"] . "</td>";
                        echo "<td><img src='" . $row["gambar_produk"] . "' alt='Gambar Produk' width='50'></td>";
                        echo "<td>" . $row["deskripsi_produk"] . "</td>";
                        echo "<td>" . $row["stock_produk"] . "</td>";
                        echo "<td>" . $row["harga_produk"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>