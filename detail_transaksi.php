<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database

// Ambil ID transaksi dari URL
$id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : null;

// Query untuk mengambil detail transaksi dari database
if ($id_transaksi) {
    $sql = "SELECT * FROM transaksi_topup WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_transaksi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $transaksi = $result->fetch_assoc();
    } else {
        // Jika ID transaksi tidak ditemukan
        echo "<p>Detail transaksi tidak ditemukan.</p>";
        exit; // Hentikan eksekusi lebih lanjut jika ID tidak valid
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
} else {
    // Jika ID transaksi tidak tersedia
    echo "<p>ID transaksi tidak valid.</p>";
    exit; // Hentikan eksekusi lebih lanjut jika ID tidak valid
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        

        header {
            background-color: #4CAF50;
            color: #4CAF50;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        main {
            padding: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Detail Transaksi Top Up Mobile Legends Diamonds</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Detail Transaksi</h2>
            <table>
                <tr>
                    <th>ID Transaksi</th>
                    <td><?php echo $transaksi['id']; ?></td>
                </tr>
                <tr>
                    <th>ID Produk</th>
                    <td><?php echo $transaksi['id_produk']; ?></td>
                </tr>
                <tr>
                    <th>Harga Produk</th>
                    <td>Rp <?php echo number_format($transaksi['harga_produk'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?php echo $transaksi['metode_pembayaran']; ?></td>
                </tr>
                <tr>
                    <th>User ID</th>
                    <td><?php echo $transaksi['user_id']; ?></td>
                </tr>
                <tr>
                    <th>Zone ID</th>
                    <td><?php echo $transaksi['zone_id'] ? $transaksi['zone_id'] : '-'; ?></td>
                </tr>
                <tr>
                    <th>Waktu Transaksi</th>
                    <td><?php echo $transaksi['waktu_transaksi']; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $transaksi['username']; ?></td>
                </tr>
            </table>

            <!-- Tombol Kembali ke Halaman Utama -->
            <a href="index.php" class="btn">Kembali ke Halaman Utama</a>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Mobile Legends</p>
        </div>
    </footer>
</body>

</html>
