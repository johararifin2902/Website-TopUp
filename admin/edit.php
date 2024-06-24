<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Fetch data based on ID
    $sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $idgame = $row['id_game'];
        $nama = $row['nama_produk'];
        $gambar = $row['gambar_produk'];
        $deskripsi = $row['deskripsi_produk'];
        $stock = $row['stock_produk'];
        $harga = $row['harga_produk'];
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak disediakan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated data from the form
    $idgame = $_POST['id_game'];
    $nama = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi_produk'];
    $stock = $_POST['stock_produk'];
    $harga = $_POST['harga_produk'];

    // Handle file upload if a new image is selected
    if ($_FILES['gambar_produk']['size'] > 0) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . "." . $imageFileType;

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['gambar_produk']['tmp_name']);
        if ($check !== false) {
            // File is an image - proceed to upload
            if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file)) {
                // Update record in the database with new image path
                $sql_update = "UPDATE produk SET id_game = '$idgame', nama_produk = '$nama', gambar_produk = '$target_file', deskripsi_produk = '$deskripsi', stock_produk = '$stock', harga_produk = '$harga' WHERE id_produk = '$id_produk'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Data produk berhasil diperbarui";
                    header("Location: tables.php");
                    exit();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        // Update record without changing the image
        $sql_update = "UPDATE produk SET id_game = '$idgame', nama_produk = '$nama', deskripsi_produk = '$deskripsi', stock_produk = '$stock', harga_produk = '$harga' WHERE id_produk = '$id_produk'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Data produk berhasil diperbarui";
            header("Location: tables.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_game">Id Game</label>
                <input type="text" class="form-control" id="id_game" name="id_game" value="<?php echo $idgame; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk">
                <img src="<?php echo $gambar; ?>" alt="gambar produk" style="max-width: 200px; max-height: 200px; margin-top: 10px; display: block;">
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="3"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="form-group">
                <label for="stock_produk">Stock Produk</label>
                <input type="text" class="form-control" id="stock_produk" name="stock_produk" value="<?php echo $stock; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_produk">Harga Produk</label>
                <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $harga; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="tables.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
