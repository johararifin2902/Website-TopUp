<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database

// Tangkap data yang dikirimkan dari AJAX
$username = isset($_POST['username']) ? $_POST['username'] : '';
$userId = isset($_POST['userid']) ? $_POST['userid'] : '';
$zoneId = isset($_POST['zoneid']) ? $_POST['zoneid'] : '';
$idProduk = isset($_POST['id_produk']) ? $_POST['id_produk'] : '';
$idPembayaran = isset($_POST['id_pembayaran']) ? $_POST['id_pembayaran'] : '';
$hargaProduk = isset($_POST['harga_produk']) ? $_POST['harga_produk'] : '';

// Validasi data yang diterima
// Validasi data yang diterima
if (empty($username) || empty($userId) || empty($idProduk) || empty($idPembayaran) || empty($hargaProduk)) {
    echo "Error: Data tidak lengkap.";
    exit;
 }
 
 // Simpan data transaksi ke dalam database
 $date = date('Y-m-d H:i:s');
 $status = 'Pending'; // Status awal transaksi
 
 // Query untuk menyimpan data transaksi
 $sql = "INSERT INTO transaksi (username, user_id, zone_id, id_produk, id_pembayaran, harga_produk, tanggal_transaksi, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
 $stmt = $conn->prepare($sql);
 
 if (!$stmt) {
    echo "Error: " . htmlspecialchars($conn->error);
    exit;
 }
 
 $stmt->bind_param("ssiiisss", $username, $userId, $zoneId, $idProduk, $idPembayaran, $hargaProduk, $date, $status);
 $result = $stmt->execute();
 
 if ($result) {
    echo "Transaksi berhasil disimpan. ID Transaksi: " . $stmt->insert_id;
 } else {
    echo "Error: " . htmlspecialchars($stmt->error);
 }
 
 $stmt->close();
 $conn->close();
 ?>
 
