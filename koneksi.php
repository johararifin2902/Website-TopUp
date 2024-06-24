<?php
// koneksi.php

$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "webtopup"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data game dari tabel games
$sql = "SELECT * FROM game";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
date_default_timezone_set('Asia/Jakarta'); // Ganti sesuai zona waktu Anda
?>