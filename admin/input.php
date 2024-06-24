<?php
include 'koneksi.php'; // Sertakan file koneksi.php yang berisi koneksi ke database

// Fungsi untuk membersihkan input data
function cleanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags(trim($data))));
}

// Pastikan form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $id_game = cleanInput($_POST['id_game']);
    $nama_produk = cleanInput($_POST['nama_produk']);
    $deskripsi_produk = cleanInput($_POST['deskripsi_produk']);
    $stock_produk = cleanInput($_POST['stock_produk']);
    $harga_produk = cleanInput($_POST['harga_produk']);

    // Handle file upload
    if (!empty($_FILES["gambar_produk"]["name"])) {
        $target_dir = "../uploads/";
        // Buat folder uploads jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $uploadOk = 1;
        $gambar_produk = $_FILES["gambar_produk"]["name"];
        $target_file = $target_dir . uniqid() . "_" . basename($gambar_produk);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["gambar_produk"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["gambar_produk"]["size"] > 500000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
        } else {
            // Try to upload file
            if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file)) {
                // File uploaded successfully, now insert into database
                $sql = "INSERT INTO produk (id_game, nama_produk, gambar_produk, deskripsi_produk, stock_produk, harga_produk) 
                        VALUES ('$id_game', '$nama_produk', '$target_file', '$deskripsi_produk', '$stock_produk', '$harga_produk')";

                if ($conn->query($sql) === TRUE) {
                    echo "Data berhasil disimpan";
                    header("Location: tables.php"); // Redirect to table page after successful insertion
                    exit(); // Stop script execution
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    } else {
        echo "Please select an image file to upload.<br>";
    }
}

// Close the database connection
$conn->close();
?>
